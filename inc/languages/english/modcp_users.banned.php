<?php
/*
	AtomBB ModCP User Manager - Banned List Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['modcp_users.banned_title'] = "ModCP Banned Users";
$l['modcp_users.banned_head'] = "Banned Users";
$l['modcp_users.banned_name'] = "Name";
$l['modcp_users.banned_reason'] = "Reason";
$l['modcp_users.banned_issuedby'] = "Issued By";
$l['modcp_users.banned_expiry'] = "Expiry";
$l['modcp_users.banned_actions'] = "Actions";
$l['modcp_users.banned_permanent'] = "Permanent";

// Rows..
$l['modcp_users.banned_edit'] = "Edit Ban";
$l['modcp_users.banned_reverse'] = "Reverse Ban";

// Ban maker..
$l['modcp_banmaker_title'] = "ModCP Banning";
$l['modcp_banmaker_ban'] = "Ban";
$l['modcp_banmaker_name'] = "Name";
$l['modcp_banmaker_expiry'] = "Expiry";
$l['modcp_banmaker_reason'] = "Reason";
$l['modcp_banmaker_bangroup'] = "Ban Group";
$l['modcp_banmaker_bangroup_desc'] = "The group which the user will serve their ban in.";
$l['modcp_banmaker_nextgroup'] = "Next Group";
$l['modcp_banmaker_nextgroup_desc'] = "The group which the user will be placed in, after ban expiry.";
$l['modcp_banmaker_submit'] = "Ban User";

// Errors..
$l['modcp_users.banned_badsession'] = "Session mismatch!";
$l['modcp_users.banned_nouid'] = "No UID was specified for the ban.";
$l['modcp_users.banned_noexpiry'] = "No expiry time was provided.";
$l['modcp_users.banned_noreason'] = "No reason has been provided for the ban.";
$l['modcp_users.banned_nonextgroup'] = "No next group was provided.";
$l['modcp_users.banned_nobangroup'] = "No ban group was provided.";
$l['modcp_users.banned_badnextgroup'] = "The next group specified does not exist.";
$l['modcp_users.banned_badbangroup'] = "The ban group specified does not exist.";
$l['modcp_users.banned_nogive'] = "You may not give global staff ranks via the ban system.";
$l['modcp_users.banned_bangroup_nolist'] = "There are currently no groups to ban the user into.";
$l['modcp_users.banned_nextgroup_nolist'] = "There are currently no groups for the user to end up in.";
$l['modcp_users.banned_nolist'] = "No one has been banned yet.";