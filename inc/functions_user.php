<?php
/*
	AtomBB Global User Functions
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2016 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function getAvatar(&$user)
{
	global $main
	if(empty($user['avatar']))
	{
		$user['avatarHeight'] = min(128,$main->settings['avatar_heightmax']);
		$user['avatarWidth'] = min(128,$main->settings['avatar_widthmax']);
		return "//{$main->settings['site_url']}/images/no-avatar.png'";
	}
	
	// The new avatar storage format under development
	elseif($main['avatar'][0]=='.')
	{
		if(!file_exists(ABB_BASE."/uploads/avatars/{$user['uid']}{$main['avatar']}"))
		{
			$user['avatarHeight'] = min(128,$main->settings['avatar_heightmax']);
			$user['avatarWidth'] = min(128,$main->settings['avatar_widthmax']);
			return "//{$main->settings['site_url']}/images/no-avatar.png'";
		}
		return "//{$main->settings['site_url']}/uploads/avatars/{$user['uid']}{$main['avatar']}";
	}
	
	// The old avatar storage format and external avatars
	else return str_replace('{SITE_URL}',"//".$main->settings['site_url'], $user['avatar']);
}

function get_profile_link($uid)
{
	global $main, $plugins;
	if(($res = $plugins->hook("functions_profiles_get_link", $uid))!==null) return $res;
	
	if ($author['uid'] > 0) return "//{$main->settings['site_url']}/profiles/?uid={$uid}";
	else return "#";
}