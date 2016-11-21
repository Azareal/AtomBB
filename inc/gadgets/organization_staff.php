<?php
/*
	Organization Staff Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

function gadget_organization_staff()
{
	global $db, $main;
	if(!$main->settings['enable_stafflist']) return '';
	
	//$groups = $db->get(array('gid','name','style_start','style_end','is_multi_colour'),'usergroups',$where,null,'group_order');
	$staves = $db->join('*','usergroups','users','gid','gid',"usergroups.show_forumstaff=1",8,'group_order');
	if(!$staves) return '';
	if(isset($staves['uid'])) $staves = array($staves);
	
	foreach($staves as $staff)
	{
		if(empty($staff['avatar']))
		{
			$user_avatar = "//{$main->settings['site_url']}/images/no-avatar.png";
			$user_avatar_height = 48;
			$user_avatar_width = 48;
		} else {
			$user_avatar = str_replace('{SITE_URL}',"//".$main->settings['site_url'], $staff['avatar']);
			$user_avatar_height = $staff['avatarHeight'];
			$user_avatar_width = $staff['avatarWidth'];
		}
		
		$smarkup = markup($staff['displayname'], $staff['style_start'], $staff['style_end'], $staff['is_multi_colour']);
		$ulink = get_profile_link($staff['uid']);
		$list = "<tr><td class='tbody' itemprop='employee' itemscope itemtype='http://schema.org/Person'>
		<img style='max-width: 48px; float: left;margin-right: 5px;' itemprop='image' src='{$user_avatar}' width='{$user_avatar_width}' />
		<a itemprop='url' style='font-size: 18px;margin-top: 8px;float: left;' href='{$ulink}'>{$smarkup}</a></td></tr>";
	}
	
	return "<div itemscope itemtype='http://schema.org/Organization'>
	<link itemprop='sameAs' href='//{$main->settings['site_url']}/pages/?area={$main->settings['about_page']}' />
	<table>
		<tr><td class='thead'>The Staff</td></tr>{$list}
	</table>
</div>";
}