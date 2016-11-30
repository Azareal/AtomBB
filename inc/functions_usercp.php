<?php
/*
	AtomBB UserCP Functions
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function usercp_build_nav()
{
	global $main, $tmpls, $lang, $plugins;
	$cats = array(
		"home" => array(
			"name" => $lang->get('usercp_cat_home'),
			"icon" => "//{$main->settings['site_url']}/images/home.png"
		),
		"critical" => array(
			"name" => $lang->get('usercp_cat_critical'),
			"icon" => "//{$main->settings['site_url']}/images/settings.png"
		),
		"avatar" => array(
			"name" => $lang->get('usercp_cat_avatar'),
			"icon" => "//{$main->settings['site_url']}/images/avatar.png"
		),
		"signature" => array(
			"name" => $lang->get('usercp_cat_signature'),
			"icon" => "//{$main->settings['site_url']}/images/signature.png"
		),
		"titles" => $lang->get('usercp_cat_titles'),
		"friend-invites" => $lang->get('usercp_cat_friend_invites'),
		"friends" => array(
			"name" => $lang->get('usercp_cat_friends'),
			"path" => "//{$main->settings['site_url']}/friends.php?action=view",
			"icon" => "//{$main->settings['site_url']}/images/group.png"
		),
		"profile" => $lang->get('usercp_cat_profile'),
		"conversations" => array(
			"name" => $lang->get('usercp_cat_conversations'),
			"path" => "//{$main->settings['site_url']}/convos.php",
			"icon" => "//{$main->settings['site_url']}/images/group.png"
		)
	);
	
	$clist = "";
	$tmpls->stick("clist", $clist);
	
	if(!$main->settings['enable_signatures']) unset($cats['signature']);
	$plugins->hook("usercp_cats", $cats);
	
	foreach($cats as $key => $cat)
	{
		if(is_array($cat))
		{
			if(isset($cat['path'])) $path = $cat['path'];
			else $path = "./usercp.php?page={$key}";
			
			$clist .= "<tr><td class='tbody'>
				<img style='padding-right: 5px;' src='{$cat['icon']}' height=16 width=16 /><a href='{$path}'>{$cat['name']}</a>
			</td></tr>\n";
		}
		else $clist .= "<tr><td class='tbody'><a href='./usercp.php?page={$key}'>{$cat}</a></td></tr>\n";
	}
}