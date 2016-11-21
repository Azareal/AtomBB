<?php
/*
	Organization Groups Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

function gadget_organization_groups()
{
	global $db, $main;
	
	$groups = $db->get('*',"usergroups",null,8);
	if(!$groups) return '';
	if(isset($groups['gid'])) $groups = array($groups);
	
	$list = '';
	foreach($groups as $group)
	{
		$gmarkup = markup($group['name'], $group['style_start'], $group['style_end'], $group['is_multi_colour']);
		if(!$main->settings['enable_stafflist']) $list .= "<tr><td class='tbody'>{$gmarkup}</td></tr>";
		else $list .= "<tr><td class='tbody'><a itemprop='url' href='//{$main->settings['site_url']}/group.php?gid={$group['gid']}'>{$gmarkup}</a></td></tr>";
	}
	
	return "<div itemscope itemtype='http://schema.org/Organization'>
	<link itemprop='sameAs' href='//{$main->settings['site_url']}/pages/?area={$main->settings['about_page']}' />
	<table>
		<tr><td class='thead'>Groups</td></tr>{$list}
	</table>
</div>";
}

