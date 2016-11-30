<?php
/*
	AtomBB Alerts System Functions
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function alerts_parse(array $item)
{
	global $lang, $plugins;
	switch($item['resourceType'])
	{
		case "topic": return alerts_parse_topic($item); break;
		case "post": return alerts_parse_post($item); break;
		case "comment": return alerts_parse_comment($item); break;
		
		default:
			if(($res = $plugins->hook('alerts_parse_type_default', $item))!==null) return $res;
			return false;
	}
}

function alerts_parse_topic(array $item)
{
	global $main, $lang, $plugins;
	
	switch($item['event'])
	{
		case "new_topic":
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['resourceID']}",
				"langstring" => $lang->sub('alerts_topic_new', $puser)
			);
		break;
		
		case "deleted_topic":
			global $db;
			$topic = $db->get("*","threads","tid='{$item['resourceID']}'",1);
			if(!$topic) $topic = array("thread_name" => "Deleted Topic");
			return array("target" => null,"langstring" => $lang->sub('alerts_topic_deleted', $topic['thread_name']));
		break;
		
		case "reply_topic":
			global $db;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$topic = $db->get("*","threads","tid='{$post['tid']}'",1);
			if(!$topic) return false;
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$topic['tid']}&amp;pid={$post['pid']}",
				"langstring" => $lang->multi_sub('alerts_topic_reply', array($puser, $topic['thread_name']))
			);
		break;
		
		default:
			if(($res = $plugins->hook('alerts_parse_topic_default', $item))!==null) return $res;
			return false;
	}
}

function alerts_parse_post(array $item)
{
	global $main, $lang, $plugins;
	switch($item['event'])
	{
		case "deleted_post":
			$topic = $db->get("*","threads","tid='{$item['areaID']}'",1);
			if(!$topic) $topic = array("thread_name" => "Deleted Topic");
			if($post['postedby']==$main->user['uid']) return array(
				"target" => null,
				"langstring" => $lang->sub('alerts_post_deleted_yours', $topic['thread_name'])
			);
			else return array(
				"target" => null,
				"langstring" => $lang->sub('alerts_post_deleted', $topic['thread_name'])
			);
		break;
		
		case "reply_post":
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$topic = $db->get("*","threads","tid='{$item['areaID']}'",1);
			if(!$topic) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			
			// Does the user have an avatar?
			$avatar = getAvatar($user);
			if($post['postedby']==$main->user['uid']) return array(
				"avatar" => $avatar,
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->multi_sub('alerts_post_reply_yours', array($puser, $topic['thread_name']))
			);
			else return array(
				"avatar" => $avatar,
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->multi_sub('alerts_post_reply', array($puser, $topic['thread_name']))
			);
		break;
		
		case "reply_topic":
			global $db;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$topic = $db->get("*","threads","tid='{$post['tid']}'",1);
			if(!$topic) return false;
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$topic['tid']}&amp;pid={$post['pid']}",
				"langstring" => $lang->multi_sub('alerts_topic_reply', array($puser, $topic['thread_name']))
			);
		break;
		
		case "upvote":
			global $db;
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$topic = $db->get("*","threads","tid='{$post['tid']}'",1);
			if(!$topic) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			if($post['postedby']==$main->user['uid']) return array(
					"avatar" => getAvatar($user),
					"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['areaID']}&amp;pid={$item['resourceID']}",
					"langstring" => $lang->multi_sub('alerts_post_upvote_yours', array($puser, $topic['thread_name']))
				);
			else 
			{
				$user2 = getUser($post['postedby'], true);
				$puser2 = "<![CDATA[".markup($user2['displayname'], $user2['style_start'], $user2['style_end'], $user2['is_multi_colour'])."]]>";
				return array(
					"avatar" => getAvatar($user),
					"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['areaID']}&amp;pid={$item['resourceID']}",
					"langstring" => $lang->multi_sub('alerts_post_upvote', array($puser, $puser2, $topic['thread_name']))
				);
			}
		break;
		
		case "post_mentioned":
			global $db;
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$topic = $db->get("*","threads","tid='{$post['tid']}'",1);
			if(!$topic) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/thread.php?tid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->multi_sub('alerts_post_mentioned', array($puser, $topic['thread_name']))
			);
		break;
		
		default:
			if(($res = $plugins->hook('alerts_parse_post_default', $item))!==null) return $res;
			return false;
	}
}

function alerts_parse_comment(array $item)
{
	global $lang, $db, $main, $plugins;
	switch($item['event'])
	{
		case "new_comment":
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			if($item['areaID']==$main->user['uid']) return array(
					"avatar" => getAvatar($user),
					"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
					"langstring" => $lang->sub('alerts_comment_new_yours', $puser)
				);
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->sub('alerts_comment_new', $puser)
			);
		break;
		
		case "deleted_comment":
			if(($res = $plugins->hook('alerts_parse_comment_deleted', $item))!==null) return $res;
			return false;
		break;
		
		case "reply_comment":
			global $db;
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			$user2 = getUser($post['postedby'], true);
			$puser2 = "<![CDATA[".markup($user2['displayname'], $user2['style_start'], $user2['style_end'], $user2['is_multi_colour'])."]]>";
			if($item['areaID']==$main->user['uid']) return array(
					"avatar" => getAvatar($user),
					"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
					"langstring" => $lang->multi_sub('alerts_comment_reply_yours', array($puser, $puser2))
				);

			$user3 = getUser($post['areaID'], true);
			$puser3 = "<![CDATA[".markup($user3['displayname'], $user3['style_start'], $user3['style_end'], $user3['is_multi_colour'])."]]>";
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->multi_sub('alerts_comment_reply', array($puser, $puser2, $puser3))
			);

		break;
		
		case "upvote":
			global $db;
			$post = $db->get("*","posts","pid='{$item['resourceID']}'",1);
			if(!$post) return false;
			$user = getUser($item['actor'], true);
			$puser = "<![CDATA[".markup($user['displayname'], $user['style_start'], $user['style_end'], $user['is_multi_colour'])."]]>";
			$user2 = getUser($post['postedby'], true);
			$puser2 = "<![CDATA[".markup($user2['displayname'], $user2['style_start'], $user2['style_end'], $user2['is_multi_colour'])."]]>";
			if($item['areaID']==$main->user['uid']) return array(
					"avatar" => getAvatar($user),
					"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
					"langstring" => $lang->multi_sub('alerts_comment_upvote_yours', array($puser, $puser2))
				);

			$user3 = getUser($post['areaID'], true);
			$puser3 = "<![CDATA[".markup($user3['displayname'], $user3['style_start'], $user3['style_end'], $user3['is_multi_colour'])."]]>";
			return array(
				"avatar" => getAvatar($user),
				"target" => "//{$main->settings['site_url']}/profiles/?uid={$item['areaID']}&amp;pid={$item['resourceID']}",
				"langstring" => $lang->multi_sub('alerts_comment_upvote', array($puser, $puser2, $puser3))
			);
		break;
		
		default:
			if(($res = $plugins->hook('alerts_parse_comment_default', $item))!==null) return $res;
			return false;
	}
}