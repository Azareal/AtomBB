<?php
/*
	AtomBB Admin Template Data Insertion File.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017
*/

use Hadron\fields as fields;

// Is someone trying to access this directly?
if(!defined("IN_INSTALL")) die("You are not allowed to access this file directly.");

$db->insert('admin_templates', array(
	"name" => 'header',
	"content" => <<<header
	<div class="top">
		<a rel="home" href="//{\$settings['site_url']}/index.php">
			<h1>{\$settings['site_name']}</h1>
		</a>
	</div>
	<nav>
		<div class="nav">
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/index.php">
				<img height=18 width=18 src="../images/home.png" />{\$lang['header_nav_home']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/users.php">
				<img height=18 width=18 src="../images/group.png" />{\$lang['header_nav_users']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/forums.php">
				{\$lang['header_nav_forums']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/settings.php">
				<img height=18 width=18 src="../images/settings.png" />{\$lang['header_nav_settings']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/themes.php">
				{\$lang['header_nav_appearance']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/plugins.php">
				{\$lang['header_nav_plugins']}
			</a></div>
			<div class="navItem"><a href="//{\$settings['site_url']}/{\$admindir}/system.php">
				{\$lang['header_nav_tools']}
			</a></div>
			{!admin_nav}
			<div class="navRight">{\$lang['header_nav_logout']}</div>
		</div>
	</nav>
header
));

$db->insert('admin_templates',array(
	"name" => 'footer',
	"content" => <<<tem
<div style="float: left;width: 100%;">
	<div id="footer">Copyright &copy; <a href="http://atombb.com">Azareal</a> 2012 - {\$year}</div>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'page',
	"content" => <<<tem
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>{\$title} - {\$settings['site_name']}</title>
		<script type="text/javascript" src="//{\$settings['site_url']}/js/jquery-1.11.2.min.js"></script>
		<script type="text/javascript" src="//{\$settings['site_url']}/panel/js/global.js"></script>
		{\$libraries}
		<link type="text/css" href="//{\$settings['site_url']}/css/admin.css" rel="stylesheet" />
		{\$headers}
	</head>
	<body>
		{\$deferred}{include("header")}{\$body}{include("footer")}
	</body>
</html>
tem
));

$db->insert('admin_templates',array(
	"name" => 'index',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_home_nav}</table>
</div>
<div class="block">
	<table class="area">
		<tr><td class="thead" style="border-top-right-radius: 0px;" colspan=2>{\$lang['module_tstats']}</td></tr>
		<tr>
			<td class="tbody">{\$lang['module_tstats_users']}:</td>
			<td class="tbody">{\$users}</td>
		</tr>
		<tr>
			<td class="tbody">{\$lang['module_tstats_topics']}:</td>
			<td class="tbody">{\$topics}</td>
		</tr>
		<tr>
			<td class="tbody">{\$lang['module_tstats_posts']}:</td>
			<td class="tbody">{\$posts}</td>
		</tr>
		<tr>
			<td class="tbody">{\$lang['module_tstats_dailyusers']}:</td>
			<td class="tbody">{\$dailyusers}</td>
		</tr>
		<tr>
			<td class="tbody">{\$lang['module_tstats_uniqueusers']}:</td>
			<td class="tbody">{\$uniqueusers}</td>
		</tr>
	</table>
</div>
<div class="block">
	<table class="area">
		<tr><td class="thead">{\$lang['module_gstats']}</td></tr>
		<tr><td class="tbody">{\$lang['module_gstats_desc']}</td></tr>
	</table>
</div>
<div class="block">
	<table class="area">
		<tr><td class="thead">{\$lang['module_news']}</td></tr>
		<tr><td class="tbody">{\$news}</td></tr>
	</table>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'users',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" style="border-top-right-radius: 0px;" colspan=2>{\$lang['users_head']}</td>
			{!admin_users_head}
			<td class="thead" style="border-top-left-radius: 0px;"><input name="selectAll" type="checkbox" value=3 /></td>
		</tr>
		{\$rows}
	</table>
	<div style="float: left;margin-top: 5px;">{\$pages}</div>
	<div style="float: right;margin-top: 5px;">
		<select>
			<option>{\$lang['users_edit']}</option>
			<option>{\$lang['users_delete']}</option>
			<option>{\$lang['users_ban']}</option>
			{!admin_users_options}
		</select>
		<button type="submit" name="submit">{\$lang['users_submit']}</button>
	</div>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'users_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_user.php?uid={\$uid}">{\$name}</a></td>
	{!admin_users_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_user.php?uid={\$uid}">
			<img height=24 width=24 src="../images/edit.png" />
		</a>
		<img height=24 width=24 src="../images/ban-user-24.png" />
		<img height=24 width=24 src="../images/delete-24.png" />
	</td>
	<td class="tbody" style="width:10px;"><input name="item[]" type="checkbox" value=1 /></td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_user',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_user" action="./edit_user.php?uid={\$uid}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['edit_user_tabs_general']}</a></li>
				<li><a href="#tabs-mods">{\$lang['edit_user_tabs_moderation']}</a></li>
				{if(\$can_edit_perms)}<li><a href="#tabs-perms">{\$lang['edit_user_tabs_permissions']}</a></li>{/if}
				{!admin_users_edit_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_user_username']}:</td>
						<td class="tbody"><input name="username" type="text" placeholder="{\$lang['edit_user_username_placeholder']}" value="{\$username}"/></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_name']}:</td>
						<td class="tbody"><input name="dispname" type="text" placeholder="{\$lang['edit_user_name_placeholder']}" value="{\$dispname}"/></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_pass']}:</td>
						<td class="tbody"><input name="password" type="password" placeholder="{\$lang['edit_user_pass_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_group']}:</td>
						<td class="tbody"><select name="gid">{\$groups}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_usertitle']}:</td>
						<td class="tbody"><input name="usertitle" type="text" placeholder="{\$lang['edit_user_usertitle_placeholder']}" value="{\$usertitle}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_email']}:</td>
						<td class="tbody"><input name="email" type="email" placeholder="{\$lang['edit_user_email_placeholder']}" value="{\$email}" /></td>
					</tr>
					{if(\$can_edit_users_statistics)}
					<tr>
						<td class="tbody">{\$lang['edit_user_topics']}:</td>
						<td class="tbody"><input name="topics" type="number" placeholder=0 value="{\$topics}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_posts']}:</td>
						<td class="tbody"><input name="posts" type="number" placeholder=0 value="{\$posts}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_big_posts']}:</td>
						<td class="tbody"><input name="big_posts" type="number" placeholder=0 value="{\$big_posts}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_user_clevel']}:</td>
						<td class="tbody"><input name="clevel" type="number" placeholder=0 value="{\$clevel}" /></td>
					</tr>
					{/if}
					{!admin_users_edit_general}
				</table>
			</div>
			<div id="tabs-mods" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_user_warnpoints']}:</td>
						<td class="tbody"><input name="warnpoints" type="number" placeholder=0 value="{\$warnpoints}" /></td>
					</tr>
					{!admin_users_edit_moderation}
				</table>
			</div>
			{if(\$can_edit_perms)}<div id="tabs-perms">Coming Soon!</div>{/if}
			{!admin_users_edit_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['edit_user_options_head']}</td></tr>
				{!admin_users_edit_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_user" value=1>{\$lang['edit_user_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_user',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="create_user" action="./create_user.php" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['create_user_tabs_general']}</a></li>
				<li><a href="#tabs-mods">{\$lang['create_user_tabs_moderation']}</a></li>
				{if(\$can_edit_perms)}<li><a href="#tabs-perms">{\$lang['create_user_tabs_permissions']}</a></li>{/if}
				{!admin_users_create_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_user_username']}:</td>
						<td class="tbody"><input name="username" type="text" placeholder="{\$lang['create_user_username_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_name']}:</td>
						<td class="tbody"><input name="dispname" type="text" placeholder="{\$lang['create_user_name_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_pass']}:</td>
						<td class="tbody"><input name="password" type="password" placeholder="{\$lang['create_user_pass_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_group']}:</td>
						<td class="tbody"><select name="gid">{\$groups}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_usertitle']}:</td>
						<td class="tbody"><input name="usertitle" type="text" placeholder="{\$lang['create_user_usertitle_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_email']}:</td>
						<td class="tbody"><input name="email" type="email" placeholder="{\$lang['create_user_email_placeholder']}" /></td>
					</tr>
					{if(\$can_edit_users_statistics)}
					<tr>
						<td class="tbody">{\$lang['create_user_topics']}:</td>
						<td class="tbody"><input name="topics" type="number" placeholder=0 /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_posts']}:</td>
						<td class="tbody"><input name="posts" type="number" placeholder=0 /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_big_posts']}:</td>
						<td class="tbody"><input name="big_posts" type="number" placeholder=0 /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_user_clevel']}:</td>
						<td class="tbody"><input name="clevel" type="number" placeholder=0 /></td>
					</tr>
					{/if}
					{!admin_users_create_general}
				</table>
			</div>
			<div id="tabs-mods" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_user_warnpoints']}:</td>
						<td class="tbody"><input name="warnpoints" type="number" placeholder=0 /></td>
					</tr>
					{!admin_users_create_moderation}
				</table>
			</div>
			{if(\$can_edit_perms)}<div id="tabs-perms">Coming Soon!</div>{/if}
			{!admin_users_create_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['create_user_options_head']}</td></tr>
				{!admin_users_create_options}
				<tr><td class="tbody" colspan=2><button type="submit" name="submit_user" value=1>{\$lang['create_user_options_submit']}</button></td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'groups',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" style="border-top-right-radius: 0px;" colspan=2>{\$lang['groups_head']}</td>
			{!admin_groups_head}
			<td class="thead" style="border-top-left-radius: 0px;"><input name="selectAll" type="checkbox" value=3 /></td>
		</tr>{\$rows}
	</table>
	<div style="float: left;margin-top: 5px;">{\$pages}</div>
	<div style="float: right;margin-top: 5px;">
		<select>
			<option>{\$lang['groups_edit']}</option>
			<option>{\$lang['groups_delete']}</option>
			<option>{\$lang['groups_ban']}</option>
			{!admin_groups_options}
		</select>
		<button type="submit" name="submit">{\$lang['groups_submit']}</button>
	</div>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'groups_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_group.php?gid={\$gid}">{\$name}</a></td>
	{!admin_groups_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_group.php?gid={\$gid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
	<td class="tbody" style="width:10px;"><input name="item[]" type="checkbox" value=1 /></td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_group',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">
	{\$notice}
	<form name="edit_group" action="./edit_group.php?gid={\$gid}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['edit_group_tabs_general']}</a></li>
				<li><a href="#tabs-forum-perms">{\$lang['edit_group_tabs_forum_permissions']}</a></li>
				<li><a href="#tabs-forum-mod-perms">{\$lang['edit_group_tabs_forum_mod_permissions']}</a></li>
				<li><a href="#tabs-perms">{\$lang['edit_group_tabs_permissions']}</a></li>
				{!admin_groups_edit_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_group_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['edit_group_name_placeholder']}" value="{\$name}"/></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_group_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['edit_group_desc_placeholder']}" value="{\$desc}" style="width: 75%;"/></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['edit_group_isbanned_desc']}">{\$lang['edit_group_isbanned']}</span>?</td>
						<td class="tbody"><select name="is_banned">
							{eif(\$is_banned)}<option value=1 selected>{\$lang['edit_group_yes']}</option><option value=0>{\$lang['edit_group_no']}</option>{/eif}{else}<option value=1>{\$lang['edit_group_yes']}</option><option value=0 selected>{\$lang['edit_group_no']}</option>{/else}
						</select></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['edit_group_isstaff_desc']}">{\$lang['edit_group_issuper']}</span>?</td>
						<td class="tbody"><select name="is_super">
							{eif(\$is_super)}<option value=1 selected>{\$lang['edit_group_yes']}</option><option value=0>{\$lang['edit_group_no']}</option>{/eif}{else}<option value=1>{\$lang['edit_group_yes']}</option><option value=0 selected>{\$lang['edit_group_no']}</option>{/else}
						</select></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['edit_group_isadmin_desc']}">{\$lang['edit_group_isadmin']}</span>?</td>
						<td class="tbody"><select name="is_admin">
							{eif(\$is_admin)}<option value=1 selected>{\$lang['edit_group_yes']}</option><option value=0>{\$lang['edit_group_no']}</option>{/eif}{else}<option value=1>{\$lang['edit_group_yes']}</option><option value=0 selected>{\$lang['edit_group_no']}</option>{/else}
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_group_style']}:</td>
						<td class="tbody">
							<input name="style_start" type="text" placeholder="{\$lang['edit_group_style_start']}" value="{\$style_start}"/>
							{\$lang['edit_group_style_bit']}
							<input name="style_end" type="text" placeholder="{\$lang['edit_group_style_end']}" value="{\$style_end}"/>
						</td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['edit_group_ismulti_desc']}">{\$lang['edit_group_ismulti']}</span>?</td>
						<td class="tbody"><select name="is_multi_colour">
							{eif(\$is_multi)}<option value=1 selected>{\$lang['edit_group_yes']}</option><option value=0>{\$lang['edit_group_no']}</option>{/if}{else}<option value=1>{\$lang['edit_group_yes']}</option><option value=0 selected>{\$lang['edit_group_no']}</option>{/else}
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_group_level']}:</td>
						<td class="tbody"><input name="level" type="number" placeholder=0 value="{\$level}"/></td>
					</tr>
					{!admin_groups_edit_general}
				</table>
			</div>
			<div id="tabs-forum-perms" style="padding: 0px;font-size: 13px !important;"><table class="area" style="width: 100%;border-radius: 0px;">{\$fperms}</table></div>
			<div id="tabs-forum-mod-perms" style="padding: 0px;font-size: 13px !important;"><table class="area" style="width: 100%;border-radius: 0px;">{\$fmodperms}</table></div>
			<div id="tabs-perms" style="padding: 0px;font-size: 13px !important;"><table class="area" style="width: 100%;border-radius: 0px;">{\$plist}</table></div>
			{!admin_groups_edit_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['edit_group_options_head']}</td></tr>				
				{!admin_groups_edit_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_group" value=1>{\$lang['edit_group_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_group_permission',
	"content" => <<<tem
<tr>
	<td class="tbody" style="padding-top: 3px;padding-bottom: 3px;"><span title="{\$pdesc}">{\$pname}</span>?</td>
	<td class="tbody" style="padding-top: 3px;padding-bottom: 3px;"><select name="perm_{\$perm}">{\$poptions}</select></td>
	{!admin_groups_edit_perm_row}
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_group',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="create_group" action="./create_group.php" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['create_group_tabs_general']}</a></li>
				<li><a href="#tabs-perms">{\$lang['create_group_tabs_permissions']}</a></li>
				{!admin_groups_create_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_group_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['create_group_name_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_group_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['create_group_desc_placeholder']}" style="width: 75%;"/></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['create_group_isbanned_desc']}">{\$lang['create_group_isbanned']}</span>?</td>
						<td class="tbody"><select name="is_banned">
							<option value=1>{\$lang['create_group_yes']}</option>
							<option value=0 selected>{\$lang['create_group_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['create_group_issuper_desc']}">{\$lang['create_group_issuper']}</span>?</td>
						<td class="tbody"><select name="is_super">
							<option value=1>{\$lang['create_group_yes']}</option>
							<option value=0 selected>{\$lang['create_group_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['create_group_isadmin_desc']}">{\$lang['create_group_isadmin']}</span>?</td>
						<td class="tbody"><select name="is_admin">
							<option value=1>{\$lang['create_group_yes']}</option>
							<option value=0 selected>{\$lang['create_group_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_group_style']}:</td>
						<td class="tbody">
							<input name="style_start" type="text" placeholder="{\$lang['create_group_style_start']}" />
							{\$lang['create_group_style_bit']}
							<input name="style_end" type="text" placeholder="{\$lang['create_group_style_end']}" />
						</td>
					</tr>
					<tr>
						<td class="tbody"><span title="{\$lang['create_group_ismulti_desc']}">{\$lang['create_group_ismulti']}</span>?</td>
						<td class="tbody"><select name="is_multi_colour">
							<option value=1>{\$lang['create_group_yes']}</option>
							<option value=0 selected>{\$lang['create_group_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_group_level']}:</td>
						<td class="tbody"><input name="level" type="number" placeholder=0 /></td>
					</tr>
					{!admin_groups_create_general}
				</table>
			</div>
			<div id="tabs-perms" style="padding: 0px;"><table class="area" style="width: 100%;border-radius: 0px;">{\$plist}</table></div>
			{!admin_groups_create_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['create_group_options_head']}</td></tr>				
				{!admin_groups_create_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_group" value=1>{\$lang['create_group_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_group_permission',
	"content" => <<<tem
<tr>
	<td class="tbody"><span title="{\$pdesc}">{\$pname}</span>?</td>
	<td class="tbody"><select name="perm_{\$perm}">
		<option value=1>{\$lang['create_group_yes']}</option>
		<option value=0 selected>{\$lang['create_group_no']}</option>
	</select></td>
	{!admin_groups_create_perm_row}
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'titles',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" style="border-top-right-radius: 0px;" colspan=3>
				{\$lang['titles_head']}<a href="./edit_title.php"><div style="float: right;"><button name="create_title">{\$lang['titles_buttons_create']}</button></div></a>
			</td>
			{!admin_titles_head}
		</tr>{\$rows}
	</table>
	<div style="float: left;margin-top: 5px;">{\$pages}</div>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'titles_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_title.php?tid={\$title_tid}">{\$title_name}</a></td>
	<td class="tbody">{\$title_criteria}</td>
	{!admin_titles_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_title.php?tid={\$title_tid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_title',
	"content" => <<<tem
<script>
$(document).ready(function(){
	$(".texteditor").sceditor({
		plugins: "bbcode",
		toolbarExclude: "table",
		emoticonsRoot: "../images/smilies/",
		emoticons:
		{
			dropdown:
			{
				":)": "smile-24.png",
				":D": "smile_big-24.png",
				":angel:": "angel-24.png",
				":cool:": "cool-24.png",
				":(": "sad-24.png",
				":'(": "crying-24.png",
				":O": "surprise-24.png",
				":P": "raspberry-24.png",
				";)": "wink-24.png"
			},
			more:
			{
				":$": "embarrassed-24.png",
				":monkey:": "monkey-24.png",
				":|": "plain-24.png",
				":devil:": "devilish-24.png"
			}
		},
		style: "../js/sceditor/themes/modern.min.css"
	});
});</script>
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_title" action="./edit_title.php?tid={\$ttitle['tid']}&action=execute" method="post">
		<input name="session" value="{\$session}" type="hidden" />
		<table class="area" style="width: 95%;">
			<tr><td class="thead" colspan=2>{\$lang['edit_title_head']}</td></tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_name']}:</td>
				<td class="tbody"><input name="name" type="text" value="{\$ttitle['name']}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_desc']}:</td>
				<td class="tbody"><textarea class="texteditor" style="width: 100%;" name="desc">{\$ttitle['desc']}</textarea></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_level']}:</td>
				<td class="tbody"><input name="level" type="text" value="{\$ttitle['level']}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_posts']}:</td>
				<td class="tbody"><input name="posts" type="text" value="{\$ttitle['posts']}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_topics']}:</td>
				<td class="tbody"><input name="topics" type="text" value="{\$ttitle['topics']}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_title_upvotes']}:</td>
				<td class="tbody"><input name="upvotes" type="text" value="{\$ttitle['upvotes']}" /></td>
			</tr>
			<tr><td class="tbody" colspan=2><input name="submit_title" value="{\$lang['edit_title_submit']}" type="submit" /></td></tr>
			{!admin_titles_edit_general}
		</table>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'penalties',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<div class="mainBlock">
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=4>
					{\$lang['penalties_head']}
					<!--<div style="float: right;"><a href="./create_penalty.php">
						<button name="create_penalty">{\$lang['penalties_create']}</button>
					</a></div>-->
				</td>
				{!admin_penalties_head}
			</tr>
			{\$rows}
		</table>
		<div style="float: left;margin-top: 5px;">{\$pages}</div>
	</div>
	<form action="./create_penalty.php" method="post">
		<div class="optionalBlock" style="float: left;width: 27%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['penalties_create_head']}</td></tr></tr>
				{!admin_penalties_create_head_rows}
				<tr>
					<td class="tbody">{\$lang['penalties_create_langname']}:</td>
					<td class="tbody"><input name="penalty_langstring" type="text" /></td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['penalties_create_auto_ban']}</td>
					<td class="tbody">
						<select name="penalty_auto_ban">
							<option selected value=0>{\$lang['penalties_no']}</option>
							<option value=1>{\$lang['penalties_yes']}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['penalties_create_banGroup']}:</td>
					<td class="tbody">
						<select name="penalty_banGroup">
							<option value=0>{\$lang['penalties_nogroup']}</option>
							{\$penalty_banGroup}
						</select>
					</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['penalties_create_newGroup']}:</td>
					<td class="tbody">
						<select name="penalty_newGroup">
							<option value=0>{\$lang['penalties_nogroup']}</option>
							{\$penalty_newGroup}
						</select>
					</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['penalties_create_duration']}:</td>
					<td class="tbody"><input name="penalty_duration" value=0 type="text" /></td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['penalties_create_points']}:</td>
					<td class="tbody"><input name="penalty_points" type="text" /></td>
				</tr>
				<tr><td class="tbody" colspan=2 style="text-align: center;">
					<button type="submit" name="submit_penalty" value=1>{\$lang['penalties_create_submit']}</button>
					<a href="./create_penalty.php"><button name="advanced" class="stopSubmission">{\$lang['penalties_create_advanced']}</button></a>
				</td></tr>
				{!admin_penalties_create_rows}
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'penalties_row',
	"content" => <<<tem
<tr>
	<td {\$colspan} class="tbody">
		<a href="./edit_penalty.php?pid={\$pid}">{\$pname}</a>
	</td>
	{!admin_penalties_row}
	
	{if(\$has_ban)}<td class="tbody">{\$banstring}</td>{/if}
	{if(\$perms_revoked)}<td class="tbody">{\$revokestring}</td>{/if}
	<td class="tbody">{\$scope}</td>
	
	<td class="tbody" style="width:80px;">
		<a href="./edit_penalty.php?pid={\$pid}">
			<img height=24 width=24 src="../images/edit.png" />
		</a>
		<img height=24 width=24 src="../images/delete-24.png" />
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_penalty',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./edit_penalty.php?pid={\$pid}" method="post">
		<input name="session" value="{\$session}" type="hidden" />
		<div id="tabs" style="float: left;width: 100%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['edit_penalty_tabs_general']}</a></li>
				<li><a href="#tabs-local">{\$lang['edit_penalty_tabs_local']}</a></li>
				<li><a href="#tabs-global">{\$lang['edit_penalty_tabs_global']}</a></li>
				{!admin_edit_penalty_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;border-radius: 0px;">
				<!-- Main Settings -->
				<table class="area" style="width: 100%;margin-bottom: 10px;border-radius:0px;">
					<!--<tr>
						<td class="thead" colspan=2>{\$lang['edit_penalty_head']}</td>
						{!admin_edit_penalty_head}
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_name']}:</td>
						<td class="tbody"><input name="penalty_name" value="{\$penalty_name}" type="text" /></td>
					</tr>-->
					<tr>
						<td class="tbody">{\$lang['edit_penalty_langstring']}:</td>
						<td class="tbody"><input name="penalty_langstring" value="{\$penalty_langstring}" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_auto_ban']}</td>
						<td class="tbody">
							<select name="penalty_auto_ban">
								<option {if(!\$penalty_auto_ban)}selected{/if} value=0>{\$lang['edit_penalty_no']}</option>
								<option {if(\$penalty_auto_ban)}selected{/if} value=1>{\$lang['edit_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_auto_post']}:</td>
						<td class="tbody">
							<select name="penalty_auto_post">
								<option {if(!\$penalty_auto_post)}selected{/if} value=0>{\$lang['edit_penalty_no']}</option>
								<option {if(\$penalty_auto_post)}selected{/if} value=1>{\$lang['edit_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_requireGroup']}:</td>
						<td class="tbody">
							<select name="penalty_requireGroup">
								<option value=0>{\$lang['edit_penalty_nogroup']}</option>
								{\$penalty_requireGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_banGroup']}:</td>
						<td class="tbody">
							<select name="penalty_banGroup">
								<option value=0>{\$lang['edit_penalty_nogroup']}</option>
								{\$penalty_banGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_newGroup']}:</td>
						<td class="tbody">
							<select name="penalty_newGroup">
								<option value=0>{\$lang['edit_penalty_nogroup']}</option>
								{\$penalty_newGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_duration']}:</td>
						<td class="tbody"><input name="penalty_duration" value="{\$penalty_duration}" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody" colspan=2 style="text-align: center;">
							<button name="submit_penalty" type="submit">{\$lang['edit_penalty_submit']}</button>
						</td>
					</tr>
					{!admin_edit_penalty_general_rows}
				</table>
				<!-- Automatic Penalties -->
				<table class="area" style="width: 100%;margin-bottom: 10px;">
					<tr>
						<td class="thead" colspan=2>{\$lang['edit_penalty_auto_head']}</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_auto_switch']}:</td>
						<td class="tbody">
							<select name="penalty_switch">
								<option {if(!\$penalty_switch)}selected{/if} value=0>{\$lang['edit_penalty_no']}</option>
								<option {if(\$penalty_switch)}selected{/if} value=1>{\$lang['edit_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_auto_manual_issue']}:</td>
						<td class="tbody">
							<select name="penalty_manual_issue">
								<option {if(!\$penalty_manual_issue)}selected{/if} value=0>{\$lang['edit_penalty_no']}</option>
								<option {if(\$penalty_manual_issue)}selected{/if} value=1>{\$lang['edit_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_auto_points']}:</td>
						<td class="tbody"><input name="penalty_points" value="{\$penalty_points}" type="text" /></td>
					</tr>
					{!admin_edit_penalty_auto_rows}
				</table>
				<!-- Global Cascade -->
				<table class="area" style="width: 100%;border-radius:0px;">
					<tr>
						<td class="thead" colspan=2>{\$lang['edit_penalty_global_cascade_head']}</td>
					</tr>
					<tr>
						<td class="tbody">
							{\$lang['edit_penalty_global_cascade_local_scope']}:<br />
							<small>({\$lang['edit_penalty_global_cascade_local_scope_desc']})</small>
						</td>
						<td class="tbody">
							<select name="penalty_local_scope">
								<option {if(!\$penalty_local_scope)}selected{/if} value=0>{\$lang['edit_penalty_no']}</option>
								<option {if(\$penalty_local_scope)}selected{/if} value=1>{\$lang['edit_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">
							{\$lang['edit_penalty_global_cascade_mods_required']}:<br />
							<small>({\$lang['edit_penalty_global_cascade_mods_required_desc']})</small>
						</td>
						<td class="tbody"><input name="penalty_mods_required" value="{\$penalty_mods_required}" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_penalty_global_cascade_area_max']}:</td>
						<td class="tbody"><input name="penalty_area_max" value="{\$penalty_area_max}" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody" colspan=2 style="text-align: center;">
							<button name="submit_penalty" type="submit">{\$lang['edit_penalty_submit']}</button>
						</td>
					</tr>
					{!admin_edit_penalty_cascade_rows}
				</table>
			</div>
			<div id="tabs-local" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius:0px;">{\$localPerms}</table>
			</div>
			<div id="tabs-global" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius:0px;">{\$globalPerms}</table>
			</div>
			{!admin_edit_penalty_tabs_body}
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'penalty_perm_row',
	"content" => <<<tem
<tr>
	<td class="tbody">{\$permstring}</td>
	<td class="tbody"><input name="newperms[{\$permname}]" value=1 type="checkbox" {if(\$perm_checked)}checked{/if} /></td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_penalty',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_users_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./create_penalty.php" method="post">
		<input name="session" value="{\$session}" type="hidden" />
		<div id="tabs" style="float: left;width: 100%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['create_penalty_tabs_general']}</a></li>
				<li><a href="#tabs-local">{\$lang['create_penalty_tabs_local']}</a></li>
				<li><a href="#tabs-global">{\$lang['create_penalty_tabs_global']}</a></li>
				{!admin_create_penalty_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;border-radius: 0px;">
				<!-- Main Settings -->
				<table class="area" style="width: 100%;margin-bottom: 10px;border-radius:0px;">
					<tr>
						<td class="tbody">{\$lang['create_penalty_langstring']}:</td>
						<td class="tbody"><input name="penalty_langstring" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_auto_ban']}</td>
						<td class="tbody">
							<select name="penalty_auto_ban">
								<option selected value=0>{\$lang['create_penalty_no']}</option>
								<option value=1>{\$lang['create_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_auto_post']}:</td>
						<td class="tbody">
							<select name="penalty_auto_post">
								<option selected value=0>{\$lang['create_penalty_no']}</option>
								<option value=1>{\$lang['create_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_requireGroup']}:</td>
						<td class="tbody">
							<select name="penalty_requireGroup">
								<option selected value=0>{\$lang['create_penalty_nogroup']}</option>
								{\$penalty_requireGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_banGroup']}:</td>
						<td class="tbody">
							<select name="penalty_banGroup">
								<option selected value=0>{\$lang['create_penalty_nogroup']}</option>
								{\$penalty_banGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_newGroup']}:</td>
						<td class="tbody">
							<select name="penalty_newGroup">
								<option selected value=0>{\$lang['create_penalty_nogroup']}</option>
								{\$penalty_newGroup}
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_duration']}:</td>
						<td class="tbody"><input name="penalty_duration" value="-1" type="text" /></td>
					</tr>
					<tr>
						<td class="tbody" colspan=2 style="text-align: center;">
							<button name="submit_penalty" type="submit">{\$lang['create_penalty_submit']}</button>
						</td>
					</tr>
					{!admin_create_penalty_general_rows}
				</table>
				<!-- Automatic Penalties -->
				<table class="area" style="width: 100%;margin-bottom: 10px;">
					<tr>
						<td class="thead" colspan=2>{\$lang['create_penalty_auto_head']}</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_auto_switch']}:</td>
						<td class="tbody">
							<select name="penalty_switch">
								<option selected value=0>{\$lang['create_penalty_no']}</option>
								<option value=1>{\$lang['create_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_auto_manual_issue']}:</td>
						<td class="tbody">
							<select name="penalty_manual_issue">
								<option selected value=0>{\$lang['create_penalty_no']}</option>
								<option value=1>{\$lang['create_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_auto_points']}:</td>
						<td class="tbody"><input name="penalty_points" value=0 type="text" /></td>
					</tr>
					{!admin_create_penalty_auto_rows}
				</table>
				<!-- Global Cascade -->
				<table class="area" style="width: 100%;border-radius:0px;">
					<tr>
						<td class="thead" colspan=2>{\$lang['create_penalty_global_cascade_head']}</td>
					</tr>
					<tr>
						<td class="tbody">
							{\$lang['create_penalty_global_cascade_local_scope']}:<br />
							<small>({\$lang['create_penalty_global_cascade_local_scope_desc']})</small>
						</td>
						<td class="tbody">
							<select name="penalty_local_scope">
								<option selected value=0>{\$lang['create_penalty_no']}</option>
								<option value=1>{\$lang['create_penalty_yes']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">
							{\$lang['create_penalty_global_cascade_mods_required']}:<br />
							<small>({\$lang['create_penalty_global_cascade_mods_required_desc']})</small>
						</td>
						<td class="tbody"><input name="penalty_mods_required" value=0 type="text" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_penalty_global_cascade_area_max']}:</td>
						<td class="tbody"><input name="penalty_area_max" value=1 type="text" /></td>
					</tr>
					<tr>
						<td class="tbody" colspan=2 style="text-align: center;">
							<button name="submit_penalty" type="submit">{\$lang['create_penalty_submit']}</button>
						</td>
					</tr>
					{!admin_create_penalty_cascade_rows}
				</table>
			</div>
			<div id="tabs-local" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius:0px;">{\$localPerms}</table>
			</div>
			<div id="tabs-global" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius:0px;">{\$globalPerms}</table>
			</div>
			{!admin_create_penalty_tabs_body}
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'plugins',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>
		<tr><td class="thead">{\$lang['side_nav_head']}</td></tr>
		<tr>
			<td class="tbody side">
				<a href="./import_plugin.php">{\$lang['side_nav_import']}</a>
			</td>
		</tr>
		<tr><td class="tbody side"><img height=18 width=18 src="//{\$settings['site_url']}/images/settings.png" />{\$lang['side_nav_settings']}</td></tr>
		{!admin_plugins_nav}
	</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" colspan=4>{\$lang['plugins_head']}</td>
			{!admin_plugins_head}
		</tr>
		{\$rows}
	</table>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'plugins_row',
	"content" => <<<tem
<form action="./submit_plugin.php" method="post">
	<input name="session" value="{\$me['session']}" type="hidden" />
	<tr>
		<input name="uname" value="{\$uname}" type="hidden" />
		<td class="tbody">{\$title}{\$author}</td>
		<td class="tbody">{\$version}</td>
		<td class="tbody">{\$desc}</td>
		<td class="tbody">{\$options}</td>
		{!admin_plugins_row}
	</tr>
</form>
tem
));

$db->insert('admin_templates',array(
	"name" => 'plugins_author',
	"content" => "<br /><small>{\$lang['plugins_row_author']}: {\$author}</small>"
));

$db->insert('admin_templates',array(
	"name" => 'settings_list',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_settings_nav}</table>
</div>
<div class="content">{\$notice}{\$rows}</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'settings_block',
	"content" => <<<tem
<div class="block">
	<table class="area">
		<tr><td class="thead"><a href="./edit_setting.php?name={\$sid}">{\$sname}</a></td></tr>
		<td class="tbody">{\$sdesc}</td>
	</table>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'edit_setting',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_settings_edit_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_setting" action="./edit_setting.php?name={\$name}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div style="float: left;width: 75%;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan="2">{\$lang['edit_setting_head']}</td></tr>
				<tr>
					<td class="tbody">{\$lang['edit_setting_name']}:</td>
					<td class="tbody">{\$fname}</td>
				</tr>
				{\$rows}{!admin_settings_edit_left}
			</table>
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead">{\$lang['edit_setting_options_head']}</td></tr>
				<tr><td class="tbody">{\$desc}</td></tr>
				{!admin_settings_edit_options}
				<tr><td class="tbody">
					<button type="submit" name="submit_setting" value=1>{\$lang['edit_setting_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => "edit_setting_row",
	"content" => <<<tem
<tr>
	<td class="tbody">{\$sname}</td>
	<td class="tbody">{\$scontent}</td>
</tr>
tem
));

$db->insert('admin_templates', array(
	"name" => 'edit_form',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_edit_forms_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_form" action="./edit_form.php?fid={\$fid}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div style="float: left;width: 100%;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan="2">{\$lang['edit_form_head']}</td></tr>
				<tr>
					<td class="tbody">{\$lang['edit_setting_name']}:</td>
					<td class="tbody">{\$fname}</td>
				</tr>
				{\$rows}{!admin_edit_forms_left}
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forums',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./forums.php?action=massupdate" method="post">
		<input type="hidden" name="orderlist" id="orderlist" />
		<table id="forumList" class="area" style="width: 100%;">
			<tr>
				<td class="thead" style="border-top-right-radius: 0px;" colspan=4>{\$lang['forums_head']}</td>
				{!admin_forums_head}
				<td class="thead" style="border-top-left-radius: 0px;width: 10px;">
					<input class="selectItem" id="selectAll" name="selectAll" type="checkbox" value=3 />
				</td>
			</tr>
			{\$rows}
		</table>
		<div style="float: right;margin-top: 5px;">
			<select id="option" name="option">
				<option id="opt_0" value=0>{\$lang['forums_readonly']}</option>
				<option id="opt_1" value=1>{\$lang['forums_activate']}</option>
				<option id="opt_2" value=2>{\$lang['forums_deactivate']}</option>
				<option id="opt_3" value=3>{\$lang['forums_delete']}</option>
				<option id="opt_4" value=4 selected>{\$lang['forums_update']}</option>
				{!admin_forums_options}
			</select>
			<button type="submit" name="submit">{\$lang['forums_submit']}</button>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forums_category_row',
	"content" => <<<tem
<tr id="cat_{\$cid}">
	<td class="tbody" colspan=3><a href="./edit_cat.php?cid={\$cid}">{\$name}</a></td>
	{!admin_forums_category_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_cat.php?cid={\$cid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
	<td class="tbody" style="width:10px;"><input class="selectItem" name="item[]" type="checkbox" value=1 /></td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forums_forum_row',
	"content" => <<<tem
<tr id="forum_{\$fid}">
	<td class="tcat" style="width: 40px;">&nbsp;</td>
	<td class="tbody"><a href="./edit_forum.php?fid={\$fid}">{\$name}</a></td>
	<td class="tbody">{\$lang['forums_moderators']}</td>
	{!admin_forums_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_forum.php?fid={\$fid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
	<td class="tbody" style="width:10px;"><input class="selectItem" name="item[]" type="checkbox" value=1 /></td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_forum',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form id="createForumForm" name="create_forum" action="./create_forum.php" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['create_forum_tabs_general']}</a></li>
				{if(\$can_edit_permissions)}<li><a href="#tabs-perms">{\$lang['create_forum_tabs_permissions']}</a></li>{/if}
				{!admin_forums_create_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_forum_parent']}</td>
						<td class="tbody"><select name="parent">{\$cats}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['create_forum_name_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['create_forum_desc_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_active']}?</td>
						<td class="tbody">
							<select name="active">
								<option selected value=1>{\$lang['create_forum_yes']}</option>
								<option value=0>{\$lang['create_forum_no']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_topic_mod']}:</td>
						<td class="tbody">
							<select name="topic_mod">
								<option value=1>{\$lang['create_forum_yes']}</option>
								<option selected value=0>{\$lang['create_forum_no']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_post_mod']}:</td>
						<td class="tbody">
							<select name="post_mod">
								<option value=1>{\$lang['create_forum_yes']}</option>
								<option selected value=0>{\$lang['create_forum_no']}</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_order']}:</td>
						<td class="tbody"><input name="order" value=0 type="number" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_autoexpand']}:</td>
						<td class="tbody"><select name="autoexpand">
								<option value=1>{\$lang['create_forum_yes']}</option>
								<option selected value=0>{\$lang['create_forum_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_stat_counter']}:</td>
						<td class="tbody"><select name="stat_counter">
							<option value=1>{\$lang['create_forum_yes']}</option>
							<option selected value=0>{\$lang['create_forum_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_layout']}:</td>
						<td class="tbody"><select name="layout">
							<option value="0" selected>{\$lang['create_forum_layout_default']}</option>
							<option value="newsfeed">{\$lang['create_forum_layout_newsfeed']}</option>
							{!admin_forums_create_layout_selector}
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_hidden_forum']}:</td>
						<td class="tbody"><select name="hidden_forum">
							<option value=1>{\$lang['create_forum_yes']}</option>
							<option selected value=0>{\$lang['create_forum_no']}</option>
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_forum_tag']}:</td>
						<td class="tbody"><input name="tag" type="text" /></td>
					</tr>
					{!admin_forums_create_general}
				</table>
			</div>
			{if(\$can_edit_permissions)}<div id="tabs-perms" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_forum_presets']}:</td>
						<td class="tbody"><select name="presets">{\$presets}<option value=0>{\$lang['create_forum_preset_custom']}</option></select></td>
					</tr>
				</table>
				<table class="area" style="display: none;width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_forum_permissions_groups_head']}</td>
					</tr>
					{\$fgroups}
				</table>
			</div>{/if}
			{!admin_forums_create_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['create_forum_options_head']}</td></tr>
				{!admin_forums_create_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_forum" value=1>{\$lang['create_forum_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
	<!--{if(\$can_edit_permissions)}{\$permModal}{/if}-->
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forum_permissions_group_row',
	"content" => <<<tem
<tr id="perm_group_{\$fgid}" class="perm_group_row">
	<td class="tbody" style="font-family: Arial;">
		{\$fgname} <small style="font-size: 10px;"><a href="./edit_group.php?gid={\$fgid}">[{\$lang['edit_forum_permissions_groups_row_goto']}]</a></small>
	</td>
	<td class="tbody perm_group_tier">
		<a class="group_tier_link" href='#group-{\$fgid}' style="color: #{\$fglevel_color};">{\$fgalevel}</a>
		<select name="group_tier[{\$fgid}]" style="display: none;">
			<option {if(equals(\$fgsel,default))}selected {/if}value='default'>{\$lang['edit_forum_permissions_groups_levels_default']}</option>
			<option {if(equals(\$fgsel,all_perms))}selected {/if}value='all_perms'>{\$lang['edit_forum_permissions_groups_levels_all_perms']}</option>
			<option {if(equals(\$fgsel,can_moderate))}selected {/if}value='can_moderate'>{\$lang['edit_forum_permissions_groups_levels_can_moderate']}</option>
			<option {if(equals(\$fgsel,can_post))}selected {/if}value='can_post'>{\$lang['edit_forum_permissions_groups_levels_can_post']}</option>
			<option {if(equals(\$fgsel,can_view))}selected {/if}value='can_view'>{\$lang['edit_forum_permissions_groups_levels_can_view']}</option>
			<option {if(equals(\$fgsel,no_access))}selected {/if}value='no_access'>{\$lang['edit_forum_permissions_groups_levels_no_access']}</option>
			<option {if(equals(\$fgsel,custom))}selected {/if}value='custom'>{\$lang['edit_forum_permissions_groups_levels_custom']}</option>
		</select> {\$fginherit}
	</td>
	<td class="tbody perm_group_options" style="width: 32px;overflow: none;">
		<input class="perm_group_checkbox" name="fgselect[{\$fgid}]" type="checkbox" value=1 />
		<img src="//{\$settings['site_url']}/images/loader.gif" height="32" width="32" style="display: none;" />
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forum_permissions_modal',
	"content" => <<<tem
<div class="modal" id="permModalContent" style="display: none;">
	<form id="permModalForm" action="#" method="post">
		<input id="permModalGroup" name="group" value=0 type="hidden" />
		<input name="preset" value=0 type="hidden" />
		<ul class="abb_tabs">
			<li><a href="#modal-tab-basic">{\$lang['forum_permissions_modal_basic']}</a></li>
			<li><a href="#modal-tab-mod">{\$lang['forum_permissions_modal_mod']}</a></li>
			<li><a href="#modal-tab-manager">{\$lang['forum_permissions_modal_manager']}</a></li>
		</ul>
		<div class="tab_content" id="modal-tab-basic">
			<table>{\$modal_tab_basic}<tr><td class="tbody" colspan=2 style="text-align: center;"><button type="submit">{\$lang['forum_permissions_modal_submit']}</button></td></tr></table>
		</div>
		<div class="tab_content" id="modal-tab-mod">
			<table>{\$modal_tab_mod}<tr><td class="tbody" colspan=2 style="text-align: center;"><button type="submit">{\$lang['forum_permissions_modal_submit']}</button></td></tr></table>
		</div>
		<div class="tab_content" id="modal-tab-manager">
			<table>{\$modal_tab_manager}<tr><td class="tbody" colspan=2 style="text-align: center;"><button type="submit">{\$lang['forum_permissions_modal_submit']}</button></td></tr></table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_forum',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<!--<form id="bulkGroupUpdateForm" action="./edit_forum.php?action=bulk-group-update&amp;fid={\$fid}" method="post"></form>-->
	<!-- This one is for the JS to figure out what forum this is.. without resorting to Regexes or other nonsense.. -->
	<input id="fid" type="hidden" value="{\$fid}" />
	
	<form id="forum_form" name="edit_forum" action="./edit_forum.php?fid={\$fid}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['edit_forum_tabs_general']}</a></li>
				<li><a href="#tabs-mods">{\$lang['edit_forum_tabs_moderators']}</a></li>
				{if(\$has_subforums)}<li><a href="#tabs-subforums">{\$lang['edit_forum_tabs_subforums']}</a></li>{/if}
				{if(\$can_edit_permissions)}<li><a href="#tabs-perms">{\$lang['edit_forum_tabs_permissions']}</a></li>{/if}
				{!admin_forums_edit_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_forum_parent']}</td>
						<td class="tbody"><select name="parent">{\$cats}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['edit_forum_name_placeholder']}" value="{\$name}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['edit_forum_desc_placeholder']}" value="{\$desc}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_active']}?</td>
						<td class="tbody"><select name="active">{\$active}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_topic_mod']}:</td>
						<td class="tbody"><select name="topic_mod">{\$topic_mod}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_post_mod']}:</td>
						<td class="tbody"><select name="post_mod">{\$post_mod}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_order']}:</td>
						<td class="tbody"><input name="order" type="number" value="{\$order}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_autoexpand']}:</td>
						<td class="tbody"><select name="autoexpand">{\$autoexpand}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_stat_counter']}:</td>
						<td class="tbody"><select name="stat_counter">{\$stat_counter}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_layout']}:</td>
						<td class="tbody"><select name="layout">
							<option value="0" {\$defaultLayout}>{\$lang['edit_forum_layout_default']}</option>
							<option value="newsfeed" {\$newsfeedLayout}>{\$lang['edit_forum_layout_newsfeed']}</option>
							{!admin_forums_edit_layout_selector}
						</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_hidden_forum']}:</td>
						<td class="tbody"><select name="hidden_forum">{\$hidden_forum}</select></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_tag']}:</td>
						<td class="tbody"><input name="tag" type="text" value="{\$tag}" /></td>
					</tr>
					{!admin_forums_edit_general}
				</table>
			</div>
			<div id="tabs-mods" style="padding: 0px;">
				<table table class="area" style="width: 100%;border-radius: 0px;">{\$modlist}</table>
				<table class="area" style="width: 100%;margin-top: 10px;">
					<tr><td class="thead" colspan=2>{\$lang['edit_forum_mods_add_head']}</td></tr>
					<tr>
						<td class="tbody">{\$lang['edit_forum_mods_add_username']}</td>
						<td class="tbody"><input name="username" placeholder="John Doe" type="text" /></td>
					</tr>
					{\$permlist}
					<tr><td class="tbody" colspan=2>
						<button name="add_moderator" type="submit">{\$lang['edit_forum_mods_add_submit']}</button>
					</td></tr>
				</table>
			</div>
			{if(\$has_subforums)}
				<div id="tabs-subforums" style="padding: 0px;">
					<table table class="area" style="width: 100%;border-radius: 0px;">{\$subforums}</table>
				</div>
			{/if}
			{if(\$can_edit_permissions)}
			<div id="tabs-perms" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_forum_presets']}:</td>
						<td class="tbody"><select id="perms_presets" name="presets">{\$presets}<option value=0>{\$lang['edit_forum_preset_custom']}</option></select></td>
					</tr>
				</table>
				<div id="permsGroupsBulkUpdator" style="float: right;margin-top: 5px;margin-bottom: 1px;">
					<button name="action" value="bulk-group-update" type="submit">{\$lang['edit_forum_permissions_groups_bulk_update']}</button>
				</div>
				<table class="area" id="forum-groups-table">
					<tr>
						<td class="thead" style="border-radius: 0px;">{\$lang['edit_forum_permissions_groups_head']}</td>
						<td class="thead" style="text-align: left;border-radius: 0px;">
							<select name="permGroupsSelectAllTier">
								<option value='all_perms'>{\$lang['edit_forum_permissions_groups_levels_all_perms']}</option>
								<option value='can_moderate'>{\$lang['edit_forum_permissions_groups_levels_can_moderate']}</option>
								<option value='can_post'>{\$lang['edit_forum_permissions_groups_levels_can_post']}</option>
								<option selected value='can_view'>{\$lang['edit_forum_permissions_groups_levels_can_view']}</option>
								<option value='no_access'>{\$lang['edit_forum_permissions_groups_levels_no_access']}</option>
							</select>
						</td>
						<td class="thead" style="text-align: left;border-radius: 0px;"><input id="permsGroupsSelectAll" type="checkbox" /></td>
					</tr>
					{\$fgroups}
				</table>
			</div>
			{/if}
			{!admin_forums_edit_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['edit_forum_options_head']}</td></tr>
				{!admin_forums_edit_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_forum" value=1>{\$lang['edit_forum_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
	{if(\$can_edit_permissions)}{\$permModal}<div id="overlay" style="display: none;"></div>{/if}
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'forum_permission',
	"content" => <<<tem
<tr>
	<td class="tbody"><span title="{\$pdesc}">{\$pname}</span>?</td>
	<td class="tbody"><select name="perm_{\$perm}">{\$poptions}</select></td>
	{!admin_forum_perm_row}
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_forum_mods_row',
	"content" => <<<tem
<tr><td class="tbody"><a href="./edit_user.php?uid={\$uid}">{\$username}</a></td></tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_forum_subforums_row',
	"content" => <<<tem
<tr><td class="tbody"><a href="./edit_forum.php?fid={\$sfid}">{\$subname}</a></td></tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_forum_mods_perm_row',
	"content" => <<<tem
<tr>
	<td class="tbody">{\$mperm}</td>
	<td class="tbody">
		<select name="{\$mperm_raw}">
			<option value=0 selected>{\$lang['edit_forum_no']}</option>
			<option value=1>{\$lang['edit_forum_yes']}</option>
		</select>
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'create_category',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="create_category" action="./create_cat.php" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['create_category_tabs_general']}</a></li>
				<li><a href="#tabs-perms">{\$lang['create_category_tabs_permissions']}</a></li>
				{!admin_categories_create_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['create_category_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['create_category_name_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_category_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['create_category_desc_placeholder']}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['create_category_order']}:</td>
						<td class="tbody"><input name="order" value=0 type="number" /></td>
					</tr>
					{!admin_categories_create_general}
				</table>
			</div>
			<div id="tabs-perms">Coming Soon!</div>
			{!admin_categories_create_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['create_category_options_head']}</td></tr>				
				{!admin_categories_create_options}
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_category" value=1>{\$lang['create_category_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_category',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_category" action="./edit_cat.php?cid={\$cid}" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div id="tabs" style="float: left;width: 75%;">
			<ul>
				<li><a href="#tabs-general">{\$lang['edit_category_tabs_general']}</a></li>
				<li><a href="#tabs-perms">{\$lang['edit_category_tabs_permissions']}</a></li>
				{!admin_categories_edit_tabs}
			</ul>
			<div id="tabs-general" style="padding: 0px;">
				<table class="area" style="width: 100%;border-radius: 0px;">
					<tr>
						<td class="tbody">{\$lang['edit_category_name']}:</td>
						<td class="tbody"><input name="name" type="text" placeholder="{\$lang['create_category_name_placeholder']}" value="{\$name}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_category_desc']}:</td>
						<td class="tbody"><input name="desc" type="text" placeholder="{\$lang['create_category_desc_placeholder']}" value="{\$desc}" /></td>
					</tr>
					<tr>
						<td class="tbody">{\$lang['edit_category_order']}:</td>
						<td class="tbody"><input name="order" value="{\$order}" type="number" /></td>
					</tr>
					{!admin_categories_edit_general}
				</table>
			</div>
			<div id="tabs-perms">Coming Soon!</div>
			{!admin_categories_edit_left}
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['edit_category_options_head']}</td></tr>				
				{!admin_categories_edit_options}
				<tr><td class="tbody" colspan=2><button type="submit" name="submit_category" value=1>{\$lang['edit_category_options_submit']}</button></td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'topics_prefixes',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<div style="float: left;width: 75%;">
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=2>{\$lang['topics_prefixes_head']}</td>
				{!admin_topics_prefixes_head}
			</tr>{\$rows}
		</table>
	</div>
	<form action="./topics_prefix.php?action=create" method="post">
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['topics_prefixes_create_head']}</td></tr>
				<tr>
					<td class="tbody">{\$lang['topics_prefixes_create_name']}</td>
					<td class="tbody"><input name="name" placeholder="{\$lang['topics_prefixes_create_name_placeholder']}" type="text" /></td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['topics_prefixes_create_markup']}</td>
					<td class="tbody"><input name="markup" type="text" /></td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['topics_prefixes_create_modonly']}</td>
					<td class="tbody">
						<select name="modonly">
							<option value=0>{\$lang['topics_prefixes_no']}</option>
							<option value=1>{\$lang['topics_prefixes_yes']}</option>
						</select>
					</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['topics_prefixes_create_groups']}</td>
					<td class="tbody"><select readonly name="groups[]" multiple>{\$groups}</select></td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['topics_prefixes_create_forums']}</td>
					<td class="tbody"><select readonly name="forums[]" multiple>{\$forums}</select></td>
				</tr>
				{!admin_topics_prefixes_create_rows}
				<tr><td class="tbody" colspan=2><button type="submit" name="submit_prefix" value=1>{\$lang['topics_prefixes_submit']}</button></td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'topics_prefixes_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_topic_prefix.php?tpid={\$tpid}">{\$name}</a></td>
	{!admin_topics_prefixes_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_topic_prefix.php?tpid={\$tpid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_topic_prefix',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_forums_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_topic_prefix" action="./edit_topic_prefix.php?tpid={\$tpid}&action=edit" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<table class="area" style="width: 95%;">
			<tr><td class="thead" colspan=2>{\$lang['edit_topic_prefix_head']}</td></tr>
			<tr>
				<td class="tbody">{\$lang['edit_topic_prefix_name']}:</td>
				<td class="tbody"><input name="name" type="text" placeholder="{\$lang['edit_topic_prefix_name_placeholder']}" value="{\$name}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_topic_prefix_markup']}:</td>
				<td class="tbody"><input name="markup" type="text" placeholder="{\$lang['edit_topic_prefix_markup_placeholder']}" value="{\$markup}" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_topic_prefix_modonly']}</td>
				<td class="tbody">
					<select name="modonly">
						<option value=0 {if(!\$modonly)}selected{/if}>{\$lang['edit_topic_prefix_no']}</option>
						<option value=1 {if(\$modonly)}selected{/if}>{\$lang['edit_topic_prefix_yes']}</option>
					</select>
				</td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_topic_prefix_groups']}</td>
				<td class="tbody"><select readonly name="groups[]" multiple>{\$groups}</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_topic_prefix_forums']}</td>
				<td class="tbody"><select readonly name="forums[]" multiple>{\$forums}</select></td>
			</tr>
			<tr><td class="tbody" colspan=2><input name="submit_prefix" value="{\$lang['edit_topic_prefix_submit']}" type="submit" /></td></tr>
			{!admin_topics_prefixes_edit_general}
		</table>
	</form>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'themes',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<div style="float: left;width: 75%;">
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=4>{\$lang['themes_list_head']}</td>
				{!admin_themes_list_head}
			</tr>{\$rows}
		</table>
	</div>
	<div style="float: left;width: 20%;margin-left: 10px;">
		<form enctype="multipart/form-data" action="./themes.php?action=upload" method="post">
			<input name="session" value="{\$me['session']}" type="hidden" />
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead" colspan=2>{\$lang['themes_upload_head']}</td>
					{!admin_themes_upload_head}
				</tr>
				<tr>
					<td class="tbody">{\$lang['themes_upload_file']}:</td>
					<td class="tbody"><input type="file" name="theme_file" /></td>
				</tr>
				<tr>
					<td class="tbody">&nbsp;</td>
					<td class="tbody"><button name="upload_theme" type="submit">{\$lang['themes_upload_submit']}</button></td>
				</tr>
			</table>
		</form><br />
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=2>{\$lang['themes_create_head']}</td>
				{!admin_themes_create_head}
			</tr>
			<tr>
				<td class="tbody">{\$lang['themes_create_parent']}:</td>
				<td class="tbody">
					<select name="parent_theme">
						<option value='-1' selected>{\$lang['themes_none']}</option>
					{\$create_list}
					</select>
				</td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['themes_create_name']}:</td>
				<td class="tbody"><input name="name" type="text" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['themes_create_fname']}:</td>
				<td class="tbody"><input name="fname" type="text" /></td>
			</tr>
			<tr>
				<td class="tbody">&nbsp;</td>
				<td class="tbody"><button name="create_theme" type="submit">{\$lang['themes_create_submit']}</button></td>
			</tr>
		</table>
	</div>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'themes_row',
	"content" => <<<tem
<tr>
	<td class="tbody" {if(\$default)}style="background-color: #FFF59A;"{/if}>{\$name}</td>
	<td class="tbody" {if(\$default)}style="background-color: #FFF59A;"{/if}>{\$lang['themes_author']}: {\$author}</td>
	<td class="tbody" {if(\$default)}style="background-color: #FFF59A;"{/if}>{\$version}</td>
	<td class="tbody" {if(\$default)}style="background-color: #FFF59A;"{/if}>
		{if(\$can_edit_themes)}<img src="//{\$settings['site_url']}/images/edit.png" alt="[{\$lang['themes_edit']}]" height=24 width=24 /> {/if}
		{if(\$can_set_default)}<a href="./themes.php?action=set-default&amp;tid={\$tid}&amp;session={\$me['session']}">
			<button name="set_as_default" type="submit">{\$lang['themes_set_default']}</button>
		</a> {/if}
		{if(\$core)}<button name="rollback">{\$lang['themes_rollback']}</button> {/if}
		{if(\$deletable)}<button name="delete">{\$lang['themes_delete']}</button>{/if}
	</td>
</tr>
tem
));

$db->insert('admin_templates', array(
	"name" => 'templates',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" colspan=3>{\$lang['templates_list_head']}<div style="float: right;"><a href="./create_template.php"><button>{\$lang['templates_create']}</button></a></div></td>
			{!admin_templates_list_head}
		</tr>{\$rows}
	</table>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'templates_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_template.php?name={\$tname}">{\$tname}</a></td>
	<td class="tbody"><span style="color: green;">{\$lang['templates_default']}</span></td>
	<td class="tbody">
		{if(\$can_edit_templates)}<a href="./edit_template.php?tid={\$tid}">
			<img src="//{\$settings['site_url']}/images/edit.png" alt="[{\$lang['templates_edit']}]" height=24 width=24 />
		</a> {/if}
		{if(\$deletable)}<button name="delete">{\$lang['templates_delete']}</button>{/if}
	</td>
</tr>
tem
));

$db->insert('admin_templates', array(
	"name" => 'edit_template',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./edit_template.php?name={\$tname}&action=update" method="post">
		<input id="tcontent" name="tcontent" type="hidden" />
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=2>{\$lang['edit_template_head']}</td>
				{!admin_edit_template_head}
			</tr>
			<tr>
				<td class="tbody">{\$lang['edit_template_name']}:</td>
				<td class="tbody">{\$tname}</td>
			</tr>
			<tr>
				<td class="tbody" colspan=2><div id="codeEditor" style="position: relative;top:0px;left:0px;width: 100%;height: 400px;">{\$tcontent}</div></td>
			</tr>
			<tr>
				<td class="tbody" colspan=2><input id="updateTemplate" type="submit" value="{\$lang['edit_template_submit']}" /></td>
			</tr>
		</table>
		<script src="../js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/ace/theme-dawn.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/ace/mode-html.js" type="text/javascript" charset="utf-8"></script>
		{!admin_get_template_js_late}
		<script>
		var editor = ace.edit("codeEditor");
		editor.setTheme("ace/theme/dawn");
		var mode = require("ace/mode/html").Mode;
		editor.getSession().setMode(new mode());
		
		var tcontent = $('#tcontent');
		$('#updateTemplate').click(function(){
			tcontent.val(editor.getSession().getValue());
		});
		</script>
		{!admin_get_template_js_late_post}
	</form>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'create_template',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./create_template.php?action=create" method="post">
		<input id="tcontent" name="tcontent" type="hidden" />
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=2>{\$lang['create_template_head']}</td>
				{!admin_create_template_head}
			</tr>
			<tr>
				<td class="tbody">{\$lang['create_template_name']}:</td>
				<td class="tbody"><input name="tname" type="text" /></td>
			</tr>
			<tr>
				<td class="tbody" colspan=2><div id="codeEditor" style="position: relative;top:0px;left:0px;width: 100%;height: 400px;"></div></td>
			</tr>
			<tr>
				<td class="tbody" colspan=2><input id="updateTemplate" type="submit" value="{\$lang['create_template_submit']}" /></td>
			</tr>
		</table>
		<script src="../js/ace/ace.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/ace/theme-dawn.js" type="text/javascript" charset="utf-8"></script>
		<script src="../js/ace/mode-html.js" type="text/javascript" charset="utf-8"></script>
		{!admin_create_template_js_late}
		<script>
		var editor = ace.edit("codeEditor");
		editor.setTheme("ace/theme/dawn");
		var mode = require("ace/mode/html").Mode;
		editor.getSession().setMode(new mode());
		
		var tcontent = $('#tcontent');
		$('#updateTemplate').click(function(){
			tcontent.val(editor.getSession().getValue());
		});
		</script>
		{!admin_create_template_js_late_post}
	</form>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'menus',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" colspan=2>{\$lang['menus_list_head']}
			<div style="float: right;"><a href="./menus.php?action=create"><button>{\$lang['menus_create']}</button></a></div></td>
			{!admin_menus_list_head}
		</tr>{\$rows}
	</table>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'menus_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./menus.php?mid={\$mid}">{\$tname}</a></td>
	<td class="tbody" style="width: 100px;">
		<a href="./menus.php?mid={\$mid}">
			<img src="//{\$settings['site_url']}/images/edit.png" alt="[{\$lang['menus_edit']}]" height=24 width=24 />
		</a>
		<img src="//{\$settings['site_url']}/images/delete.png" alt="[{\$lang['menus_delete']}]" height=24 width=24 />
	</td>
</tr>
tem
));

$db->insert('admin_templates', array(
	"name" => 'edit_menu_item',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_appearance_nav}</table>
</div>
<div class="content">{\$notice}
	<form action="./menus.php?{eif(\$mid)}mid={\$mid}&action=update{/eif}{else}action=create{/else}" method="post">
		<table class="area" style="width: 100%;">
			<tr>
				<td class="thead" colspan=2>{\$lang['menu_item_head']}
				{!admin_menus_item_edit_head}
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_name']}</td>
				<td class="tbody"><input name="name" value="{\$name}" type="text" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_url']}</td>
				<td class="tbody"><input name="url" value="{\$url}" type="text" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_order']}</td>
				<td class="tbody"><input name="order" value="{\$order}" type="number" /></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_enabled']}</td>
				<td class="tbody"><select name="enabled">
					<option value="1"{if(\$enabled)} selected{/if}>{\$lang['menus_enabled']}</option>
					<option value="0"{if(!\$enabled)} selected{/if}>{\$lang['menus_disabled']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_guest_only']}</td>
				<td class="tbody"><select name="guest_only">
					<option value="1"{if(\$guest_only)} selected{/if}>{\$lang['menus_yes']}</option>
					<option value="0"{if(!\$guest_only)} selected{/if}>{\$lang['menus_no']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_member_only']}</td>
				<td class="tbody"><select name="member_only">
					<option value="1"{if(\$member_only)} selected{/if}>{\$lang['menus_yes']}</option>
					<option value="0"{if(!\$member_only)} selected{/if}>{\$lang['menus_no']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_supermod_only']}</td>
				<td class="tbody"><select name="supermod_only">
					<option value="1"{if(\$supermod_only)} selected{/if}>{\$lang['menus_yes']}</option>
					<option value="0"{if(!\$supermod_only)} selected{/if}>{\$lang['menus_no']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_admin_only']}</td>
				<td class="tbody"><select name="admin_only">
					<option value="1"{if(\$admin_only)} selected{/if}>{\$lang['menus_yes']}</option>
					<option value="0"{if(!\$admin_only)} selected{/if}>{\$lang['menus_no']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody">{\$lang['menu_item_nojax']}</td>
				<td class="tbody"><select name="nojax">
					<option value="1"{if(\$nojax)} selected{/if}>{\$lang['menus_yes']}</option>
					<option value="0"{if(!\$nojax)} selected{/if}>{\$lang['menus_no']}</option>
				</select></td>
			</tr>
			<tr>
				<td class="tbody" colspan=2>
					<button name="menu_item_submitter" type="submit">{eif(\$mid)}{\$lang['menu_item_submit_update']}{/eif}{else}{\$lang['menu_item_submit_create']}{/else}</button>
				</td>
			</tr>
		</table>
	</form>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'system',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_system_nav}</table>
</div>
<div class="content">{\$notice}
	<div style="float: left;width: 100%">
		<div style="float: left;width:45%;padding-right:5px;">
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead" colspan=2>{\$lang['system_overview_head']}</td>
					{!admin_system_overview_head}
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_phpversion']}:</td>
					<td class="tbody">{\$phpversion}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_usage']}:</td>
					<td class="tbody">{\$cpu_usage}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_load']}:</td>
					<td class="tbody">{\$cpu_load}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_memory_used']}:</td>
					<td class="tbody">{\$memory_used}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_memory_allocated']}:</td>
					<td class="tbody">{\$memory_allocated}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_disk_free']}:</td>
					<td class="tbody">{\$disk_free}</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['system_overview_disk_used']}:</td>
					<td class="tbody">{\$disk_used}</td>
				</tr>
				{!admin_system_overview_body}
			</table>
		</div>
		<div style="float: left;width:50%;">
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead">{\$lang['system_alerts_head']}</td>
					{!admin_system_alerts_head}
				</tr>
				<tr>{\$cpu_alert}</tr>
				<tr>{\$memory_alert}</tr>
				<tr>{\$disk_alert}</tr>
				{\$ipv6_alert}
				{!admin_system_alerts_body}
			</table>
		</div>
	</div>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'cache',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_system_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" colspan=2>{\$lang['cache_head']}</td>
			{!admin_cache_head}
		</tr>
		{\$clist}{!admin_cache_body}
	</table>
</div>
tem
));

$db->insert('admin_templates', array(
	"name" => 'cache_row',
	"content" => <<<tem
<tr>
	<td class="tbody">{\$lname}</td>
	<td class="tbody">	
		<a href="./cache.php?action=rebuild&amp;cache={\$name}{\$attrs}">
			<button type="submit" name="rebuild_cache">{\$lang['cache_rebuild']}</button>
		</a>
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'pages',
	"content" => <<<tem
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_index_nav}</table>
</div>
<div class="content">{\$notice}
	<table class="area" style="width: 100%;">
		<tr>
			<td class="thead" style="border-top-right-radius: 0px;" colspan=2>
				{\$lang['pages_head']}<a href="./edit_page.php"><div style="float: right;"><button name="create_page">{\$lang['pages_buttons_create']}</button></div></a>
			</td>
			{!admin_pages_head}
		</tr>{\$rows}
	</table>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'pages_row',
	"content" => <<<tem
<tr>
	<td class="tbody"><a href="./edit_page.php?pid={\$ppid}">{\$ptitle}</a><br />
		<small>{\$lang['pages_author']}: {\$pdispname}</small>
	</td>
	{!admin_pages_row}
	<td class="tbody" style="width:100px;">
		<a href="./edit_page.php?pid={\$ppid}">
			<img height=24 width=24 src="//{\$settings['site_url']}/images/edit.png" />
		</a>
		<img height=24 width=24 src="//{\$settings['site_url']}/images/delete-24.png" />
	</td>
</tr>
tem
));

$db->insert('admin_templates',array(
	"name" => 'edit_page',
	"content" => <<<tem
<script>
$(document).ready(function(){
	$(".texteditor").sceditor({
		plugins: "bbcode",
		toolbarExclude: "table",
		emoticonsRoot: "../images/smilies/",
		emoticons:
		{
			dropdown:
			{
				":)": "smile-24.png",
				":D": "smile_big-24.png",
				":angel:": "angel-24.png",
				":cool:": "cool-24.png",
				":(": "sad-24.png",
				":'(": "crying-24.png",
				":O": "surprise-24.png",
				":P": "raspberry-24.png",
				";)": "wink-24.png"
			},
			more:
			{
				":$": "embarrassed-24.png",
				":monkey:": "monkey-24.png",
				":|": "plain-24.png",
				":devil:": "devilish-24.png"
			}
		},
		style: "../js/sceditor/themes/modern.min.css"
	});
});</script>
<div style="float: left;width: 150px;">
	<table>{\$sidebar}{!admin_index_nav}</table>
</div>
<div class="content">{\$notice}
	<form name="edit_page" action="./edit_page.php?pid={\$ppage['pid']}&action=execute" method="post">
		<input name="session" value="{\$me['session']}" type="hidden" />
		<div style="float: left;width: 70%;">
			<table class="area">
				<tr><td class="thead" colspan=2>{\$lang['edit_page_head']}:</td></tr>
				<tr>
					<td class="tbody">{\$lang['edit_page_path']}:</td>
					<td class="tbody">{\$settings['site_url']}/
						<input name="area" type="text" value="{\$ppage['area']}"/>
					</td>
				</tr>
				<tr>
					<td class="tbody">{\$lang['edit_page_title']}:</td>
					<td class="tbody"><input name="title" type="text" placeholder="{\$lang['edit_page_title_placeholder']}" value="{\$ppage['title']}"/></td>
				</tr>
				<tr>
					<td class="tbody" colspan=2><textarea class="texteditor" style="width: 100%;" name="content">{\$ppage['content']}</textarea></td>
				</tr>
				{!admin_pages_edit_general}
			</table>
		</div>
		<div style="float: left;width: 20%;margin-left: 10px;">
			<table class="area" style="width: 100%;">
				<tr><td class="thead" colspan=2>{\$lang['edit_page_options_head']}</td></tr>
				{!admin_pages_edit_options}
				<tr>
					<td class="tbody">{\$lang['edit_page_options_active']}</td>
					<td class="tbody"><select name="active">
						<option {if(\$active)}{/if} value=1>{\$lang['edit_page_yes']}</option>
						<option {if(!\$active)}{/if} value=0>{\$lang['edit_page_no']}</option>
					</select></td>
				</tr>
				<tr><td class="tbody" colspan=2>
					<button type="submit" name="submit_page" value=1>{\$lang['edit_page_options_submit']}</button>
				</td></tr>
			</table>
		</div>
	</form>
</div>
tem
));

$db->insert('admin_templates',array(
	"name" => 'error_nopermission',
	"content" => <<<tem
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>Access Denied - {\$settings['site_name']}</title>
		<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
		<link type="text/css" href="../css/admin.css" rel="stylesheet" />
	</head>
	<body>
		{include("header")}
		<div class="content">{\$notice}
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead">Access Denied</td>
				</tr>
				<tr><td class="tbody">You are not authorised to access this area of the administration interface.</td></tr>
			</table>
		</div>
		{include("footer")}
	</body>
</html>
tem
));

$db->insert('admin_templates',array(
	"name" => 'error_notexist',
	"content" => <<<tem
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>Page Not Found - {\$settings['site_name']}</title>
		<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
		<link type="text/css" href="../css/admin.css" rel="stylesheet" />
	</head>
	<body>
		{include("header")}
		<div class="content">{\$notice}
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead">Page Not Found</td>
				</tr>
				<tr><td class="tbody">The page which you're attempting to access doesn't exist.</td></tr>
			</table>
		</div>
		{include("footer")}
	</body>
</html>
tem
));

$db->insert('admin_templates',array(
	"name" => 'error_server',
	"content" => <<<tem
<!doctype html>
<html lang="en">
	<head>
		<meta http-equiv="Content-type" content="text/html;charset=UTF-8">
		<title>Server Error - {\$settings['site_name']}</title>
		<script type="text/javascript" src="./js/jquery-1.7.1.min.js"></script>
		<link type="text/css" href="../css/admin.css" rel="stylesheet" />
	</head>
	<body>
		{include("header")}
		<div class="content">{\$notice}
			<table class="area" style="width: 100%;">
				<tr>
					<td class="thead">Server Error</td>
				</tr>
				<tr><td class="tbody">There was a problem with the server.<br />Error Message: {\$errmsg}</td></tr>
			</table>
		</div>
		{include("footer")}
	</body>
</html>
tem
));