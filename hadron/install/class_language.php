<?php
/**
*
*	Hadron Framework: Installation System: Simple Language Class
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

class Language
{
	public $language;
	protected $data = array();
	
	function __construct($tmpls, $language = "english")
	{
		// Does the language pack exist?
		if(file_exists(HADRON_BASE."/languages/{$language}.php")) $this->language = $language;
		else $this->language = "english";
		
		// Load the language file..
		require_once(HADRON_BASE."/languages/english.php");
		$this->data = &$l;
		
		// Assign this..
		$tmpls->assign("lang", $this->data);
	}
	
	function get($name)
	{
		return $this->data[$name];
	}
	
	function __get($name)
	{
		return $this->data[$name];
	}
	
	function sub($name, $data)
	{
		return str_replace("$1", $data, $this->data[$name]);
	}
	
	function multi_sub($name, $data)
	{
		$str = $this->data[$name];
		$i = 1;
		foreach($data as $item)
		{
			$str = str_replace('$'.$i, $item ,$str);
			$i++;
		}
		return $str;
	}
	
	function rand($name)
	{
		if(!is_array($this->data[$name])) return false;
		return array_rand($this->data[$name]);
	}
	
	function set($name, $data)
	{
		$this->data[$name] = $data;
	}
	
	function __set($name, $data)
	{
		$this->data[$name] = $data;
	}
	
	function exists($name)
	{
		return isset($this->data[$name]);
	}
	
	function __isset($name)
	{
		return isset($this->data[$name]);
	}
}