<?php
/*
	AtomBB Penalty Page Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['penalty_nouid'] = "No UID was specified.";
$l['penalty_badsession'] = "Session mismatch.";
$l['penalty_noexpiry'] = "No expiry date was specified.";
$l['penalty_noreason'] = "No reason was given for this punishment.";
$l['penalty_nopenalty'] = "No reason was given for this punishment.";
$l['ban_nonextgroup'] = "No next group was specified.";
$l['ban_nobangroup'] = "No ban group was specified.";
$l['ban_nobantype'] = "No ban type was specified.";
$l['ban_bangroup_nolist'] = "There are currently no available groups to ban this user into.";
$l['ban_nextgroup_nolist'] = "There are currently no available groups for this user to return to after this ban expires.";
$l['ban_none'] = "The user who you are trying to punish doesn't exist.";
$l['penalty_success'] = "The punishment has been successfully issued.";
$l['ban_success'] = "The ban has been successfully issued.";

// Penalties..
$l['penalty_title'] = "Issuing Punishment against $1";
$l['penalty_head'] = "Issuing Punishment";
$l['penalty_name'] = "Name";
$l['penalty_penalty'] = "Penalty";
$l['penalty_expiry'] = "Expiry";
$l['penalty_expiry_default'] = "Use default expiry times (for bans, this means that the ban will never expire)";
$l['penalty_expiry_nojs'] = "Please enable JavaScript to get the full use out of this feature.";
$l['penalty_reason'] = "Reason";
$l['penalty_submit'] = "Issue Punishment";

// Bans..
$l['ban_head'] = "Issuing Ban";
$l['ban_type'] = "Type";
$l['ban_type_global'] = "Global";
$l['ban_type_local'] = "Local";
$l['ban_bangroup'] = "Ban Group";
$l['ban_bangroup_desc'] = "The group which the user will serve their ban in.";
$l['ban_nextgroup'] = "Next Group";
$l['ban_nextgroup_desc'] = "The group which the user will be placed in, after ban expiry.";
$l['ban_submit'] = "Ban User";