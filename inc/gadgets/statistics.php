<?php
/*
	Statistics Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

function gadget_statistics()
{
	global $lang, $cache;
	
	$topOnlineCount = $lang->sub("gadgets_stats_online", $cache->data['topOnline_count']);
	$threadPosts = $lang->multi_sub("gadgets_stats_tposts", array($cache->data['postCount'], $cache->data['threadCount']));
	$userCount = $lang->sub("gadgets_stats_users", $cache->data['userCount']);
	
	return "<table>
	<tr><td class='thead'>Statistics</td></tr>
	<tr><td class='tbody'>
	The newest member is <a href='".get_profile_link($cache->data['lastUser'])."'>{$cache->data['lastUsername']}</a>
	<br />{$userCount}<br />{$topOnlineCount}<br />{$threadPosts}
</td></tr></table>";
}

// {$lang->get('index_founded')}: {$relative}<br />