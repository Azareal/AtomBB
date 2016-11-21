<?php
/*
	Organization Basic Gadget
	Copyright (c) Azareal 2012 - 2017.
*/

function gadget_organization()
{
	global $main;
	
	$founder = getUser(1, true);
	$fname = markup($founder['displayname'], $founder['style_start'], $founder['style_end'], $founder['is_multi_colour']);
	$foundedAt = date("Y-m-d", $main->settings['foundedAt']);
	return "<div itemscope itemtype='http://schema.org/Organization'>
	<table>
		<tr><td class='thead' colspan=2>
			<a itemprop='url' href='//{$main->settings['site_url']}/pages/?area={$main->settings['about_page']}'>Site Info</a>
		</td></tr>
		<tr>
			<td class='tbody'>Name:</td>
			<td class='tbody' itemprop='name'>{$main->settings['site_name']}</td>
		</tr>
		<tr>
			<td class='tbody'>Founder:</td>
			<td class='tbody' itemprop='founder'>{$fname}</td>
		</tr>
		<tr>
			<td class='tbody'>Founded:</td>
			<td class='tbody' itemprop='foundingDate'>{$foundedAt}</td>
		</tr>
	</table>
</div>
";
}