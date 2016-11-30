<?php
/**
*	
*	Hadron Framework: Installation System: Simple Template Class.
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal and Hadron Framework (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You may not access this file directly.");

/*
	A really heavily stripped down template class for the installer.
*/
class Templates
{
	public $main = null;
	
	/*
		Loads the main template for the installer.
	*/
	public function load() {
		ob_start();
		include(HADRON_INSTALL_BASE."/templates/main.html");
		$this->main = ob_get_contents();
		ob_clean();
	}
	
	/**
	*
	*	$name - The name of the variable as referred to on the template side.
	*	$val - The data for the variable on the template side.
	*	
	**/
	public function assign($name, $val) {
		if(is_array($val))
			foreach($val as $data)
				$this->main = str_replace('{$'.strtolower($name).'}',$data,$this->main);
		else $this->main = str_replace('{$'.strtolower($name).'}',$val,$this->main);
	}
}