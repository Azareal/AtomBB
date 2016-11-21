<?php
/**
*
*	AtomBB Sample Plugin: Hello World
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal and the AtomBB Group (c) 2013.
*
**/

function helloworld_uninstall() { return true; }

$plugins->bind("global_end", function() {
	addNotice("Hello World!","notice");
});