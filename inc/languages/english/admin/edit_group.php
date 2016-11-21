<?php
/*
	AtomBB Admin Group Editor Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Main part..
$l['edit_group_title'] = "Updating Group";
$l['edit_group_head'] = "Updating Group";
$l['edit_group_name'] = "Group Name";
$l['edit_group_name_placeholder'] = "Enter a name here";
$l['edit_group_desc'] = "Description";
$l['edit_group_desc_placeholder'] = "Enter a description here";
$l['edit_group_isbanned'] = "Ban Group";
$l['edit_group_isbanned_desc'] = "Whether this is a group for people to be banned into";
$l['edit_group_issuper'] = "Global Moderator Group";
$l['edit_group_issuper_desc'] = "Whether this is a group for people who can moderate everywhere";
$l['edit_group_isadmin'] = "Admin Group";
$l['edit_group_isadmin_desc'] = "Whether this is a group for people who administrate the site";
$l['edit_group_style'] = "Username Markup";
$l['edit_group_style_bit'] = "Username";
$l['edit_group_style_start'] = "<span style='color: green;'>";
$l['edit_group_style_end'] = "</span>";
$l['edit_group_ismulti'] = "Multi colour";
$l['edit_group_ismulti_desc'] = "Whether this is a group where the usernames will have randomly generated colours for each letter";
$l['edit_group_level'] = "Access Level";
$l['edit_group_options_head'] = "Options";
$l['edit_group_no'] = "No";
$l['edit_group_yes'] = "Yes";
$l['edit_group_options_submit'] = "Update Group";

// Errors..
$l['edit_group_noname'] = "You have not provided a name for this group.";
$l['edit_group_nodesc'] = "You have not provided a description for this group.";
$l['edit_group_nobanned'] = "You have not specified whether this is a ban group.";
$l['edit_group_nosuper'] = "You have not specified whether this is a global moderator group.";
$l['edit_group_noadmin'] = "You have not specified whether this is an admin group.";
$l['edit_group_nomulti'] = "You have not specified whether this is a multi colour group.";
$l['edit_group_nolevel'] = "You have not provided an access level for this group.";
$l['edit_group_levelmiss'] = "You do not have the authorisation to grant levels above your own.";
$l['edit_group_badsession'] = "The provided session is not valid.";

// Tabs..
$l['edit_group_tabs_general'] = "General";
$l['edit_group_tabs_forum_permissions'] = "Forum Perms";
$l['edit_group_tabs_forum_mod_permissions'] = "Forum Mod Perms";
$l['edit_group_tabs_permissions'] = "Misc Perms";

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