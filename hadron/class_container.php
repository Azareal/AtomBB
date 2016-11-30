<?php
/*
	Hadron Framework: Container Class.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2017
*/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

if(!defined('HADRON_BASE')) define("HADRON_BASE", dirname(__FILE__));
if(!defined('ONE_HOUR')) define("ONE_HOUR", 60 * 60);
if(!defined('ONE_DAY')) define("ONE_DAY", 60 * 60 * 24);
if(!defined('ONE_MONTH')) define("ONE_MONTH", 60 * 60 * 24 * 31);
require_once(HADRON_BASE."/class_error.php");
require_once(HADRON_BASE."/database/int_database.php");
require_once(HADRON_BASE."/class_templates.php");
require_once(HADRON_BASE."/class_baseplugins.php");
require_once(HADRON_BASE."/class_language.php");
require_once(HADRON_BASE."/class_cache.php");

class Container
{
	public $settings = [];
	//public $group_schema = []; // The schema for the group table..
	protected $db = null;
	protected $tmpls = null;
	protected $plugins = null;
	protected $langs = null;
	protected $cache = null;
	protected $error = null;
	
	protected $worker = null; // Pthreads support...?
	protected $tasks = null;
	
	public function __construct()
	{
		$this->error = new Error($this);
		$this->plugins = new BasePlugins;
		$this->settings = ['cache_templates' => true,'cache_expiry' => ONE_MONTH];
	}
	
	public function init(array $config = [])
	{
		// Go through the available database engines
		switch($config['database_engine'])
		{
			case "mysqli": $engine = "mysqli"; break;
			default: $engine = 'mysqli';
		}
		
		// Load up the database class
		require_once(HADRON_BASE."/database/class_{$engine}.php");
		$this->db = new Database($this);
		$this->db->connect($config['database_host'], $config['database_username'], $config['database_password']);
		$this->db->select_db($config['database_name']);
		$this->db->set_prefix($config['table_prefix']);
		
		$this->tmpls = new Templates($this);
		$this->plugins->hook("hadron_start");
		
		$this->cache = new Cache($this, $config);
		
		if(extension_loaded('pthreads'))
		{
			require_once(HADRON_BASE."/threading.php");
			$this->worker = new HadronWorker;
			$this->tasks = [];
		}
	}
	
	public function initLang($lang, $path = null, $dir = null)
	{
		if($path==null) $path = dirname(HADRON_BASE."/languages");
		$this->langs = new Language($this, $path, $lang, $dir);
	}
	
	public function setPluginHandler($plugins)
	{
		$this->plugins = $plugins;
	}
	
	public function getDatabase()
	{
		if($this->db==null) return false;
		return $this->db;
	}
	
	public function getTemplates()
	{
		if($this->tmpls==null) return false;
		return $this->tmpls;
	}
	
	public function getPlugins()
	{
		if($this->plugins==null) return false;
		return $this->plugins;
	}
	
	public function getLanguages()
	{
		if($this->langs==null) return false;
		return $this->langs;
	}
	
	public function getCache()
	{
		if($this->cache==null) return false;
		return $this->cache;
	}
	
	public function getErrors()
	{
		if($this->error==null) return false;
		return $this->error;
	}
	
	public function addShutdownEvent($callback)
	{
		register_shutdown_function($callback);
	}
	
	public function addParallelTask($callback)
	{
		if(extension_loaded('pthreads'))
		{
			$this->worker->stack($this->tasks[] = new HadronTask($callback));
			$this->worker->start();
		}
		else register_shutdown_function($callback, false);
	}
	
	public function runParallelTask($callback)
	{
		$tid = count($this->tasks) - 1;
		if(extension_loaded('pthreads'))
		{
			
			$this->worker->stack($this->tasks[$tid] = new HadronTask($callback));
			$this->worker->start();
		}
		else $this->tasks[$tid] = $callback(false);
		return $tid;
	}
	
	public function pollParallelTask($tid)
	{
		if(!$this->tasks[$tid] instanceof HadronTask) return $this->tasks[$tid]->getResult();
		return $this->tasks[$tid];
		// finish this later
	}
	
	public function waitForParallelTask($tid)
	{
		if(!$this->tasks[$tid] instanceof HadronTask)
		{
			$this->tasks[$tid]->wait();
			return $this->tasks[$tid]->getResult();
		}
		return $this->tasks[$tid];
	}
	
	function __destruct()
	{
		$this->cache->commit();
	}
}