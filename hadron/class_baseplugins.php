<?php
/**
*
*	Hadron Framework: Base Plugin Class.
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class Lock { }

class Plugin
{
	protected $hooks = [];
	protected $perms = [];
	
	function __construct($perms = '')
	{
		if(empty($perms)) $perms = [];
		$this->perms = $perms;
	}
	
	public function add($name, $callback)
	{
		$this->hooks[$name] = $callback;
	}
	
	public function run($name, &$vars1 = null, &$vars2 = null, &$vars3 = null, &$vars4 = null, &$vars5 = null)
	{
		return $this->hooks[$name]($vars1,$vars2,$vars3,$vars4,$vars5);
	}
	
	public function check($name)
	{
		if(isset($this->perms[$name]) && $this->perms[$name]==1) return true;
		return false;
	}
}

class BasePlugins
{
	protected $plugins = [];
	protected $runQueue = [];
	protected $current = null;
	protected $nohooks = false;
	
	public function __construct()
	{
		$this->plugins = [];
		$this->runQueue = [];
		$this->nohooks = false;
	}
	
	public function hook($name, &$vars1 = null, &$vars2 = null, &$vars3 = null, &$vars4 = null, &$vars5 = null)
	{
		if(isset($this->runQueue[$name]) && count($this->runQueue[$name])!=0)
		{
			$queue = $this->runQueue[$name];
			foreach($queue as $plugin) $ret = $this->plugins[$plugin]->run($name,$vars1,$vars2,$vars3,$vars4,$vars5);
			return $ret;
		}
		return null;
	}
	
	public function bind($name, $callback)
	{
		if($this->nohooks) return;
		
		$current = &$this->plugins[$this->current];
		$current->add($name, $callback);
		$this->runQueue[$name][] = $this->current;
	}
	
	public function loadPluginFromArray($name, $autoclose = false, $callback = null)
	{
		$this->plugins[$name] = new Plugin;
		
		// Switch the current context to this plugin..
		$this->current = $name;
		if($callback!=null) $exec($this);
		if($autoclose) $this->current = null;
	}
	
	public function dump()
	{
		return [
			'plugins' => $this->plugins,
			'runQueue' => $this->runQueue,
			'nohooks' => $this->nohooks
		];
	}
}