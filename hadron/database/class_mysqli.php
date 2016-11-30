<?php
/**
*
*	Hadron Framework: MySQL Improved Database Class
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Helper function for processing WHERE fields..
function parseWhere($where)
{
	if(count($where)==0) return '';
	
	$wstring = " WHERE ";
	foreach($where as $key => $entry)
	{
		// TO-DO: Fetch these from the Main Hadron Container.
		global $db, $error;
		if($entry=="AND" && is_numeric($key)) $wstring .= " AND ";
		elseif($entry=="OR" && is_numeric($key)) $wstring .= " OR ";
		elseif(is_array($entry) && isset($entry['type']) && $entry['type']=="IN" && is_numeric($key))
		{
			if(!is_array($entry) || !isset($entry['field'], $entry['values']))
				die($error->getError(500,"Database Error: Illegal use of IN in a WHERE field."));
			$values = "";
			foreach($entry['values'] as $value) $values .= $db->sanitise($value).",";
			$wstring .= "{$entry['field']} IN ('".rtrim($values,',')."')";
		}
		elseif(is_numeric($key)) $wstring .= " ".$entry." ";
		else $wstring .= "{$key}="."'".$db->sanitise($entry)."'";
	}
	return $wstring;
}

// This class holds fields for use in table creations
final class fields
{
	public $name = null;
	public $type = null;
	public $size = null;
	public $isNull = false;
	public $increment = false;
	public $fDefault = false;
	public $primary = false;
	
	/**
	*
	*	$name - A string holding the name of the field.
	*	$type - A string holding what the type of the field is.
	*	$size - An integer holding what the size of the field is.
	*	$increment - A boolean value saying whether this field is to automatically increment or not.
	*	$default - The default value which this field will have.
	*
	**/
	function __construct($name, $type, $size = null, $increment = false, $default = false)
	{
		$this->name = $name;
		$this->type = $type;
		
		// If no size is given then, fallback to default value
		if($type=='int' && $size==null) $size = 11;
		elseif($type=='tinyint' && $size==null) $size = 1;
		elseif($type=='varchar' && $size==null) $size = 100;
		elseif($type=='text' && $size!=null) $size = null;
		
		$this->size = $size;
		if($increment) $this->primary = true;
		$this->increment = $increment;
		$this->fDefault = $default;
	}
	
	function output($con = null)
	{
		$type = $this->type;
		if($this->size!=null) $type .= '('.$this->size.')';
		if(!$this->isNull) $null = ' NOT';
		else $null = "";
		
		// Do we have a default value specified?
		if($this->fDefault!==false)
		{
			if(ini_get('magic_quotes_gpc')) $default = stripslashes($this->fDefault);
			$default = mysqli_real_escape_string($con, $this->fDefault);
			$default = " DEFAULT '{$default}'";	
		}
		else $default = "";
		
		// Do we want to automatically increment the value with each row?
		if($this->increment) $inc = ' AUTO_INCREMENT';
		else $inc = "";
		return "`{$this->name}` {$type}{$null} NULL{$default}{$inc}";
	}
}

final class Query
{
	// Add a locking system here..
	
	private $str = null;
	private $prefix = "";
	private $addition = false;
	private $tables = [];
	
	public function setPrefix($prefix) { $this->prefix = $prefix; }
	
	public function buildSelect($columns, $table, $where = null, $limit = null, $order = null, $options = array())
	{
		if(is_array($columns)) {
			$first = true;
			foreach($columns as $com) {
				if(!$first) $comstring .= ','.$com;
				else {
					$comstring = $com;
					$first = false;
				}
			}
			$columns = $comstring;
		} else $columns = '*';
		
		// Has a WHERE clause been provided?
		if($where==null) $where = '';
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Has a LIMIT clause been provided?
		if($limit==null) $limit = '';
		else $limit = " LIMIT {$limit}";
		
		// Does someone want this in a specific order?
		if($order==null) $order = '';
		elseif(is_array($order))
		{
			$ostring = " ORDER BY ";
			$last = count($order);
			$i = 1;
			foreach($order as $key => $item)
			{
				$ostring .= " {$key} {$item}";
				if($last!=$i) $ostring .= ",";
				$i++;
			}
			$order = $ostring;
		}
		else $order = " ORDER BY {$order}";
		
		if(isset($options, $options['distinct']) && $options['distinct']) $distinct = "DISTINCT ";
		else $distinct = "";
		
		if($this->addition) $this->str .= " SELECT {$distinct}{$columns} FROM {$this->prefix}{$table}{$where}{$order}{$limit}";
		else $this->str .= " SELECT {$distinct}{$columns} FROM {$this->prefix}{$table}{$where}{$order}{$limit}";
	}
	
