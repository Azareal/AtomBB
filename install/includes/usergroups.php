<?php
/*
	AtomBB Usergroup Data Insertion File.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("IN_INSTALL")) die("You are not allowed to access this file directly.");

$perms = array(
	"can_move_threads" => 0,
	"can_protect_replies" => 0,
	"can_protect_threads" => 0,
	"can_unprotect_replies" => 0,
	"can_unprotect_threads" => 0,
	"can_mod_own_profile" => 0,
	"can_mod_profile" => 0,
	
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
	//"can_forum_ban_users" => 0,
	"ban_immune" => 0,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
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

$db->insert('usergroups',array(
	"name" => 'Default',
	"description" => 'The group which all of the other groups inherit from including guest users.',
	"style_start" => "",
	"style_end" => "",
	"can_manage_reps" => 0,
	"is_banned_group" => 0,
	"is_moderator" => 0,
	"is_super_mod" => 0,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 0,
	"group_order" => 0,
	"level" => 0,
	"data" => ''
));

$perms = array(
	// Local permissions..
	"can_post_threads" => 1,
	"can_post_replies" => 1,
	"can_edit_own_posts" => 1,
	"can_edit_posts" => 0,
	"can_close_own_threads" => 0,
	"can_close_threads" => 0,
	"can_open_threads" => 0,
	"can_stick_threads" => 0,
	"can_unstick_threads" => 0,
	"can_announce_threads" => 0,
	"can_denounce_threads" => 0,
	"can_delete_own_replies" => 1,
	"can_delete_replies" => 0,
	"can_delete_own_threads" => 0,
	"can_delete_threads" => 0,
	"can_see_deleted_posts" => 0,
	"can_see_deleted_threads" => 0,
	"can_forum_ban_users" => 0,
	"access_tier" => "custom", // Tell the system that there are local perms here..
	
	"can_move_threads" => 0,
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
	"can_hide_threads" => 0,
	"can_show_threads" => 0,
	"can_mod_own_profile" => 1,
	"can_mod_profile" => 0,
	
	"can_use_convos" => 1,
	"can_create_convos" => 1,
	"can_convo_invite" => 1,
	"can_close_convos" => 0,
	"can_change_avatar" => 1,
	"can_change_signature" => 1,
	
	"can_view_edits" => 0,
	"can_manage_edits" => 0,
	"can_manage_reps" => 0,
	"can_ban_indirect" => 0,
	"can_ban_others" => 0,
	"ban_immune" => 0,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
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
	"is_not_moderated" => 1
);

$db->insert('usergroups',array(
	"name" => 'Registered',
	"description" => 'Users who are registered go into this group by default.',
	"style_start" => "",
	"style_end" => "",
	"can_manage_reps" => 0,
	"is_banned_group" => 0,
	"is_moderator" => 0,
	"is_super_mod" => 0,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 0,
	"group_order" => 1,
	"level" => 3,
	"data" => ''
));

$perms = array(
	// Local permissions..
	"can_post_threads" => 1,
	"can_post_replies" => 1,
	"can_edit_own_posts" => 1,
	"can_edit_posts" => 0,
	"can_close_own_threads" => 1,
	"can_close_threads" => 1,
	"can_open_threads" => 1,
	"can_stick_threads" => 1,
	"can_unstick_threads" => 1,
	"can_announce_threads" => 0,
	"can_denounce_threads" => 0,
	"can_delete_own_replies" => 1,
	"can_delete_replies" => 1,
	"can_delete_own_threads" => 1,
	"can_delete_threads" => 1,
	"can_see_deleted_posts" => 0,
	"can_see_deleted_threads" => 0,
	"can_see_hidden_posts" => 1,
	"can_undelete_own_replies" => 1,
	"can_undelete_replies" => 0,
	"can_undelete_own_threads" => 1,
	"can_undelete_threads" => 0,
	//"can_hide_replies" => 1,
	"can_show_replies" => 1,
	"can_hide_threads" => 0,
	"can_show_threads" => 0,
	"can_forum_ban_users" => 0,
	"access_tier" => "custom", // Tell the system that there are local perms here..
	
	"can_move_threads" => 1,
	"can_protect_replies" => 0,
	"can_protect_threads" => 0,
	"can_unprotect_replies" => 0,
	"can_unprotect_threads" => 0,
	"can_mod_own_profile" => 1,
	"can_mod_profile" => 0,
	
	"can_use_convos" => 1,
	"can_create_convos" => 1,
	"can_convo_invite" => 1,
	"can_close_convos" => 0,
	"can_change_avatar" => 1,
	"can_change_signature" => 1,
	
	"can_view_edits" => 1,
	"can_manage_edits" => 0,
	"can_manage_reps" => 0,
	"can_ban_indirect" => 1,
	"can_ban_others" => 0,
	"ban_immune" => 0,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
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
	"is_not_moderated" => 1
);

$db->insert('usergroups',array(
	"name" => 'Moderators',
	"description" => 'These staff members moderate where the admins specify.',
	"style_start" => '<span style="color: blue;font-weight:bold;">',
	"style_end" => '</span>',
	"can_manage_reps" => 0,
	"is_banned_group" => 0,
	"is_moderator" => 1,
	"is_super_mod" => 0,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 1,
	"group_order" => 2,
	"level" => 5,
	"data" => ''
));

$perms = array(
	"can_move_threads" => 1,
	"can_protect_replies" => 1,
	"can_protect_threads" => 1,
	"can_unprotect_replies" => 1,
	"can_unprotect_threads" => 1,
	"can_mod_own_profile" => 1,
	"can_mod_profile" => 1,
	
	"can_use_convos" => 1,
	"can_create_convos" => 1,
	"can_convo_invite" => 1,
	"can_close_convos" => 0,
	"can_change_avatar" => 1,
	"can_change_signature" => 1,
	
	"can_view_edits" => 1,
	"can_manage_edits" => 1,
	"can_manage_reps" => 1,
	"can_ban_indirect" => 1,
	"can_ban_others" => 1,
	"ban_immune" => 1,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 1,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,

	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
	"can_delete_edits" => 1,
	"can_restore_edits" => 1,
	"can_undo_edits" => 1,
	"can_view_notices" => 1,
	"can_create_notices" => 1,
	"can_edit_notices" => 1,
	"can_delete_notices" => 0,
	"can_warn" => 1,
	"can_custom_warn" => 1,
	"can_edit_warnings" => 1,
	"can_revoke_warning" => 1,
	"warn_immune" => 0,
	"ban_immune" => 0,
	
	"can_access_modcp" => 1,
	"can_view_modlogs" => 1,
	"can_view_bans" => 1,
	"can_view_warnings" => 1,
	"can_view_mods" => 1,
	
	// Anti-permission..
	"is_not_moderated" => 1
);

$db->insert('usergroups',array(
	"name" => 'Super Moderators',
	"description" => 'These staff can moderate anywhere.',
	"style_start" => '<span style="color: green;font-weight:bold;">',
	"style_end" => '</span>',
	"can_manage_reps" => 1,
	"is_banned_group" => 0,
	"is_moderator" => 1,
	"is_super_mod" => 1,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 1,
	"group_order" => 3,
	"level" => 10,
	"data" => ''
));

$perms = array(
	"can_move_threads" => 1,
	"can_protect_replies" => 1,
	"can_protect_threads" => 1,
	"can_unprotect_replies" => 1,
	"can_unprotect_threads" => 1,
	"can_mod_own_profile" => 1,
	"can_mod_profile" => 1,
	
	"can_use_convos" => 1,
	"can_create_convos" => 1,
	"can_convo_invite" => 1,
	"can_close_convos" => 1,
	"can_change_avatar" => 1,
	"can_change_signature" => 1,
	
	"can_view_edits" => 1,
	"can_manage_edits" => 1,
	"can_manage_reps" => 1,
	"can_ban_indirect" => 1,
	"can_ban_others" => 1,
	"ban_immune" => 1,
	"can_admin_settings" => 1,
	"can_admin_users" => 1,
	"can_create_users" => 1,
	"can_delete_users" => 1,
	"can_edit_users" => 1,
	"can_edit_users_statistics" => 1,
	"can_edit_users_groups" => 1,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 1,
	"can_admin_usergroups" => 1,
	"can_override_forums" => 1,
	"can_edit_forums" => 1,
	"can_create_forums" => 1,
	"can_delete_forums" => 1,
	"can_add_moderators" => 1,
	"can_remove_moderators" => 1,
	"can_edit_moderators" => 1,
	"can_manage_topic_prefixes" => 1,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 1,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
	"can_delete_edits" => 1,
	"can_restore_edits" => 1,
	"can_undo_edits" => 1,
	"can_view_notices" => 1,
	"can_create_notices" => 1,
	"can_edit_notices" => 1,
	"can_delete_notices" => 1,
	"can_warn" => 1,
	"can_custom_warn" => 1,
	"can_edit_warnings" => 1,
	"can_revoke_warning" => 1,
	"warn_immune" => 1,
	"ban_immune" => 1,
	
	"can_access_modcp" => 1,
	"can_view_modlogs" => 1,
	"can_view_bans" => 1,
	"can_view_warnings" => 1,
	"can_view_mods" => 1,
	
	// Anti-permission..
	"is_not_moderated" => 1
);

$db->insert('usergroups',array(
	"name" => 'Administrators',
	"description" => 'These staff have full access.',
	"style_start" => '<span style="color: red;font-weight:bold;font-style: italic;">',
	"style_end" => '</span>',
	"can_manage_reps" => 1,
	"is_banned_group" => 0,
	"is_moderator" => 1,
	"is_super_mod" => 1,
	"is_admin" => 1,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 1,
	"group_order" => 4,
	"level" => 20,
	"data" => ''
));

$perms = array(
	"can_stick_threads" => 0,
	"can_unstick_threads" => 0,
	"can_move_threads" => 0,
	"can_show_replies" => 0,
	"can_protect_replies" => 0,
	"can_protect_threads" => 0,
	"can_unprotect_replies" => 0,
	"can_unprotect_threads" => 0,
	"can_mod_own_profile" => 0,
	"can_mod_profile" => 0,
	
	"can_use_convos" => 0,
	"can_create_convos" => 0,
	"can_convo_invite" => 0,
	"can_close_convos" => 0,
	"can_change_avatar" => 0,
	"can_change_signature" => 0,
	
	"can_view_edits" => 0,
	"can_manage_edits" => 0,
	"can_manage_reps" => 0,
	"can_ban_indirect" => 0,
	"can_ban_others" => 0,
	"ban_immune" => 0,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
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

$db->insert('usergroups',array(
	"name" => 'Awaiting Activation',
	"description" => 'Users who have not activated their accounts.',
	"style_start" => "",
	"style_end" => "",
	"can_manage_reps" => 0,
	"is_banned_group" => 0,
	"is_moderator" => 0,
	"is_super_mod" => 0,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 0,
	"group_order" => 5,
	"level" => 1,
	"data" => ''
));

$perms = array(
	"can_move_threads" => 0,
	"can_protect_replies" => 0,
	"can_protect_threads" => 0,
	"can_unprotect_replies" => 0,
	"can_unprotect_threads" => 0,
	"can_mod_own_profile" => 0,
	"can_mod_profile" => 0,
	
	"can_use_convos" => 0,
	"can_create_convos" => 0,
	"can_convo_invite" => 0,
	"can_close_convos" => 0,
	"can_change_avatar" => 0,
	"can_change_signature" => 0,
	
	"can_view_edits" => 0,
	"can_manage_edits" => 0,
	"can_manage_reps" => 0,
	"can_ban_indirect" => 0,
	"can_ban_others" => 0,
	"ban_immune" => 0,
	"can_admin_settings" => 0,
	"can_admin_users" => 0,
	"can_create_users" => 0,
	"can_delete_users" => 0,
	"can_edit_users" => 0,
	"can_edit_users_statistics" => 0,
	"can_edit_users_groups" => 0,
	"can_edit_users_permissions" => 0,
	"can_activate_users" => 0,
	"can_admin_usergroups" => 0,
	"can_override_forums" => 0,
	"can_edit_forums" => 0,
	"can_create_forums" => 0,
	"can_delete_forums" => 0,
	"can_add_moderators" => 0,
	"can_remove_moderators" => 0,
	"can_edit_moderators" => 0,
	"can_manage_topic_prefixes" => 0,
	
	// Appearance
	"can_manage_themes" => 0,
	'can_manage_menus' => 0,
	
	// System
	"can_access_system" => 0,
	"can_manage_cache" => 0,
	
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

$db->insert('usergroups',array(
	"name" => 'Banned',
	"description" => 'Users who have been banned from the forums.',
	"style_start" => "<s>",
	"style_end" => "</s>",
	"can_manage_reps" => 0,
	"is_banned_group" => 1,
	"is_moderator" => 0,
	"is_super_mod" => 0,
	"is_admin" => 0,
	"permissions" => serialize($perms),
	"is_multi_colour" => 0,
	"show_forumstaff" => 0,
	"group_order" => 6,
	"level" => -1,
	"data" => ''
));