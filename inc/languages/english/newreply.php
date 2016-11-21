<?php
/*
	AtomBB Newreply Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['newreply_head'] = "Creating New Reply";
$l['newreply_msg'] = "Message";
$l['newreply_submit'] = "Submit";

// Errors..
$l['newreply_notid'] = "You didn't provide a ThreadID.";
$l['newreply_invalidtid'] = "The specified thread doesn't exist.";
$l['newreply_nocontent'] = "No content specified.";
$l['newreply_errors_minlength'] = "The message which you submitted does not meet the minimum length requirements.";
$l['newreply_errors_minwordcount'] = "The message which you submitted does not meet the minimum word count requirements.";
//$l['newreply_errors_dupe'] = "This message appears to be a duplicate of someone else's post.";
$l['newreply_errors_dupe_recent'] = "This message appears to be a duplicate of a very recent post.";
$l['newreply_noparent'] = "The thread's parent forum doesn't exist.";
$l['newreply_nothread'] = "The specified thread doesn't exist.";