	function buildJoin($table, $table2, $tmain, $tmain2, $where = null)
	{
		// Has a WHERE clause been provided?
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		if($this->addition) $this->str .= " LEFT JOIN {$this->prefix}{$table2} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}{$where}";
		else $this->str = " LEFT JOIN {$this->prefix}{$table2} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}{$where}";
	}
	
	function buildInnerJoin($table, $table2, $tmain, $tmain2, $where = null, $options = null)
	{
		// Has a WHERE clause been provided?
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Extra options..
		$h1 = $this->prefix.$table2;
		if($options==null) $options = "";
		else {
			if(!is_array($options)) $options = [$options];
			$o = "";
			foreach($options as $key => $value)
			{
				if($key=='post-keyword' && $value instanceof Query)
				{
					$res = $value->output();
					if($res!=null) $h1 = " ({$res})";
					$intables = $value->getTables();
					if(count($intables) > 0)
					{
						foreach($intables as $cols)
							$columns = str_replace("{$cols}.",$this->prefix.$cols.'.',$columns);
					}
					$value->flush();
				}
			}
			$options = &$o;
		}
		
		if($this->addition) $this->str .= " INNER JOIN {$h1} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}{$where}";
		else $this->str = " INNER JOIN {$h1} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}";
	}
	
	public function add()
	{
		$this->addition = true;
	}
	
	public function addTable($table)
	{
		$this->tables[] = $table;
	}
	
	public function getTables()
	{
		return $this->tables;
	}
	
	public function output() { return $this->str; }
	public function flush() { $this->str = null; $this->addition = false; }
}

final class AsyncResource
{
	public $db;
	public $main;
	
	public $id;
	public $executed = false;
	public $query;
	public $result = null;
	
	public $multi_query = false;
	
	public function __construct($query, $db, $main)
	{
		$this->query = $query;
		$this->db = $db;
		$this->main = $main;
	}
	
	public function execute()
	{
		if($this->executed) return false;
		$this->executed = true;
		
		$result = mysqli_query($this->db->getConnection(), $this->query, MYSQLI_ASYNC);
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->db->getConnection()), true);
			exit;
		}
		
		$this->db->count++;
	}
	
	// Coming Soon..
	public function poll()
	{
		return true;
		
		if(!$this->executed) $this->execute();
	}
	
	public function getResult()
	{
		if(!$this->executed) $this->execute();
		if($this->result!==null) return $this->result;
		
		$conpool = [$this->db->getConnection()];
		$error = [];
		$reject = [];
		if(!mysqli_poll($conpool, $error, $reject, 10))
			die("SQL Error: The polling period has timed out.");
		$this->result = mysqli_reap_async_query($this->db->getConnection());
		return $this->result;
	}
}

// The main database abstraction layer
final class database// implements int_database
{
	// The handle for the database connection
	public $con = null;
	
	// Name of the database engine
	public $engine = "mysqli";
	
	// Table prefix..
	public $prefix = "";
	protected $dbname = null;
	private $query = null;
	protected $main = null;
	
	// This is to count the number of queries
	public $count = 0;
	public $asyncQueue = [];
	public $asyncCount = 0;
	
	// Query builder..
	function __construct($main)
	{
		$this->main = $main;
		$this->query = new Query;
	}
	function getQuery() { return $this->query; }
	function getConnection() { return $this->con; }
	
