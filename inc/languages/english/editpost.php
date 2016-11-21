<?php
/*
	AtomBB Editpost Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['editpost_title'] = "Editing Post";
$l['editpost_head'] = "Editing Post";
$l['editpost_msg'] = "Message";
$l['editpost_submit'] = "Submit";

// Errors..
$l['editpost_nopid'] = "You haven't provided a PostID.";
$l['editpost_invalidpid'] = "You have provided an invalid PID.";
$l['editpost_nopost'] = "The specified post doesn't exist.";
$l['editpost_nothread'] = "The specified topic doesn't exist.";
$l['editpost_nocontent'] = "No content specified.";
$l['editpost_errors_minlength'] = "The message which you submitted does not meet the minimum length requirements.";
$l['editpost_errors_minwordcount'] = "The message which you submitted does not meet the minimum word count requirements.";
$l['editpost_noparent'] = "The topic's parent forum doesn't exist.";