<?php
/*
	Hadron Framework: Error Handling Object.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2017
*/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class Error
{
	protected $log = [];
	protected $devmode = 0;
	protected $main = null;
	
	public function __construct(Container $main)
	{
		$this->main = $main;
	}
	
	public function setDevMode($switch)
	{
		$this->devmode = $switch;
	}
	
	function query($msg, $critical = false)
	{
		trigger_error($msg,E_USER_ERROR);
		if($critical && $this->devmode==1) {
			echo "Failed to execute query: {$msg}.\n<br />Backtrace: ";
			debug_print_backtrace();
			exit;
		} elseif($critical) {
			header("HTTP/1.1 500 Internal Server Error");
			die("Failed to execute query: {$msg}");
		}
		else $this->log[] = "Failed to execute query: {$msg}";
	}
	
	function custom($msg, $critical = false)
	{
		if($critical && $this->devmode==1) {
			echo "{$msg}\n<br />Backtrace: ";
			debug_print_backtrace();
			exit;
		} elseif(!$critical) {
			header("HTTP/1.1 500 Internal Server Error");
			die($msg);
		}
		else $this->log[] = $msg;
	}
	
	function raw($msg) { $this->log[] = $msg; }
	
	function getError($type, $msg = null)
	{
		$plugins = $this->main->getPlugins();
		
		// Does the page not exist?
		if($type==404) return $plugins->hook("error_404", $msg);
		
		// Not have permission to view this page?
		elseif($type==403) return $plugins->hook("error_403", $msg);
		
		// An error in the server itself?
		elseif($type==500) return $plugins->hook("error_500", $msg);
		return false;
	}
	
	function pop($offset = false)
	{
		if($offset) return $this->log[$offset];
		if(count($this->log)==0) die($this->getError(500,"An unknown error was detected."));
		$index = count($this->log) - 1;
		$log = $this->log[$index];
		unset($this->log[$index]);
		return $log;
	}
	
	function output($offset = false)
	{
		if($offset) echo $this->log[$offset];
		elseif(count($this->log)!=0) {
			$log = $this->log;
			foreach($log as $l) echo $l."<br />\n";
			$this->log = [];
		}
	}
	
	// Make sure errors are always outputted..
	function __destruct()
	{
		if(count($this->log)!=0)
		{
			$log = $this->log;
			foreach($log as $l) echo $l."<br />\n";
		}
	}
}