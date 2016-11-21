<?php
/*
	Who's Online Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function gadget_whosonline_init(&$templateList)
{
	$templateList[] = 'gadget_wol';
}

function gadget_whosonline()
{
	global $main, $tmpls, $perms, $db, $plugins, $lang, $cache;
	
	$cutoff = $main->settings['wol_cutoff'] * 60;
	$wcut = time() - $cutoff;
	
	// Only show banned users to global staff..
	if(!$perms->is("super_mod")) $params = " AND usergroups.is_banned_group=0";
	else $params = "";
	
	// Grab the online users
	$wol = $db->join('*','users','usergroups','gid','gid',"users.timeloc>'{$wcut}'{$params}",15);
	
	// Is anyone online?
	$tmpls->assign("wol_type",'wol_all');
	if($wol==0)
	{
		$tmpls->assign("wol_head",$lang->sub('gadgets_wol_head', 0));
		$tmpls->assign("onlineCount",0);
		$tmpls->assign("wol_list", $lang->get('gadgets_wol_none'));
		
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
			// Don't have too many users on this list..
			if($i==15) {
				$sep = "<a href='//{$main->settings['site_url']}/online.php'>..</a>";
				$list .= "<a href='".get_profile_link($user['uid'])."'>".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."</a>{$sep}";
				break;
			}
			elseif($i!=$last) $sep = ', '; // Comma seperating the users..
			
			// The last user..
			else $sep = "";
			$list .= "<a href='".get_profile_link($user['uid'])."'>".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."</a>{$sep}";
			$i++;
		}
		// Assign the list to templates..
		$tmpls->assign('wol_list', $list);
		
		// How many people are currently online?
		$ocount = count($wol);
		if($ocount>=15) $ocount = $db->row_count("users","*","users.timeloc>'{$wcut}'{$params}");
		$tmpls->assign("onlineCount", $ocount);
		$tmpls->assign("wol_head", $lang->sub('gadgets_wol_head', $ocount));
		
		// All time high?
		if($cache->data['topOnline_count'] < $ocount)
		{
			$cache->data['topOnline_count'] = $ocount;
			$cache->data['topOnline_time'] = time();
		}
		
		// Render this for use in the index
		$wol = $tmpls->render('gadget_wol');
	}
	
	$plugins->hook("index_wol_end", $wol);
	return $wol;
}