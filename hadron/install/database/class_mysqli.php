<?php
/*
	Installer MySQL Improved Database Class.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2017
*/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

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
		if($this->fDefault!==false && $type!='text')
		{
			if(ini_get('magic_quotes_gpc')) $default = stripslashes($this->fDefault);
			$default = mysqli_real_escape_string($con, $this->fDefault);
			$default = " DEFAULT '{$default}'";	
		}
		elseif($this->fDefault==='' && $type=='text') $null = '';
		else $default = "";
		// Do we want to automatically increment the value with each row?
		if($this->increment) $inc = ' AUTO_INCREMENT';
		else $inc = "";
		return "`{$this->name}` {$type}{$null} NULL{$default}{$inc}";
	}
}

final class mysqliDB
{
	// The handle for the database connection
	public $con = null;
	
	// Name of the database engine
	public $engine = "mysqli";
	
	// Any errors?
	public $error = false;
	
	// Table prefix..
	public $prefix = "";
	
	// This is to count the number of queries
	public $count = 0;
	private $install = null;
	
	function __construct(&$install)
	{
		$this->install = &$install;
	}
	
	function connect($host,$user,$pass)
	{
		if(!$this->con = @mysqli_connect($host,$user,$pass)) return false;
		return true;
	}
	
	/**
	*
	*	$name - The name of the database which you wish to select.
	*
	**/
	function select_db($name)
	{
		if(!@mysqli_select_db($this->con,$name)) return false;
		return true;
	}
	
	function set_prefix($prefix)
	{
		$this->prefix = $prefix;
	}
	
	function create_table($name,$fields,$primary = null, $error = true)
	{
		$last = count($fields);
		$i = 1;
		$data = "";
		if(!is_array($fields)) $fields = array($fields);
		
		// Loop through the fields..
		foreach($fields as $field)
		{
			if($last!=$i) $data.= $field->output($this->con).",";
			else $data .= $field->output($this->con);
			if($field->primary && $primary==null) $primary = $field->name;
			$i++;
		}
		if($primary==null) $primary = "";
		else $primary = ", PRIMARY KEY ({$primary})";
		
		// Table prefix
		$prefix = &$this->prefix;
		
		// Execute the query..
		$query = mysqli_query($this->con,"CREATE TABLE IF NOT EXISTS {$prefix}{$name} ({$data}{$primary}) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;");
		$this->count++;
		
		if(!$query) {
			$tmpls = $this->install->getTemplates();
			$tmpls->assign('title','Installer - Table Creation Error');
			$tmpls->assign('content',"<h1>Table Creation Error</h1>
			<p>An error has occured while attempting to insert the '{$this->prefix}{$name}' table into the database.<br />
			The query that failed is: 'CREATE TABLE IF NOT EXISTS {$prefix}{$name} ({$data}{$primary}) ENGINE=MyISAM DEFAULT CHARSET=utf8 ;'<br />
			<i>".mysqli_error($this->con)."</i></p>");
			die($tmpls->main);
		}
		return $query;
	}
	
	/**
	*
	*	$table - The table which you wish to insert data into.
	*	$values - An array of values which you wish to insert into the table.
	*	$error - Whether the calling script has it's own error handler.
	*
	**/
	function insert($table,$values, $error = true)
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
		$prefix = &$this->prefix;
		
		// Execute this..
		$query = mysqli_query($this->con,"INSERT INTO {$prefix}{$table} ({$columns}) VALUES ({$content})");
		$this->count++;
		
		if(!$query) {
			$tmpls = $this->install->getTemplates();
			$tmpls->assign('title','Installer - Data Insertion Error');
			$tmpls->assign('content',"<h1>Data Insertion Error</h1>
			<p>An error has occured while attempting to insert data into the '{$this->prefix}{$table}' table.<br />
			The query that failed is: 'INSERT INTO {$prefix}{$table} ({$columns}) VALUES ({$content})'<br />
			<i>".mysqli_error($this->con)."</i></p>");
			die($tmpls->main);
		}
		return $query;
	}
	/**
	*	Why is this still here?
	*	$query - The raw query which you wish to execute.
	**/
	function query($query) { $this->count++; return $this->error = mysqli_query($query); }
	
	/**
	*
	*	A method which is used to sanitise data prior to using it in a database query.
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
	*	$result - A MySQL resource variable.
	*
	**/
	function num_rows($result) { return mysqli_num_rows($result); }
	
	/**
	*
	*	$columns - A variable holding a single column or an array of columns which you wish to fetch.
	*	$table - The table which you wish to fetch data from.
	*	$where - An optional parameter for specifying what conditions you wish for the content to match.
	*	$limit - Controls how many rows may be returned by the query.
	*	$order - The order in which the results are done in.
	*	$options - Additional options to use in this query.
	*
	**/
	function get($columns, $table, $where = null, $limit = null, $order = null, $options = null)
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
		}
		// Has a WHERE clause been provided?
		if($where==null) $where = "";
		else $where = " WHERE {$where}";
		
		// Has a LIMIT clause been provided?
		if($limit==null) $limit = "";
		else $limit = " LIMIT {$limit}";
		
		// Does someone want this in a specific order?
		if($order==null) $order = "";
		else $order = " ORDER BY {$order}";
		
		// Extra options..
		if($options==null) $options = "";
		else {
			if(!is_array($options)) $options = array($options);
			$o = "";
			foreach($options as $option) $o .= $option;
			$options = &$o;
		}
		
		// Table prefix..
		$prefix = &$this->prefix;
		
		// Execute this..
		$result = mysqli_query($this->con,"SELECT {$columns} FROM {$prefix}{$table}{$where}{$order}{$limit}{$options}");
		$this->count++;
		if(!$result) $this->outputError();
		$c = $this->num_rows($result);
		if($c==0) return 0;
		if($c>1) {
			$res = array();
			$count = false;
			while($row = mysqli_fetch_array($result)) $res[] = $row;
			$result = &$res;
		} else $result = mysqli_fetch_array($result);
		return $result;
	}
	
	public function error()
	{
		if(!$this->con) return mysqli_connect_error();
		return mysqli_error($this->con);
	}
	
	function outputError($critical = false)
	{
		header("HTTP/1.1 500 Internal Server Error");
		$tmpls = $this->install->getTemplates();
		$tmpls->assign('title',"Hadron Installer - Query Error");
		$tmpls->assign('content',"<h2>Query Error</h2><br />
		<p>An error has occured while attempting to insert the default data into the database.<br />
		<i>".mysqli_error($this->con)."</i></p>");
		die($tmpls->main);
	}
	
	function insert_id() { return mysqli_insert_id($this->con); }
	function __destruct() { if($this->con) mysqli_close($this->con); }
}