<?php
/*
	AtomBB Error Selector Page
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2017.
*/

// Define this for security purposes..
define("HADRON_START",1);
define("SCRIPT_NAME","error.php");

// We'll need the global stuff
require_once("./global.php");

// Are the forums switched off?
if($main->settings['board_offline'])
{
	if($perms->is("admin")) {
		$tmpls->grab("board_offline_admin");
		$tmpls->append("notice", $tmpls->render("board_offline_admin"));
	} else {
		$tmpls->load("board_offline");
		die($tmpls->render("board_offline"));
	}
}

// Which type of error is it?
if($type==500) echo $error->getError(500);
elseif($type==403) echo $error->getError(403);
else echo $error->getError(404,"Unable to find this page.");