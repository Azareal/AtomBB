<?php
/*
	AtomBB Admin Setting Editor Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Main part..
$l['edit_setting_title'] = "Updating Settings";
$l['edit_setting_head'] = "Updating Settings";
$l['edit_setting_name'] = "Name";
$l['edit_setting_options_head'] = "Options";
$l['edit_setting_no'] = "No";
$l['edit_setting_yes'] = "Yes";
$l['edit_setting_options_submit'] = "Update Settings";

// Settings..
$l['settings_setting_session_strlen'] = "Session String Length";
$l['settings_setting_session_strlen_desc'] = "The setting which determines the length that the session strings will have.";
$l['settings_setting_session_expiry'] = "Session Expiry";
$l['settings_setting_session_expiry_desc'] = "The setting which determines how long a session will last before it expires.";
$l['settings_setting_defaultGroup'] = "Default Group";
$l['settings_setting_defaultGroup_desc'] = "The setting which determines the default group which people are assigned to when they register.";
$l['settings_setting_enable_relative_time'] = "Enable relative time";
$l['settings_setting_enable_relative_time_desc'] = "The setting which determines whether dates/times are formatted in a way which is relative to the current time.";
$l['settings_setting_board_offline'] = "Maintenance Mode";
$l['settings_setting_board_offline_desc'] = "The setting which determines whether the site is currently in maintenance mode where only administrators are able to access the site.";
$l['settings_setting_offline_reason'] = "Maintenance Mode Reason";
$l['settings_setting_offline_reason_desc'] = "The reason given for placing the site into maintenance mode.";
$l['settings_setting_enable_wol'] = "Enable Who's Online";
$l['settings_setting_enable_wol_desc'] = "The setting which determines where the list which shows the users who are currently online is enabled.";
$l['settings_setting_wol_cutoff'] = "Who's Online Cutoff";
$l['settings_setting_wol_cutoff_desc'] = "The setting which determines the maximum number of online users which appear on the index page.";
$l['settings_setting_enable_stafflist'] = "Staff List Switch";
$l['settings_setting_enable_stafflist_desc'] = "The setting which determines whether the public page which lists significant staff is enabled.";
$l['settings_setting_enable_statistics'] = "Enable Public Statistics";
$l['settings_setting_enable_statistics_desc'] = "The setting which determines whether the general statistics are publically available outside of the administration interface.";
$l['settings_setting_enable_acp_location'] = "Track ACP Location";
$l['settings_setting_enable_acp_location_desc'] = "The setting which determines whether the location of administrators within the Control Panel is tracked.";
$l['settings_setting_bump_on_edit'] = "Bump on Edit";
$l['settings_setting_bump_on_edit_desc'] = "The setting which determines whether posts which have received a significant change via editing are bumped to the top of the lists.";
$l['settings_setting_mod_reauth'] = "Moderator Re-Authentication";
$l['settings_setting_mod_reauth_desc'] = "The setting which determines whether moderators are required to re-authenticate before entering the ModCP.";
$l['settings_setting_multi_factor'] = "Multi-Factor Authentication";
$l['settings_setting_multi_factor_desc'] = "The setting which determines whether multi-factor authentication has been activated.";
$l['settings_setting_admin_multi_factor'] = "Control Panel Multi-Factor Authentication";
$l['settings_setting_admin_multi_factor_desc'] = "The setting which determines whether multi-factor authentication is mandatory in order to use the Control Panel.";
$l['settings_setting_min_posts_display'] = "Minimum Posts to Show";
$l['settings_setting_min_posts_display_desc'] = "The setting which determines the minimum number of posts which each topic page can show.";
$l['settings_setting_max_posts_display'] = "Maximum Posts to Show";
$l['settings_setting_max_posts_display_desc'] = "The setting which determines the maximum number of posts which each topic page can show.";
$l['settings_setting_min_threads_display'] = "Minimum Topics to Show";
$l['settings_setting_min_threads_display_desc'] = "The setting which determines the minimum number of topics which each forum page can show.";
$l['settings_setting_max_threads_display'] = "Maximum Topics to Show";
$l['settings_setting_max_threads_display_desc'] = "The setting which determines the maximum number of topics which each forum page can show.";
$l['settings_setting_avatar_filesize'] = "Maximum allowed avatar File Size";
$l['settings_setting_avatar_filesize_desc'] = "The setting which determines the maximum size which avatar files can be.";
$l['settings_setting_avatar_heightmax'] = "Maximum allowed avatar height";
$l['settings_setting_avatar_heightmax_desc'] = "The setting which determines the maximum height which avatars can be.";
$l['settings_setting_avatar_widthmax'] = "Development Mode";
$l['settings_setting_avatar_widthmax_desc'] = "The setting which determines the maximum width which avatars can be.";
$l['settings_setting_unactiveGroup'] = "Unactive Default Group";
$l['settings_setting_unactiveGroup_desc'] = "The setting which determines the group which accounts which aren't activated will be assigned to.";
$l['settings_setting_verify_email'] = "Verify Email";
$l['settings_setting_verify_email_desc'] = "The setting which determines whether users who register on the site will receive emails regarding activation.";
$l['settings_setting_enable_captcha'] = "Enable CAPTCHA";
$l['settings_setting_enable_captcha_desc'] = "The setting which determines whether conventional anti-spam measures will be take against accounts.";
$l['settings_setting_enable_qa'] = "Enable Questions &amp; Answers";
$l['settings_setting_enable_qa_desc'] = "The setting which determines whether to enable the question &amp; answers system for handling registration attempts.";
$l['settings_setting_qa_list'] = "Questions &amp; Answers";
$l['settings_setting_qa_list_desc'] = "This setting holds all of the question &amp; answer pairs to be used as an anti-spam measure.";
$l['settings_setting_spamModeSwitch'] = "Spam Mode Switch";
$l['settings_setting_spamModeSwitch_desc'] = "The master switch which determines whether this software's spam handling systems are activated.";
$l['settings_setting_spamMode'] = "Spam Handling Mode";
$l['settings_setting_spamMode_desc'] = "The setting which determines how the software will deal with users who are awaiting activation.";
$l['settings_setting_spamModeCount'] = "Required Post Count";
$l['settings_setting_spamModeCount_desc'] = "The setting which determines what post count a user requires in order to be activated automatically. This setting is completely ignored unless, spam handling mode #3 is activated.";
$l['settings_setting_spamAggressiveness'] = "Spam Aggressiveness";
$l['settings_setting_spamAggressiveness_desc'] = "The setting which determines how aggressive the anti-spam algorithms will be for handling new users.";
$l['settings_setting_bigpost_limit'] = "Big Post Minimum Length";
$l['settings_setting_bigpost_limit_desc'] = "The setting which determines the minimum length that a post must be before it is considered a big post.";
$l['settings_setting_level_switch'] = "Level Switch";
$l['settings_setting_level_switch_desc'] = "The setting which determines the value which the point requirement is multiplied by.";
$l['settings_setting_level_modifier'] = "Level Modifier";
$l['settings_setting_level_modifier_desc'] = "The setting which determines whether the activty level system is enabled.";
$l['settings_setting_convo_switch'] = "Conversation Switch";
$l['settings_setting_convo_switch_desc'] = "The setting which determines whether the direct conversation system is enabled.";
$l['settings_setting_convo_reci_cap'] = "Conversation Recipient Cap";
$l['settings_setting_convo_reci_cap_desc'] = "The setting which determines the maximum number of recipients which a direct conversation is permitted to have.";
$l['settings_setting_warn_autopost'] = "Warning Auto-Post";
$l['settings_setting_warn_autopost_desc'] = "The setting which determines whether a post is automatically created when a warning is issued.";
$l['settings_setting_warn_autopost_forum'] = "Warning Auto-Post Forum";
$l['settings_setting_warn_autopost_forum_desc'] = "The setting which determines which forum the post is made in when a warning is issued.";
$l['settings_setting_warn_point_max'] = "Warning Point Maximum";
$l['settings_setting_warn_point_max_desc'] = "The setting which determines the maximum number of warning points which a user can have.";
$l['settings_setting_api_limit'] = "API Limit";
$l['settings_setting_api_limit_desc'] = "The setting which determines the maximum number of records which can be fetched in a single API query.";

$l['settings_setting_devMode'] = "Development Mode";
$l['settings_setting_devMode_desc'] = "How did you manage to access this setting?";
$l['settings_setting_foundedAt'] = "Founded On";
$l['settings_setting_foundedAt_desc'] = "How did you manage to access this setting?";

// Setting groups..
$l['settings_group_login'] = "Login Settings";
$l['settings_group_login_desc'] = "This setting group holds some settings which pertain to the login process of the software and associated elements which make it possible to operate like the session system.";
$l['settings_group_online'] = "Online Settings";
$l['settings_group_online_desc'] = "This setting group holds some settings related to the Who's Online system which shows a list of the people who are currently online.";
$l['settings_group_profile'] = "Profile Settings";
$l['settings_group_profile_desc'] = "This setting group holds some settings which affect the profile system along with other user related items like avatars.";
$l['settings_group_antispam'] = "Anti-Spam";
$l['settings_group_antispam_desc'] = "This setting group holds the settings which controls the system's anti-spam systems.";
$l['settings_group_usercp'] = "UserCP Settings";
$l['settings_group_usercp_desc'] = "This setting group holds the settings which controls the functionality within the UserCP interfaces which users have access to.";
$l['settings_group_access'] = "Access Control Settings";
$l['settings_group_access_desc'] = "This setting group holds some access control settings which governs access to publically available information.";
$l['settings_group_warnings'] = "Warning Settings";
$l['settings_group_warnings_desc'] = "This setting group holds the settings which controls the warning system.";
$l['settings_group_misc'] = "Other Settings";
$l['settings_group_misc_desc'] = "This setting group holds some settings which don't fit into the other setting groups (mostly likely due to high uniqueness).";