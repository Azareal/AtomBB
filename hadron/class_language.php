<?php
/**
*
*	Hadron Framework: Language Handling Object.
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class Language
{
	public $language;
	protected $data = [];
	public $dir = "";
	protected $main = null;
	protected $path = null;
	
	function __construct(Container $main, $path, $language = "english", $dir = "")
	{
		$this->main = $main;
		$this->path = $path;
		$plugins = $main->getPlugins();
		
		// Does the language pack exist?
		if(is_dir("{$path}/{$language}{$dir}")) $this->language = $language;
		
		// Does a plugin want to change this?
		elseif($res = $plugins->hook("langs_init", $language)) $this->language = $res;
		
		// Default to english then..
		else $this->language = "english";
		
		$this->dir = $dir;
		
		// Stick this..
		$tmpls = $this->main->getTemplates();
		$tmpls->stick("lang", $this->data);
		
		// Load the global language file..
		$this->load("global");
	}
	
	function load($name)
	{
		$plugins = $this->main->getPlugins();
		if($res = $plugins->hook("langs_load", $name))
		{
			$this->data = array_merge($this->data,$res);
			return true;
		}
		elseif($res===false) return false;
		
		if(!require_once("{$this->path}/{$this->language}{$this->dir}/{$name}.php"))
			trigger_error("The '{$name}' language file was unable to be loaded.", E_USER_WARNING);
		
		if(!isset($l)) trigger_error("The '{$name}' language file doesn't contain any language strings.", E_USER_WARNING);
		
		if(($res = $plugins->hook("langs_load_end", $name))!==null) $l = array_merge($l,$res);
		
		// Add it to the loaded data..
		$this->data = array_merge($this->data,$l);
		return true;
	}
	
	function get($name)
	{
		if(!isset($this->data[$name])) return '{$lang_'.name.'}';
		return $this->data[$name];
	}
	
	function __get($name)
	{
		if(!isset($this->data[$name])) return '{$lang_'.name.'}';
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
	
	function import(array $data)
	{
		$this->data = array_merge($this->data, $data);
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