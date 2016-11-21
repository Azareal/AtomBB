<?php
/*
	MyInfo Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function gadget_myinfo_init(&$templateList)
{
	global $main;
	if($main->user['loggedin']) $templateList[] = "gadget_myinfo";
	else $templateList[] = "gadget_login";
}

function gadget_myinfo()
{
	global $main, $tmpls;
	
	if($main->user['loggedin'])
	{
		$tmpls->assign("uname", markup($main->user['displayname'], $main->group['style_start'], $main->group['style_end'], $main->group['is_multi_colour']));
		
		$avatar = "<img src='//{$main->settings['site_url']}/images/no-avatar.png' width=64 height=64 />";
		
		if(!empty($main->user['avatar']))
		{
			// Get the avatar URL..
			$avatar = str_replace("{SITE_URL}","//".$main->settings['site_url'], $main->user['avatar']);
			
			// Calculate the height..
			if(empty($main->user['avatarHeight'])) $avatarHeight = "";
			elseif($main->user['avatarHeight'] > $main->settings['avatar_heightmax']) $avatarHeight = "height='{$main->settings['avatar_heightmax']}'";
			else $avatarHeight = "height='{$main->user['avatarHeight']}'";
			
			// Calculate the width..
			if(empty($main->user['avatarWidth'])) $avatarWidth = "";
			elseif($main->user['avatarWidth'] > $main->settings['avatar_widthmax']) $avatarWidth = "width='{$main->settings['avatar_widthmax']}'";
			else $avatarWidth = "width='{$main->user['avatarWidth']}'";
			
			$avatar = "<img class='myinfo_avatar' src='{$avatar}' {$avatarWidth} style='border-radius: 5px;' />";
		}
		
		$tmpls->assign("avatar", $avatar); // Assign the avatar..
		$gadget = $tmpls->render("gadget_myinfo");
	}
	
	// Show a login form to guests..
	else $gadget = $tmpls->render("gadget_login");
	return $gadget;
}