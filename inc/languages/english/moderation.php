<?php
/*
	AtomBB Moderation Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Confirmation..
$l['moderation_confirm_title'] = "Confirmation";
$l['moderation_confirm_head'] = "Confirmation";
$l['moderation_confirm_move'] = "Target Forum";
$l['moderation_confirm_submit'] = "Confirm";
$l['moderation_confirm_msg'] = "Are you sure that you wish to $1 this $2?";

// Errors..
$l['moderation_noaction'] = "This moderation action does not exist.";
$l['moderation_invalidaction'] = "No valid action was specified.";
$l['moderation_noid'] = "You didn't provide an ID.";
$l['moderation_nopost'] = "The specified post doesn't exist.";
$l['moderation_nothread'] = "The specified topic doesn't exist.";
$l['moderation_postexists'] = "The specified post isn't deleted.";
$l['moderation_fakenopost'] = "The specified post doesn't exist.";
$l['moderation_postnoparent'] = "The parent topic of this post doesn't exist.";
$l['moderation_unimplemented'] = "This feature has not been added yet.";
$l['moderation_fakenothread'] = "The specified topic doesn't exist.";

// Moderation Actions..
$l['thread_modaction_move'] = "This topic has been moved to the $1 forum.";
$l['thread_modaction_stick'] = "This topic has been stuck at the top of the topic list.";
$l['thread_modaction_unstick'] = "This topic has been reverted to a normal topic.";
$l['thread_modaction_lock'] = "The ability to reply to this topic has now been disabled.";
$l['thread_modaction_unlock'] = "The ability to reply to this topic has now been enabled.";
$l['thread_modaction_announce'] = "This topic has been escalated to announcement status.";
$l['thread_modaction_denounce'] = "This topic is no longer an announcement.";