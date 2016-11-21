<?php
/*
	AtomBB Admin Forum Editor Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Main part..
$l['edit_forum_title'] = "Forum Editor";
$l['edit_forum_head'] = "Create Forum";

$l['edit_forum_tabs_general'] = "General";
$l['edit_forum_tabs_moderators'] = "Moderators";
$l['edit_forum_tabs_subforums'] = "Subforums";
$l['edit_forum_tabs_permissions'] = "Permissions";

$l['edit_forum_parent'] = "Parent";
$l['edit_forum_name'] = "Name";
$l['edit_forum_name_placeholder'] = "The publically visible name which you wish to assign to this forum.";
$l['edit_forum_desc'] = "Description";
$l['edit_forum_desc_placeholder'] = "The description for this forum which you wish to publically show.";
$l['edit_forum_active'] = "Active";
$l['edit_forum_topic_mod'] = "Moderate all topics in this forum";
$l['edit_forum_post_mod'] = "Moderate all posts in this forum";
$l['edit_forum_order'] = "Order";
$l['edit_forum_autoexpand'] = "Auto-Expand this forum";
$l['edit_forum_stat_counter'] = "Posts will contribute towards statistics";
$l['edit_forum_hidden_forum'] = "Show on Index?";
$l['edit_forum_layout'] = "Layout";
$l['edit_forum_layout_default'] = "Topic Layout";
$l['edit_forum_layout_newsfeed'] = "Newsfeed Layout";
$l['edit_forum_tag'] = "Tag";
$l['edit_forum_presets'] = "Presets";
$l['edit_forum_preset_custom'] = "Custom";

// Mods..
$l['edit_forum_nomods'] = "This forum currently has no local moderators.";

$l['edit_forum_baduname'] = "You have given an invalid username.";
$l['edit_forum_baduser'] = "The targetted user does not exist.";
$l['edit_forum_alreadymod'] = "The target user is already a moderator.";

$l['edit_forum_mods_add_username'] = "Username";
$l['edit_forum_mods_add_head'] = "Add Moderator";
$l['edit_forum_mods_add_submit'] = "Add Moderator";
$l['edit_forum_perm_can_close_threads'] = "Can close topics";
$l['edit_forum_perm_can_open_threads'] = "Can open topics";
$l['edit_forum_perm_can_stick_threads'] = "Can mark discussions as important";
$l['edit_forum_perm_can_warn'] = "Can issue warnings";
$l['edit_forum_perm_can_forum_ban_users'] = "Can locally ban from specific forums";
$l['edit_forum_perm_can_edit_posts'] = "Can edit posts";
//$l['edit_forum_perm_can_hide_replies'] = "Can hide posts";
$l['edit_forum_perm_can_show_replies'] = "Can unhide posts";
$l['edit_forum_perm_can_delete_replies'] = "Can delete posts";
$l['edit_forum_perm_can_delete_threads'] = "Can delete topics";
$l['edit_forum_perm_can_undelete_replies'] = "Can undelete posts";
$l['edit_forum_perm_can_undelete_threads'] = "Can undelete topics";
$l['edit_forum_perm_can_view_edits'] = "Can view edits";

$l['edit_forum_perm_can_see_hidden_posts'] = "Can see hidden posts";
$l['edit_forum_perm_can_see_deleted_posts'] = "Can see deleted posts";
$l['edit_forum_perm_can_see_deleted_threads'] = "Can see deleted topics";
$l['edit_forum_perm_can_undelete_own_replies'] = "Can undelete own posts";
$l['edit_forum_perm_can_undelete_own_threads'] = "Can undelete own topics";
$l['edit_forum_perm_can_protect_replies'] = "Can protect posts";
$l['edit_forum_perm_can_protect_threads'] = "Can protect topics";
$l['edit_forum_perm_can_unprotect_replies'] = "Can unprotect posts";
$l['edit_forum_perm_can_unprotect_threads'] = "Can unprotect topics";
$l['edit_forum_perm_can_unstick_threads'] = "Can unmark discussions as important";
$l['edit_forum_perm_can_override_thread_locks'] = "Can post in closed topics";

$l['edit_forum_permissions_groups_head'] = "Groups";
$l['edit_forum_permissions_groups_row_goto'] = "go to group";
$l['edit_forum_permissions_groups_row_inherit_default'] = "inherits from default";
$l['edit_forum_permissions_groups_row_inherit_banned'] = "inherits from ban flag";
$l['edit_forum_permissions_groups_levels_custom'] = "Custom";
$l['edit_forum_permissions_groups_levels_default'] = "None";
$l['edit_forum_permissions_groups_levels_no_access'] = "No Access";
$l['edit_forum_permissions_groups_levels_can_view'] = "Can View";
$l['edit_forum_permissions_groups_levels_can_post'] = "Can Post";
$l['edit_forum_permissions_groups_levels_can_moderate'] = "Can Moderate";
$l['edit_forum_permissions_groups_levels_all_perms'] = "All Permissions";
$l['edit_forum_permissions_groups_bulk_update'] = "Update Groups";
$l['forum_permissions_modal_basic'] = "Basic";
$l['forum_permissions_modal_mod'] = "Mod";
$l['forum_permissions_modal_manager'] = "Manager";
$l['forum_permissions_modal_submit'] = "Save All";

$l['edit_forum_options_head'] = "More options";
$l['edit_forum_options_submit'] = "Update Forum";

$l['edit_forum_parent_error'] = "You have not provided a parent to assign this forum to.";
$l['edit_forum_name_error'] = "You have not provided a name for this forum.";
$l['edit_forum_desc_error'] = "You have not provided a description for this forum.";
$l['edit_forum_perms_group_noperms'] = "You are not allowed to perform this action.";
$l['edit_forum_perms_bulk_group_noperms'] = "You are not allowed to perform this action.";
$l['edit_forum_perms_bulk_group_invaliddata'] = "Invalid data was provided to the server.";
$l['edit_forum_perms_bulk_group_success'] = 'You have successfully updated the groups.';
$l['edit_forum_nojs'] = "Please enable JavaScript to unlock the full power of the Forum Editor.";

$l['edit_forum_yes'] = "Yes";
$l['edit_forum_no'] = "No";

$l['side_nav_head'] = "Forums";
$l['side_nav_create_category'] = "Create Category";
$l['side_nav_create_forum'] = "Create Forum";
$l['side_nav_settings'] = "Settings";
$l['side_nav_topics'] = "Discussions";
$l['side_nav_topics_prefixes'] = "Topic Prefixes";
$l['side_nav_topics_filters'] = "Word Filters";
$l['side_nav_topics_smilies'] = "Smilies";
$l['side_nav_topics_settings'] = "Settings";