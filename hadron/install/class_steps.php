<?php
/**
*	
*	Hadron Framework: Installation System: Simple Steps Class
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*	
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

class Steps
{
	protected $sDefault = "start";
	protected $current;
	protected $steps = array();
	protected $install = null;
	
	function __construct($current)
	{
		if(empty($current)) $current = $this->sDefault;
		$this->current = $current;
	}
	
	function setInstaller($install)
	{
		$this->install = &$install;
	}
	
	function setDefault($step = "start")
	{
		$this->sDefault = $step;
	}
	
	function getDefault()
	{
		return $this->sDefault;
	}
	
	function addStep($name, $callback)
	{
		$this->steps[$name] = $callback;
	}
	
	function __invoke() { $this->output(); }
	
	public function getCurrent()
	{
		return $this->current;
	}
	
	public function getStep($step)
	{
		return $this->steps[$step];
	}
	
	public function output(&$install)
	{
		$steps = $this->steps;
		
		// Initialize these..
		$after = false;
		$nav = "";
		
		// Loop through the steps..
		foreach($steps as $key => $value)
		{
			if(!$after && $key!=$this->current) $nav .= $install->addNav($key, false, false);
			elseif(!$after)
			{
				$after = true;
				$nav .= $install->addNav($key, true, false);
			} else $nav .= $install->addNav($key, false, true);
		}
		
		return $nav;
	}
}