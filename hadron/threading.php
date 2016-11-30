<?php
/**
*
*	Hadron Framework: Multi-Threading File.
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class HadronWorker extends Worker { /* init a Hadron environment */ }

class HadronTask extends Stackable
{
	/* Access the Hadron environment */
	public function __construct($callback)
	{
		$this->callback = $callback;
		$this->data = null;
	}
	
	public function run()
	{
		$this->data = $callback();
		$this->notify();
	}
	
	protected function getResult()
	{
		return $this->data;
	}
}
