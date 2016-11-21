<?php
/*
	Online Staff Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function gadget_whosonline_staff_init(&$templateList)
{
	$templateList[] = 'gadget_wol';
}

function gadget_whosonline_staff()
{
	global $main, $tmpls, $perms, $db, $plugins, $lang, $cache;
	
	// A plugin might want to override this gadget with it's own implementation of it..
	if(($res = $plugins->hook("gadget_wol_staff_start"))!==null) return $res;
	
	$cutoff = $main->settings['wol_cutoff'] * 60;
	$wcut = time() - $cutoff;
	
	// Grab the online staff members
	$wol = $db->join('*','users','usergroups','gid','gid',"users.timeloc>'{$wcut}' AND (is_super_mod=1 OR is_admin=1 OR is_super_admin=1 OR uid='{$main->founder}')",15);
	
	// Is anyone online?
	$tmpls->assign("wol_head", $lang->get('gadgets_wol_staff_head'));
	$tmpls->assign("wol_type",'wol_staff');
	if($wol==0)
	{
		$tmpls->assign("onlineCount",0);
		$tmpls->assign("wol_list", $lang->get('gadgets_wol_staff_none'));
		
		// Render this for use in the index
		$wol = $tmpls->render('gadget_wol');
	}
	else {
		if(isset($wol['uid'])) $wol = array($wol);
		$list = $prefix = $suffix = "";
		$i = 1;
		$last = count($wol);
		foreach($wol as $user)
		{
			if(empty($user['avatar']))
			{
				$avatar = "//{$main->settings['site_url']}/images/no-avatar.png";
				$avatarHeight = 48;
				$avatarWidth = 48;
			} else {
				$avatar = str_replace('{SITE_URL}',"//".$main->settings['site_url'], $user['avatar']);
				$avatarHeight = $user['avatarHeight'];
				$avatarWidth = $user['avatarWidth'];
			}
			
			$umarkup = markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour']);
			$list .= "<a title='{$user['displayname']}' href='".get_profile_link($user['uid'])."'>
				<img src='{$avatar}' width='{$avatarWidth}' />
				<span class='username'>{$umarkup}</span>
			</a>";
		}
		// Assign the list to templates..
		$tmpls->assign('wol_list', $list);
		
		// How many people are currently online?
		$ocount = count($wol);
		if($ocount>=15) $ocount = $db->row_count("users","*","users.timeloc>'{$wcut}'{$params}");
		$tmpls->assign("onlineCount", $ocount);
		
		// Render this for use in the index
		$wol = $tmpls->render('gadget_wol');
	}
	
	$plugins->hook("gadget_wol_staff_end", $wol);
	return $wol;
}