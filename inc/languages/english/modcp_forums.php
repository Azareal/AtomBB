<?php
/*
	AtomBB ModCP Forum Manager Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['modcp_forums_title'] = "ModCP Forum Manager";
$l['modcp_forums_head'] = "Moderator List";
$l['modcp_forums_username'] = "Username";
$l['modcp_forums_options' ] = "Options";
$l['modcp_forums_edit'] = "Edit Position";
$l['modcp_forums_revoke'] = "Revoke Position";

// Not viewing a forum?
$l['modcp_forums_index_title'] = "ModCP Forum Manager Index";
$l['modcp_forums_index_head'] = "Forum Manager";
$l['modcp_forums_index_body'] = "Try accessing the forum manager via the main index.";

// Add Moderator..
$l['modcp_forums_create_head'] = "Add Moderator";
$l['modcp_forums_create_username'] = "Username";
$l['modcp_forums_create_canwarn'] = "Can issue warnings";
$l['modcp_forums_create_canban'] = "Can issue local bans";
$l['modcp_forums_create_canban_desc'] = "Ability to ban users from a specific forum and not globally.";
$l['modcp_forums_create_canstick'] = "Can stick topics";
$l['modcp_forums_create_canlock'] = "Can lock topics";
$l['modcp_forums_create_canedit'] = "Can edit posts";
$l['modcp_forums_create_canhide'] = "Can hide posts";
$l['modcp_forums_create_canshow'] = "Can show posts";
$l['modcp_forums_create_canviewedits'] = "Can view edits";
$l['modcp_forums_create_candeleteposts'] = "Can delete posts";
$l['modcp_forums_create_candeletethreads'] = "Can delete topics";
$l['modcp_forums_create_canundeleteposts'] = "Can undelete posts";
$l['modcp_forums_create_canundeletethreads'] = "Can undelete topics";
$l['modcp_forums_create_submit'] = "Add Moderator";

// Errors..
$l['modcp_forums_errors_noforum'] = "The requested forum does not exist.";
$l['modcp_forums_errors_nousername'] = "No username was specified.";
$l['modcp_forums_errors_noperms_addmod'] = "You do not have authorisation to add new moderators.";
$l['modcp_forums_errors_noperms_delmod'] = "You do not have authorisation to perform this action.";
$l['modcp_forums_errors_alreadymod'] = "The target user is already a moderator.";
$l['modcp_forums_errors_nouser'] = "The target user does not exist.";
$l['modcp_forums_errors_nouid'] = "No UID was specified.";
$l['modcp_forums_errors_future'] = "This feature has not been added yet.";
$l['modcp_forums_errors_remove_notmod'] = "You are unable to revoke moderator status from a non-moderator.";
$l['modcp_forums_errors_nomods'] = "There are currently no local moderators in this forum.";

// Other..
$l['modcp_forums_success_addmod'] = "The new moderator has successfully been added.";