	function connect($host,$user,$pass)
	{
		if(!$this->con = mysqli_connect($host,$user,$pass))
			die("Database Error: Unable to connect to the database.<br />
				May be due to a configuration issue or the database server itself.<br />
				<i>".mysqli_error()."</i>");
		return true;
	}
	
	/**
	*
	*	$name - The name of the database which you wish to select.
	*
	**/
	function select_db($name)
	{
		if(!mysqli_select_db($this->con,$name))
			die("Database Error: Unable to select the database.<br />
				May be due to a configuration issue or the database server itself.<br />
				<i>".mysqli_error($this->con)."</i>");
		$this->dbname = $name;
		return true;
	}
	
	function set_prefix($prefix = "")
	{
		$this->prefix = $prefix;
		$this->query->setPrefix($prefix);
	}
	
	function create_table($name,$fields,$primary = null)
	{
		$last = count($fields);
		$i = 1;
		$data = "";
		if(!is_array($fields)) $fields = [$fields];
		
		// Loop through the fields..
		foreach($fields as $field)
		{
			if($last!=$i) $data.= $field->output($this->con).',';
			else $data .= $field->output($this->con);
			if($field->primary && $primary==null) $primary = $field->name;
			$i++;
		}
		
		// Primary key..
		if($primary==null) $primary = "";
		else $primary = ", PRIMARY KEY ({$primary})";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$query = mysqli_query($this->con, "CREATE TABLE IF NOT EXISTS {$prefix}{$name} ({$data}{$primary}) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");
		$this->count++;
		if(!$query) {
			$error = $this->main->getErrors();
			$error->custom("Database Error: Unable to insert '{$prefix}{$name}' table into the database.\n<i>".mysqli_error($this->con)."</i>");
		}
		return $query;
	}
	
	/**
	*
	*	$table - The table which you wish to insert data into.
	*	$values - An array of values which you wish to insert into the table.
	*
	**/
	function insert($table,$values)
	{
		if(!is_array($values)) $values = array($values);
		$first = true;
		foreach($values as $key => $value)
		{
			if(!$first) {
				$columns .= ",`".$this->sanitise($key)."`";
				$content .= ",'".$this->sanitise($value)."'";
			} else {
				$columns = "`".$this->sanitise($key)."`";
				$content = "'".$this->sanitise($value)."'";
				$first = false;
			}
		}
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$query = mysqli_query($this->con, "INSERT INTO {$prefix}{$table} ({$columns}) VALUES ({$content})");
		$this->count++;
		if(!$query) {
			$error = $this->main->getErrors();
			$error->custom("Database Error: Unable to insert data into the {$prefix}{$table} table.\n<i>".mysqli_error($this->con)."</i>");
		}
		return $query;
	}
	
	/**
	*
	*	$table - The table which you wish to insert data into.
	*	$values - An array of values which you wish to insert into the table.
	*	$where - Existing column to delete.
	*
	**/
	function force_insert($table, $values, $where = null)
	{
		if($where!=null) $where = " WHERE {$where}";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = "";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$query = mysqli_query($this->con, "DELETE FROM {$prefix}{$table}{$where}");
		
		if(!is_array($values)) $values = array($values);
		$first = true;
		foreach($values as $key => $value)
		{
			if(!$first) {
				$columns .= ",".$this->sanitise($key);
				$content .= ",'".$this->sanitise($value)."'";
			} else {
				$columns = $this->sanitise($key);
				$content = "'".$this->sanitise($value)."'";
				$first = false;
			}
		}
		
		// Execute this..
		$query = mysqli_query($this->con, "INSERT INTO {$prefix}{$table} ({$columns}) VALUES ({$content})");
		$this->count++;
		if(!$query) {
			$error = $this->main->getErrors();
			$error->custom("Database Error: Unable to insert data into the {$prefix}{$table} table.\n<i>".mysqli_error($this->con)."</i>");
		}
		return $query;
	}
	
	function delete($table, $where = null)
	{
		if($where!=null) $where = " WHERE {$where}";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = "";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$query = mysqli_query($this->con, "DELETE FROM {$prefix}{$table}{$where}");
		$this->count++;
		if(!$query) {
			$error = $this->main->getErrors();
			$error->custom("Database Error: Unable to delete data into the {$prefix}{$table} table.\n<i>".mysqli_error($this->con)."</i>");
		}
		return $query;
	}
	
	/**
	*	May be deprecated when it's job is taken over by other more cross-engine methods.
	*	$query - The raw query which you wish to execute.
	*	$critical - Whether this is an important query to halt program execution over, if it fails.
	**/
	function query($query, $critical = false)
	{
		$result = mysqli_query($this->con, $query);
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), $critical);
		}
		trigger_error("You are not permitted to execute raw queries.", E_USER_DEPRECATED);
		$this->count++;
		return $result;
	}
	
	/**
	*	$query - The raw query which you wish to execute.
	*	$critical - Whether this is an important query to halt program execution over, if it fails.
	**/
	function __invoke($query)
	{
		$query = str_replace('{$prefix}',$this->prefix,$query);
		$result = mysqli_query($this->con, $query);
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
		}
		
		$this->count++;
		return $result;
	}
	
	function queue($query, $bulk = null)
	{
		// When the queue is empty, execute this immediately..
		$res = new AsyncResource($query, $this, $this->main);
		if(count($this->asyncQueue)==0) $res->execute();
		
		// Using asyncCount to emulate "truly asynchronous" queries..
		$this->asyncQueue[$this->asyncCount] = $res;
		$this->asyncCount++;
		
		if($bulk===true) $res->multi_query = true;
		return $res;
	}
	
	function reap_async(AsyncResource $res = null)
	{
		if($res==null) $res = $this->asyncQueue[$this->asyncCount];
		
		if($res->id!=0)
		{
			// Clear the backlog..
			$queue = &$this->asyncQueue;
			foreach($queue as $query)
			{
				if($query->id < $res->id) $query->getResult();
				else break;
			}
		}
		//unset() // Remove this from the queue.. TO-DO: Should we use a real queue for this..?
		return $res->getResult();
	}
	
	function poll(AsyncResource $res = null)
	{
		if($res==null) $res = $this->asyncQueue[$this->asyncCount];
		if(!$res instanceof AsyncResource) return false;
		
		if($res->id!=0)
		{
			foreach($queue as $query)
			{
				if($query->id < $res->id) $query->getResult();
				else break;
			}
		}
		$res->poll();
	}
	
	/*function pollAll()
	{
		$queue = &$this->asyncQueue;
		foreach($queue as $query)
		{
			$query->poll();
		}
	}*/
	
	function executeAll()
	{
		$queue = $this->asyncQueue;
		foreach($queue as $item) $item->getResult();
	}
	
	/**
	*
	*	$string - A string which you wish to sanitise in preparation for a query.
	*
	**/
	function sanitise($string)
	{
		if(ini_get('magic_quotes_gpc')) $string = stripslashes($string);
		$string = mysqli_real_escape_string($this->con,$string);
		return $string;
	}
	
	/**
	*
	*	$result - A MySQLi resource variable.
	*
	**/
	function num_rows($result) { return mysqli_num_rows($result); }
	
	function row_count($table, $row = '*', $where = null, $options = array())
	{
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Extra options..
		$h1 = "";
		if($options==null) $options = "";
		else {
			if(!is_array($options)) $options = array($options);
			$o = "";
			foreach($options as $key => $value)
			{
				if($key=='post-table' && $value instanceof Query)
				{
					$res = $value->output();
					if($res!=null) $h1 = ' '.$res;
					$intables = $value->getTables();
					if(count($intables) > 0)
					{
						foreach($intables as $cols) $columns = str_replace("{$cols}.",$this->prefix.$cols.'.',$columns);
					}
					if(!isset($options['noFlush']) || !$options['noFlush']) $options['post-table']->flush();
				}
			}
			$options = &$o;
		}
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$result = mysqli_query($this->con, "SELECT COUNT({$row}) AS count FROM {$prefix}{$table} AS {$table} {$where}{$h1}");
		$this->count++;
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		$data = mysqli_fetch_array($result, MYSQLI_ASSOC);
		if($data) return $data['count'];
		return 0;
	}
	
	/**
	*
	*	$columns - A variable holding a single column or an array of columns which you wish to fetch.
	*	$table - The table which you wish to fetch data from.
	*	$where - An optional parameter for specifying what conditions you wish for the content to match.
	*	$limit - Controls how many rows may be returned by the query.
	*	$order - The order in which the results are done in.
	*	$options - Additional options to use in this query.
	*	$critical - A true or false value over whether this is a query that is critical to the script's operation.
	*
	**/
	function get($columns, $table, $where = null, $limit = null, $order = null, $options = null)
	{
		if(is_array($columns)) {
			$first = true;
			$comstring = "";
			foreach($columns as $key => $com) {
				if(!$first) $comstring .= ',';
				if(!is_numeric($key)) $comstring .= "{$key} AS {$com}";
				else $comstring .= $com;
				
				$first = false;
			} $columns = $comstring;
		}
		
		// Has a WHERE clause been provided?
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Does someone want this in a specific order?
		if($order==null) $order = "";
		elseif(is_array($order))
		{
			$ostring = " ORDER BY ";
			$last = count($order);
			$i = 1;
			foreach($order as $key => $item)
			{
				$ostring .= " {$key} {$item}";
				if($last!=$i) $ostring .= ",";
				$i++;
			}
			$order = $ostring;
		}
		else $order = " ORDER BY {$order}";
		
		// Has a LIMIT clause been provided?
		if($limit!=null) $order .= " LIMIT {$limit}";
		
		// Extra options..
		$h1 = "";
		$async = false;
		if($options==null) $options = "";
		else {
			if(!is_array($options)) $options = array($options);
			if(isset($options['post-table']) && $options['post-table'] instanceof Query)
			{
				$res = $options['post-table']->output();
				if($res!=null) $h1 = ' '.$res;
				$intables = $options['post-table']->getTables();
				if(count($intables) > 0)
				{
					foreach($intables as $cols) $columns = str_replace("{$cols}.",$this->prefix.$cols.'.',$columns);
				}
				if(!isset($options['noFlush']) || !$options['noFlush']) $options['post-table']->flush();
			}
			if(isset($options, $options['distinct']) && $options['distinct']) $columns = "DISTINCT {$columns}";
			if(isset($options, $options['groupby']) && $options['groupby']) $where .= " GROUP BY {$options['groupby']} ";
			if(isset($options, $options['async']) && $options['async']) $async = true;
		}
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		if($async) $result = $this->queue("SELECT {$columns} FROM {$prefix}{$table} AS {$table}{$h1}{$where}{$order}");
		else
		{
			if(count($this->asyncQueue)!=0) $this->executeAll();
			$result = mysqli_query($this->con, "SELECT {$columns} FROM {$prefix}{$table} AS {$table}{$h1}{$where}{$order}");
			$this->count++;
		}
		
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		
		if(!$async)
		{
			// Grab the number of rows..
			$c = $this->num_rows($result);
			if($c==0) return 0;
			if($limit==1) return mysqli_fetch_array($result, MYSQLI_ASSOC);
			//if($c>1)
			else
			{
				$res = array();
				/*while($row = mysqli_fetch_array($result)) $res[] = $row;
				return $res;*/
				return mysqli_fetch_all($result, MYSQLI_ASSOC);
			}
		}
		return $result;
	}
	
	/**
	*
	*	$columns - A variable holding a single column or an array of columns which you wish to fetch.
	*	$table - The table which you wish to fetch data from.
	*	$table2 - The second table which we're trying to join.
	*	$tmain - The primary key which we're using as a unique identifier.
	*	$tmain2 - The Table 2 equivalent which corresponds to $tmain.
	*	$where - An optional parameter for specifying what conditions you wish for the content to match.
	*	$limit - Controls how many rows may be returned by the query.
	*	$order - The order in which the results are done in.
	*
	**/
	function join($columns, $table, $table2, $tmain, $tmain2, $where = null, $limit = null, $order = null, $options = array())
	{
		if(is_array($columns)) {
			$first = true;
			$comstring = "";
			foreach($columns as $key => $com) {
				if(!$first) $comstring .= ',';
				
				if(!is_numeric($key)) $comstring .= "{$key} AS {$com}";
				else $comstring .= $com;
				
				$first = false;
			} $columns = $comstring;
		}
		if($where==null) $where = "";
		elseif(is_array($where))
		{
			$wstring = " WHERE ";
			foreach($where as $key => $entry)
			{
				if($entry=="AND" && is_numeric($key)) $wstring .= " AND ";
				elseif($entry=="OR" && is_numeric($key)) $wstring .= " OR ";
				else $wstring .= $key."='{$entry}'";
			}
			$where = $wstring;
		} else $where = " WHERE {$where}";
		
		if($limit==null) $limit = "";
		else $limit = " LIMIT {$limit}";
		
		// Does someone want this in a specific order?
		if($order==null) $order = "";
		elseif(is_array($order))
		{
			$ostring = " ORDER BY";
			$last = count($order);
			$i = 1;
			foreach($order as $key => $item)
			{
				$ostring .= " {$key} {$item}";
				if($last!=$i) $ostring .= ",";
				$i++;
			}
			$order = $ostring;
		} else $order = " ORDER BY {$order}";
		
		$async = false;
		$distinct = '';
		if(isset($options))
		{
			if(isset($options['distinct']) && $options['distinct']) $distinct = "DISTINCT ";
			if(isset($options['async']) && $options['async']) $async = true;
		}
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		if($async) $result = $this->queue("SELECT {$distinct}{$columns} FROM {$prefix}{$table} AS {$table} LEFT JOIN {$prefix}{$table2} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}{$where}{$order}{$limit}");
		else
		{
			if(count($this->asyncQueue)!=0) $this->executeAll();
			$result = mysqli_query($this->con, "SELECT {$distinct}{$columns} FROM {$prefix}{$table} AS {$table} LEFT JOIN {$prefix}{$table2} AS {$table2} ON {$table}.{$tmain}={$table2}.{$tmain2}{$where}{$order}{$limit}");
			$this->count++;
		}
		
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		if(!$async)
		{
			$c = $this->num_rows($result);
			if($c==0) return 0;
			/*if($c>1) {
				$res = array();
				while($row = mysqli_fetch_array($result)) $res[] = $row;
				$result = &$res;
			} else $result = mysqli_fetch_array($result);*/
			if($limit==" LIMIT 1") return mysqli_fetch_array($result, MYSQLI_ASSOC);
			else return mysqli_fetch_all($result, MYSQLI_ASSOC);
		}
	}
	
	/**
	*
	*	Optimal for three joins. Use the query builder for more.
	*
	*	$columns - A variable holding a single column or an array of columns which you wish to fetch.
	*	$tables - The tables which you wish to fetch data from.
	*	$tmain - An array of primary keys which you wish to use as identifiers.
	*	$where - An optional parameter for specifying what conditions you wish for the content to match.
	*	$limit - Controls how many rows may be returned by the query.
	*	$order - The order in which the results are done in.
	*
	**/
	function super_join($columns, $tables, $tmain, $where = null, $limit = null, $order = null, $options = array())
	{
		$snippet = "";
		$first = true;
		$rtables = array();
		$rrtables = array();
		foreach($tables as $key => $table)
		{
			$rtables[] = "#{$table}.#";
			$rrtables[] = "{$this->prefix}{$table}.";
			if($first) {
				$snippet .= "{$this->prefix}{$table} AS {$table}";
				$first = false;
			} else {
				$cur = $tmain[$tables[$key - 1]];
				if(is_array($cur)) $snippet .= " LEFT JOIN {$this->prefix}{$table} AS {$table} ON ".$tables[$key - 1].".".$cur[$table]."={$table}.{$tmain[$table]}";
				elseif(is_array($tmain[$table]) && isset($tmain[$tables[$key - 1]]))
					$snippet .= " LEFT JOIN {$this->prefix}{$table} AS {$table} ON ".$tables[$key - 1].".{$cur}={$table}.".$tmain[$tables[$key - 1]];
				else $snippet .= " LEFT JOIN {$this->prefix}{$table} AS {$table} ON ".$tables[$key - 1].".{$cur}={$table}.{$tmain[$table]}";
			}
		}
		
		if(is_array($columns)) {
			$first = true;
			foreach($columns as $key => $com) {
				if(!$first) $comstring .= ','.$com;
				else {
					if(!is_numeric($key)) $comstring = "{$key} AS {$com}";
					else $comstring = $com;
					$first = false;
				}
			} $columns = $comstring;
		}
		if($where==null) $where = "";
		elseif(is_array($where))
		{
			$wstring = " WHERE ";
			foreach($where as $key => $entry)
			{
				if($entry=="AND") $wstring .= " AND ";
				elseif($entry=="OR") $wstring .= " OR ";
				else $wstring .= $key."='{$entry}'";
			}
			$where = $wstring;
		}
		else $where = " WHERE {$where}";
		if($limit==null) $limit = "";
		else $limit = " LIMIT {$limit}";
		
		// Does someone want this in a specific order?
		if($order==null) $order = "";
		elseif(is_array($order))
		{
			$ostring = " ORDER BY";
			$last = count($order);
			$i = 1;
			foreach($order as $key => $item)
			{
				$ostring .= " {$key} {$item}";
				if($last!=$i) $ostring .= ",";
				$i++;
			}
			$order = $ostring;
		}
		else $order = " ORDER BY {$order}";
		
		$async = false;
		$distinct = "";
		if(isset($options))
		{
			if(isset($options['distinct']) && $options['distinct']) $distinct = "DISTINCT ";
			if(isset($options['async']) && $options['async']) $async = true;
		}
		
		// Execute this..
		if($async) $result = $this->queue("SELECT {$distinct}{$columns} FROM {$snippet}{$where}{$order}{$limit}");
		else
		{
			if(count($this->asyncQueue)!=0) $this->executeAll();
			$result = mysqli_query($this->con, "SELECT {$distinct}{$columns} FROM {$snippet}{$where}{$order}{$limit}");
			$this->count++;
		}
		
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		
		if(!$async)
		{
			$c = $this->num_rows($result);
			if($c==0) return 0;
			if($c>1) {
				$res = array();
				$count = false;
				while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) $res[] = $row;
				$result = &$res;
			} else $result = mysqli_fetch_array($result, MYSQLI_ASSOC);
		}
		return $result;
	}
	
	/**
	*
	*	$result - A MySQLi resource variable.
	*
	**/
	function fetch_array($result, $type = MYSQLI_ASSOC) { return mysqli_fetch_array($result, $type); }
	
	function fetch_all($result, $type = MYSQLI_ASSOC) { return mysqli_fetch_all($result, $type); }
	
	/**
	*
	*	$result - A MySQLi resource variable.
	*
	**/
	function loop($result, $type = MYSQLI_ASSOC)
	{
		$data = array();
		while($row = mysqli_fetch_array($result, $type)) $data[] = $row;
		return $data;
	}
	
	/**
	*
	*	$table - The name of the table which you wish to query.
	*	$update - A string containing the data which is being updated.
	*	$where - A string holding the location of the data which you wish to update.
	*	$critical - A true or false value over whether this is a query that is critical to the script's operation.
	*
	**/
	function update($table, $update, $where = null, $shutdown = false)
	{
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		if($shutdown) return register_shutdown_function(function($con) use($prefix, $table, $update, $where) 
		{
			$result = mysqli_query($con, "UPDATE {$prefix}{$table} SET {$update}{$where}");
			$this->count++;
			if(!$result) {
				$error = $this->main->getErrors();
				$error->query(mysqli_error($con), true);
			}
		}, $this->con);
		else $result = mysqli_query($this->con, "UPDATE {$prefix}{$table} SET {$update}{$where}");
		$this->count++;
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
		}
		return $result;
	}
	
	/**
	*
	*	$table - The name of the table which you wish to query.
	*	$update - A string containing the data which is being updated.
	*	$where - A string holding the location of the data which you wish to update.
	*	$current - A string holding the value of the field before updating.
	*
	**/
	function diff_update($table, $update, $where = null, $current = false)
	{
		// Has someone not provided the current state?
		if($current)
		{
			// Let's split this into two bits..
			$up = explode("=", $update);
			
			// Did someone forget to use equals?
			if(!isset($up[1])) {
				$error = $this->main->getErrors();
				$error->query('There was no assignment operator in the $update variable', true);
				return false;
			}
			$new = &$up[1];
			
			// Strip all three kinds of string delimiters..
			$new = str_replace(array("'",'"','`'),'', $new);
			
			// Is it the same? Abort the function then.
			if($new==$current) return false;
		}
		
		// Has someone provided which areas to update?
		if($where==null) $where = "";
		elseif(is_array($where)) $where = parseWhere($where);
		else $where = " WHERE {$where}";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Run this query..
		$result = mysqli_query($this->con, "UPDATE {$prefix}{$table} SET {$update}{$where}");
		
		// Increment this..
		$this->count++;
		
		if(!$result) {
			$error = $this->main->getErrors();
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		
		return $result;
	}
	
	/**
	*
	*	$table - The name of the table which you wish to bulk query.
	*	$update - A multi-dimensional array holding each update to be executed in array form.
	*	$shutdown - A true or false value over whether this is a query which will be run after everything else.
	*
	**/
	function bulk_update($table, $update, $shutdown = false)
	{
		if(!is_array($update)) $update = array($update);
		$query = "";
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		$last = count($update);
		$i = 0;
		
		// Loop through the queries..
		foreach($update as $up)
		{
			$i++;
			if(!isset($up['where'])) $up['where'] = "";
			elseif(is_array($up['where'])) $up['where'] = parseWhere($up['where']);
			else $up['where'] = " WHERE {$up['where']}";
			$query .= "UPDATE {$prefix}{$table} SET {$up['data']}{$up['where']}";
			if($last!=$i) $query .= ';';
		}
		
		// Execute this..
		if($shutdown) register_shutdown_function(function($con, $query) use($prefix, $table){
			$result = mysqli_multi_query($this->con, $query);
			while(mysqli_more_results($con)) mysqli_next_result($con);
			$this->count++;
			if(mysqli_error($this->con)) $this->main->getErrors()->query(mysqli_error($con), true);
		}, $this->con);
		else {
			$result = mysqli_multi_query($this->con, $query);
			while(mysqli_more_results($this->con)) mysqli_next_result($this->con);
			$this->count++;
			if(mysqli_error($this->con)) {
				$error = $this->main->getErrors();
				$error->query(mysqli_error($this->con), true);
			}
		}
	}
	
	/*function bulk_select()
	{
		
	}*/
	
	// Check whether this table exists..
	public function exists($name)
	{
		$this->count++;
		if(!mysqli_query($this->con, "SELECT '{$this->prefix}{$name}' FROM information_schema.tables WHERE table_schema = '{$this->dbname}' AND table_name = '{$this->prefix}{$name}';"))
			return false;
		return true;
	}
	
	public function addColumn($table, $column, $type, $order = null)
	{
		$error = $this->main->getErrors();
		
		if($order==null) $order = "";
		else $order = ' '.$order;
		
		$this->count++;
		if(!$query = mysqli_query($this->con, "ALTER TABLE '{$this->prefix}{$table}' ADD '{$column}' {$type}{$order};")) return false;
		{
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		return true;
	}
	
	public function removeColumn($table, $column)
	{
		$error = $this->main->getErrors();
		$this->count++;
		if(!$query = mysqli_query($this->con, "ALTER TABLE '{$this->prefix}{$table}' DROP '{$column}';"))
		{
			$error->query(mysqli_error($this->con), true);
			return false;
		}
		return true;
	}
	
	public function columnExists($table, $column)
	{
		$this->count++;
		if(!mysqli_query("SELECT * FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = '{$this->dbname}' AND TABLE_NAME = '{$this->prefix}{$table}' AND COLUMN_NAME = '{$column}';", $this->con))
			return false;
		return true;
	}
	
	public function getColumns($table)
	{
		$this->count++;
		return mysqli_query("SHOW COLUMNS FROM {$this->prefix}{$table}",$this->con);
	}
	
	// Get the ID for the last row which was inserted.
	function last_id() { return mysqli_insert_id($this->con); }
	
	// Is this really needed as we have an error handler.
	function error() { return mysqli_error($this->con); }
	
	// Make sure the connection is closed when the object is destroyed
	function __destruct() { mysqli_close($this->con); }
}