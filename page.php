<?php
/*
	AtomBB Special Page
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2014.
*/

// Define this for security purposes..
define("HADRON_START",1);
define("SCRIPT_NAME","page.php");

// We'll need the global stuff
require_once("./global.php");

if(!isset($_GET['area'])) die($error->getError(404));

// You can never be too careful..
$area = $db->sanitise($_GET['area']);
//if(!$plugins->outputPage($area)) die($error->getError(404));