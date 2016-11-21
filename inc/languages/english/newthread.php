<?php
/*
	AtomBB Newthread Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['newthread_head'] = "Creating New Topic";
$l['newthread_thread_title'] = "Title";
$l['newthread_msg'] = "Message";
$l['newthread_submit'] = "Submit";
$l['newthread_none'] = "None";

// Errors..
$l['newthread_nofid'] = "You didn't provide a ForumID.";
$l['newthread_invalidfid'] = "You have provided an invalid ForumID.";
$l['newthread_noforum'] = "The specified forum doesn't exist.";
$l['newthread_notitle'] = "No title specified.";
$l['newthread_nocontent'] = "No content specified.";
$l['newthread_errors_minlength'] = "The message which you submitted does not meet the minimum length requirements.";
$l['newthread_errors_minwordcount'] = "The message which you submitted does not meet the minimum word count requirements.";
$l['newthread_errors_dupe_recent'] = "This message appears to be a duplicate of a very recent post.";