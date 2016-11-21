<?php
/*
	AtomBB Pages
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2017.
*/

// Supercache..
if(isset($_GET['ajax']) && $_GET['ajax']==1 && @require_once('./cache/pages/'.htmlentities($_GET['area'].'.html'))) exit;

// Define this for security purposes..
define("HADRON_START",1);
define("SCRIPT_NAME","pages/index.php");

// We'll need the global stuff
require_once("../global.php");

if(!isset($_GET['area'])) die($error->getError(404));

$area = $db->sanitise($_GET['area']);
$ppage = $db->get('*','pages',"area='{$area}' AND active=1",1);
if(!$ppage) die($error->getError(404));

// TO-DO: Layout Control BBCode..

$page->setTitle($ppage['title']);
$content = bbcode($ppage['content']);
$page->addTable($ppage['title'], $content['message']);
$page->output();