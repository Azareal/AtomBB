<?php
/*
	AtomBB Admin Penalty Editor Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['edit_penalty_title'] = "Penalty Editor";
$l['edit_penalty_head'] = "Penalty Editor";
$l['edit_penalty_name'] = "Internal Name";
$l['edit_penalty_langstring'] = "Name";
$l['edit_penalty_auto_ban'] = "Automatically Ban..?";
$l['edit_penalty_auto_post'] = "Auto-Post";
$l['edit_penalty_requireGroup'] = "Only allow users with this group to be targetted";
$l['edit_penalty_banGroup'] = "Ban users into this group";
$l['edit_penalty_newGroup'] = "Place users into this group after the ban expires";
$l['edit_penalty_duration'] = "Duration";
$l['edit_penalty_submit'] = "Update Penalty";

$l['edit_penalty_auto_head'] = "Automatic Penalty";
$l['edit_penalty_auto_switch'] = "Automatically issue this penalty via warnings";
$l['edit_penalty_auto_manual_issue'] = "Allow this penalty to be issued manually";
$l['edit_penalty_auto_points'] = "Points required to trigger this penalty";

$l['edit_penalty_global_cascade_head'] = "Global Cascade";
$l['edit_penalty_global_cascade_local_scope'] = "Can be applied locally?";
$l['edit_penalty_global_cascade_local_scope_desc'] = "Whether this penalty can be issued on a local basis. E.g. a ban from a specific forum.";
$l['edit_penalty_global_cascade_mods_required'] = "Number of mods required";
$l['edit_penalty_global_cascade_mods_required_desc'] = "Use 0 to disable this feature.";
$l['edit_penalty_global_cascade_area_max'] = "Maximum number of mods from a single area which count";

$l['edit_penalty_tabs_general'] = "General";
$l['edit_penalty_tabs_local'] = "Revoke Local Perms";
$l['edit_penalty_tabs_global'] = "Revoke Global Perms";

$l['edit_penalty_no'] = "No";
$l['edit_penalty_yes'] = "Yes";
$l['edit_penalty_nogroup'] = "None";

$l['edit_penalty_badsession'] = "There was a session mismatch.";
$l['edit_penalty_noname'] = "You haven't specified a name for this penalty.";
$l['edit_penalty_nolangname'] = "You haven't specified a name for this penalty.";
$l['edit_penalty_success_update'] = "The penalty was successfully updated.";

// Nav
$l['side_nav_head'] = "Users";
$l['side_nav_create'] = "Create a User";
$l['side_nav_titles'] = "Titles";
$l['side_nav_groups'] = "Groups";
$l['side_nav_groups_create'] = "Create a Group";
$l['side_nav_glist'] = "Group List";
$l['side_nav_settings'] = "Settings";
$l['side_nav_groups_settings'] = "Settings";
$l['side_nav_sanctions'] = "Sanctions";
$l['side_nav_penalties'] = "Penalties";
$l['side_nav_warnings'] = "Warnings";
$l['side_nav_bans'] = "Bans";