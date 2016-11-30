<?php
/**
*	
*	Hadron Framework: Installation Class
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017.
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

// Base directories..
define("HADRON_INSTALL_BASE", dirname(__FILE__));
define("HADRON_BASE", dirname(HADRON_INSTALL_BASE));
require_once(HADRON_INSTALL_BASE."/class_templates.php");
require_once(HADRON_INSTALL_BASE."/class_language.php");
require_once(HADRON_INSTALL_BASE."/class_steps.php");

class Installer
{
	protected $tmpls = null;
	protected $lang = null;
	protected $steps = null;
	protected $db = null;
	protected $events = array();
	
	function __construct($lang = "english")
	{
		$tmpls = new Templates;
		$tmpls->load();
		$lang = new Language($tmpls,$lang);
		
		// Is this the first step?
		if(empty($_GET['step'])) $step = "start";
		else $step = $_GET['step'];
		
		$steps = new Steps($step);
		$steps->setInstaller($this);
		
		$this->tmpls = &$tmpls;
		$this->lang = &$lang;
		$this->steps = &$steps;
	}
	
	public function __get($name)
	{
		if($name=="input") return $_REQUEST;
		elseif($name=="cookie") return $_COOKIE;
		else return null;
	}
	
	public function input($name)
	{
		if(!isset($_REQUEST[$name]) || empty($_REQUEST[$name])) return "";
		return $_REQUEST[$name];
	}
	
	public function init()
	{
		if(file_exists(HADRON_INSTALL_BASE."/lock")) { $this->events['lock']($this->tmpls); exit; }
		if(!extension_loaded("mysql") && !extension_loaded("mysqli")) { $this->events['dbexts']($this->tmpls); exit; }
	}
	
	public function getTemplates()
	{
		return $this->tmpls;
	}
	
	public function getLanguage()
	{
		return $this->lang;
	}
	
	public function getDatabase()
	{
		return $this->db;
	}
	
	public function addStep($name, $callback)
	{
		$this->steps->addStep($name,$callback);
	}
	
	public function getSteps()
	{
		return $this->steps();
	}
	
	public function bind($event, $callback)
	{
		$this->events[$event] = $callback;
	}
	
	public function release($event)
	{
		unset($this->events[$event]);
	}
	
	public function execute($event)
	{
		$this->events[$event]($this);
	}
	
	public function lock()
	{
		fopen(HADRON_INSTALL_BASE."/lock","w");
	}
	
	public function unlock()
	{
		unlink(HADRON_INSTALL_BASE."/lock");
	}
	
	public function addNav($step, $current, $after)
	{
		if($current) $key = 'current';
		elseif(!$after) $key = 'done';
		else $key = "s";
		
		return "<div id='{$step}Nav' class='{$key}Nav'>".$this->lang->get("nav_{$step}")."</div>";
	}
	
	public function loadConfig($path, $var = "config")
	{
		$exists = file_exists($path);
		if(!$exists) return false;
		require_once($path);
		return $$var;
	}
	
	public function writeFile($path, $content = "")
	{
		if(is_writeable($path) || (!file_exists($path) && is_writeable(dirname($path))) || @chmod($path,0666))
		{
			// Create the file handle
			$hd = fopen($path,"w");
			
			// Write to the file
			fwrite($hd, $content);
			
			// Close the handle
			fclose($hd);
			
			return true;
		}
		return false;
	}
	
	public function loadDBEngine($engine = "mysqli")
	{
		switch($engine)
		{
			case "mysqli": $str = $engine; break;
			default:  $str = "mysqli";
		}
		
		require_once(HADRON_INSTALL_BASE."/database/class_{$engine}.php");
		$engine = "Hadron\\".$engine."DB";
		$db = new $engine($this);
		$this->db = &$db;
		return $db;
	}
	
	public function redirect($dest)
	{
		//$dest = urlencode($dest);
		header("Location: {$dest}");
		die("<meta http-equiv='refresh' content='0;url={$dest}' />");
	}
	
	public function getPath()
	{
		// Get the current path..
		$uri = $_SERVER['REQUEST_URI'];
		$ex = explode('/',$uri);
		$c = count($ex);
		
		// Build the default path..
		if($c==2) $dPath = "/";
		else {
			$dPath = "";
			$i = 1;
			foreach($ex as $e)
			{
				if($i==$c || ($c-1)==$i) break;
				if($i!=1) $dPath .= '/';
				$dPath .= $e;
				$i = $i + 1;
			}
			$dPath .= '/';
		}
		return $dPath;
	}
	
	function __destruct()
	{
		$steps = &$this->steps;
		$tmpls = &$this->tmpls;
		
		$call = $steps->getStep($steps->getCurrent());
		$call($this);
		$tmpls->assign("nav", $steps->output($this));
		
		echo $tmpls->main;
	}
}