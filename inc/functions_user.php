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
		if(($res = $plugins->hook("functions_getAvatar_noavatar", $user))!==null) return $res;
		
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

/**
*
*	This function takes in a string and adds a random colour to each character in it.
*	$string - The string which you want to have a random colour added to.
*
**/
function ranColour($string)
{
	$colist = array("red","green","blue","purple","#CC5500","black","cyan","magenta","navy","maroon");
	$out = "";
	$strlen = strlen($string);
	$i = 1;
	while($i<=$strlen)
	{
		$ran = rand(1, count($colist));
		$out .= "<span style='color: ".$colist[$ran-1].";'>".$string[$i-1]."</span>";
		$i++;
	}
	return $out;
}

/**
*
*	$name - The name which you wish to be marked up.
*	$start - The markup which you wish to have as a prefix.
*	$end - The markup which you wish to have as a suffix.
*	$multi - Whether the ranColour() function will take over the markup.
*
**/
function markup($name, $start, $end, $multi = 0)
{
	if($multi==1) return ranColour($name);
	if(empty($start)) $start = "";
	if(empty($end)) $end = "";
	
	global $plugins;
	$plugins->hook("markup", $start, $name, $end);
	
	return $start.$name.$end;
}

function getLevel($score = 0, $level = 0)
{
	global $plugins, $main;
	if(!$score) return 0;
	
	if(($res = $plugins->hook("level_start", $score, $level))!==null) return $res;
	
	// Base to start from..
	if($level > 1) $i = $level + 4;
	else $i = 5;
	
	// Level loop..
	while($i <= 24)
	{
		// Calculate the next level..
		$points = (pow(2, $i) - pow(2, $i - 3) - ($i - 2)) * $main->settings['level_modifier'];
		
		// Another rule for really high levels..
		if($level >= 10) $points = $points -= pow(2, $i - 3);
		
		// Still going?
		if($score < $points) break;
		else $level = ($i - 4);
		
		// Increment this..
		$i++;
	}
	
	$plugins->hook("level_end");
	return $level;
}