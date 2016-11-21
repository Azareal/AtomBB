<?php
/*
	AtomBB Permission Registry File.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$permlist = array(
	"can_post_threads" => 0,
	"can_post_replies" => 0,
	"can_edit_own_posts" => 0,
	"can_edit_posts" => 0,
	"can_close_own_threads" => 0,
	"can_close_threads" => 0,
	"can_open_threads" => 0,
	"can_stick_threads" => 0,
	"can_unstick_threads" => 0,
	"can_announce_threads" => 0,
	"can_denounce_threads" => 0,
	"can_move_threads" => 0,
	"can_split_threads" => 0,
	"can_merge_posts" => 0,
	"can_delete_own_replies" => 0,
	"can_delete_replies" => 0,
	"can_delete_own_threads" => 0,
	"can_delete_threads" => 0,
	"can_see_deleted_posts" => 0,
	"can_see_deleted_threads" => 0,
	"can_see_hidden_posts" => 0,
	"can_undelete_own_replies" => 0,
	"can_undelete_replies" => 0,
	"can_undelete_own_threads" => 0,
	"can_undelete_threads" => 0,
	//"can_hide_replies" => 0,
	"can_show_replies" => 0,
	"can_protect_replies" => 0,
	"can_protect_threads" => 0,
	"can_unprotect_replies" => 0,
	"can_unprotect_threads" => 0,
	//"can_hide_threads" => 0,
	"can_show_threads" => 0,
	"can_mod_own_profile" => 0,
	"can_mod_profile" => 0,
	"can_manual_issue_penalties" => 0,
	
	"can_use_convos" => 0,
	"can_create_convos" => 0,
	"can_convo_invite" => 0,
	"can_close_convos" => 0,
	"can_change_avatar" => 0,
	"can_change_signature" => 0,
	
	"can_view_edits" => 0,
	"can_manage_edits" => 0,
	"can_manage_reps" => 0,
	"can_ban_others" => 0,
	"can_forum_ban_users" => 0,
	"can_activate_users" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	
	"can_delete_edits" => 0,
	"can_restore_edits" => 0,
	"can_undo_edits" => 0,
	"can_view_notices" => 0,
	"can_create_notices" => 0,
	"can_edit_notices" => 0,
	"can_delete_notices" => 0,
	"can_warn" => 0,
	"can_custom_warn" => 0,
	"can_edit_warnings" => 0,
	"can_revoke_warning" => 0,
	"warn_immune" => 0,
	"ban_immune" => 0,
	
	"can_access_modcp" => 0,
	"can_view_modlogs" => 0,
	"can_view_bans" => 0,
	"can_view_warnings" => 0,
	"can_view_mods" => 0,
	
	// Anti-permission..
	"is_not_moderated" => 0
);

$admin_permlist = array(
	"can_admin_settings" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Users
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
);

$plugins->hook("perms_registry", $permlist, $admin_permlist);