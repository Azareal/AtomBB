<?php
/*
	AtomBB UserCP Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Pages..
$l['usercp_home_title'] = "UserCP Home";
$l['usercp_home_head'] = "UserCP Home";
$l['usercp_home_msg'] = nl2br("Welcome to the UserCP, you can manage many aspects of your user account here.
Such as changing your password, viewing private messages and modifying a number of settings.");
$l['usercp_home_posts'] = "Posts";
$l['usercp_home_bigposts'] = "Big Posts";
$l['usercp_home_threads'] = "Topics";
$l['usercp_home_notes_head'] = "User Notes";

$l['usercp_critical_title'] = "UserCP Critical Settings";
$l['usercp_critical_head'] = "UserCP Critical Settings";
$l['usercp_critical_password_current'] = "Current Password";
$l['usercp_critical_password'] = "New Password";
$l['usercp_critical_email'] = "New Email";
$l['usercp_critical_submit'] = "Update";

$l['usercp_avatar_title'] = "Avatar Manager";
$l['usercp_avatar_head'] = "Avatar Manager";
$l['usercp_avatar_change_head'] = "Change Avatar";
$l['usercp_avatar_noaccess'] = "You don't have authorisation to change your avatar.";
$l['usercp_avatar_bigwidth'] = "We don't allow avatars which have a width larger than $1.";
$l['usercp_avatar_bigheight'] = "We don't allow avatars which have a height larger than $1.";
$l['usercp_avatar_bigsize'] = "We don't allow avatars which has a filesize larger than \$KB.";
$l['usercp_avatar_success'] = "You have successfully updated your avatar.";
$l['usercp_avatar_error'] = "There was a problem while trying to update your avatar.";
$l['usercp_avatar_upload_label'] = "Upload Avatar";
$l['usercp_avatar_upload_submit'] = "Upload";

$l['usercp_signature_title'] = "Change Signature";
$l['usercp_signature_head'] = "Change Signature";
$l['usercp_signature_noaccess'] = "You don't have authorisation to change your signature.";
$l['usercp_signature_submit'] = "Update";

$l['usercp_conversations_title'] = "Conversations";
$l['usercp_conversations_head'] = "Conversations";
$l['usercp_conversations_name'] = "Name";
$l['usercp_conversations_lastreply'] = "Last Reply";
$l['usercp_conversations_create'] = "Create Conversation";
$l['usercp_conversations_create_title'] = "Conversation Maker";
$l['usercp_conversations_create_head'] = "Conversation Maker";
$l['usercp_conversations_create_name'] = "Name";
$l['usercp_conversations_create_name_placeholder'] = "Manager Meeting";
$l['usercp_conversations_create_content'] = "Content";
$l['usercp_conversations_create_submit'] = "Create";
$l['usercp_conversations_create_target'] = "Participant";
$l['usercp_conversations_view_title'] = "$1 Conversation";
$l['usercp_conversations_view_head'] = "$1 Conversation";
$l['usercp_conversations_view_invite'] = "Invite";
$l['usercp_conversations_view_close'] = "Close";
$l['usercp_conversations_view_unknown'] = "Unknown User";
$l['usercp_conversations_view_unknown_group'] = "Unknown";
$l['usercp_conversations_view_level'] = "Level";
$l['usercp_conversations_view_rep'] = "Respect";
$l['usercp_conversations_view_group'] = "Group";
$l['usercp_conversations_view_newreply'] = "New Reply";
$l['usercp_conversations_view_content'] = "Content";
$l['usercp_conversations_view_submit'] = "Submit";
$l['usercp_conversations_invite_title'] = "Inviting to Conversation";
$l['usercp_conversations_invite_head'] = "Inviting to Conversation";
$l['usercp_conversations_invite_username'] = "Username";
$l['usercp_conversations_invite_submit'] = "Invite";
$l['usercp_conversations_invite_baduser'] = "The target user does not exist.";

$l['usercp_profile_title'] = "Profile Settings";
$l['usercp_profile_head'] = "Profile Settings";
$l['usercp_profile_active'] = "Enable Profile";
$l['usercp_profile_friends_only'] = "Only allow friends";
$l['usercp_profile_enable_comments'] = "Enable Profile Comments";
$l['usercp_profile_friends_only_comments'] = "Only allow friends to comment"; 	
$l['usercp_profile_enable_signature'] = "Enable Comment Signatures"; 	
$l['usercp_profile_show_friends'] = "Enable Friends Module";
$l['usercp_profile_theme_override'] = "Profile Theme";
$l['usercp_profile_user_page'] = "Custom Content";
$l['usercp_profile_submit'] = "Update Profile";
$l['usercp_profile_updated'] = "The profile was successfully updated.";

$l['usercp_titles_title'] = 'Title Manager';
$l['usercp_titles_head'] = "Title List";
$l['usercp_titles_setactive'] = "Set as Active";
$l['usercp_titles_honor_head'] = "Honorary Title";
$l['usercp_titles_honor_desc'] = "You currently have an honorary title, so you aren't able to change your title without forfeiting your honorary title.";
$l['usercp_titles_notid'] = "You haven't provided a Title ID.";
$l['usercp_titles_badtitle'] = "You do not have access to this title yet.";
$l['usercp_titles_updated'] = "You have successfully changed your title.";
$l['usercp_titles_notitles'] = "You haven't unlocked any titles yet.";

$l['usercp_friend_invites_title'] = "Friend Invites";
$l['usercp_friend_invites_head'] = "Friend Invites";
$l['usercp_friend_invites_approve'] = "Approve";
$l['usercp_friend_invites_decline'] = "Decline";
$l['usercp_friend_invites_nouid'] = "You haven't selected any invites to approve / decline.";
$l['usercp_friend_invites_noapproval'] = "You haven't selected a valid button.";
$l['usercp_friend_invites_baduid'] = "You haven't provided a valid UID.";
$l['usercp_friend_invites_santa'] = "Santa is too busy to accept your friend invite.";
$l['usercp_friend_invites_noinvite'] = "The friend invite no longer exists.";
$l['usercp_friend_invites_alreadyfriends'] = "You are already friends with this user.";
$l['usercp_friend_invites_success'] = "The friend invites were successfully updated.";
$l['usercp_friend_invites_none'] = "You haven't received any friend invites yet.";

// Categories..
$l['usercp_cat_head'] = "UserCP";
$l['usercp_cat_home'] = "Home";
$l['usercp_cat_critical'] = "Critical Settings";
$l['usercp_cat_avatar'] = "Avatar Manager";
$l['usercp_cat_signature'] = "Change Signature";
$l['usercp_cat_conversations'] = "Conversations";
$l['usercp_cat_profile'] = "Your Profile";
$l['usercp_cat_titles'] = "Title Manager";
$l['usercp_cat_friend_invites'] = "Friend Invites";
$l['usercp_cat_friends'] = "My Friends";

// Errors..
$l['usercp_critical_nocurrent'] = "No current password was specified.";
$l['usercp_critical_nopassword'] = "No new password was specified.";
$l['usercp_critical_noemail'] = "No email was specified.";
$l['usercp_critical_wrongcurrent'] = "You have not entered the correct current password.";
$l['usercp_convos_noconvos'] = "There are currently no ongoing conversations.";
$l['usercp_convos_notitle'] = "No title was provided for this conversation.";
$l['usercp_convos_nocontent'] = "No content was provided for this conversation.";
$l['usercp_convos_notarget'] = "No target user was specified.";
$l['usercp_convos_noconvo'] = "This conversation does not exist.";
$l['usercp_convos_noutitle'] = "No usertitle.";
$l['usercp_convos_readonly'] = "This conversation is set as readonly.";

// Misc.
$l['usercp_unavailable'] = "This feature is not available yet.";
$l['usercp_enable'] = "Enable";
$l['usercp_disable'] = "Disable";
$l['usercp_yes'] = "Yes";
$l['usercp_no'] = "No";
$l['usercp_default'] = "Default";