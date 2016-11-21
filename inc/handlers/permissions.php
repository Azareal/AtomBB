<?php
/*
	AtomBB Permissions Handler
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class PermissionsHandler
{
	protected $children = array(
		"can_close_threads" => "can_close_own_threads",
		"can_edit_posts" => "can_edit_own_posts",
		"can_delete_replies" => array(
			"can_delete_own_replies",
			"can_see_deleted_posts"
		),
		"can_delete_threads" => array(
			"can_delete_own_threads",
			"can_see_deleted_threads"
		),
		"can_hide_threads" => "can_see_hidden_threads",
		"can_show_threads" => "can_see_hidden_threads",
		"can_hide_replies" => "can_see_hidden_posts",
		"can_show_replies" => "can_see_hidden_posts",
		"can_undelete_replies" => array(
			"can_undelete_own_replies",
			"can_see_deleted_posts"
		),
		"can_undelete_threads" => array(
			"can_undelete_own_threads",
			"can_see_deleted_threads"
		),
		"can_override_thread_locks" => array(
			"can_post_replies"
		)
	);
	
	// Local permissions?
	protected $localOnly = false;
	
	// Loaded or not?
	protected $loaded = false;
	
	// Currently loaded permissions..
	protected $perms = array();
	protected $rank = "user";
	protected $banned = 0;
	protected $rankList = array();
	
	// Set up the object..
	function __construct()
	{
		global $perms;
		$this->rankList = $perms->getRankList();
	}
	
	/**
	*
	*	This method is for getting the list of the local moderator permissions available to profile owners.
	*	Returns: An array.
	*
	**/
	function getProfilePerms()
	{
		$perms = array();
		$perms[] = "can_forum_ban_users";
		$perms[] = "can_edit_posts";
		//$perms[] = "can_hide_replies";
		$perms[] = "can_show_replies";
		$perms[] = "can_view_edits";
		return $perms;
	}
	
	function getForumManagerPerms()
	{
		$perms = array();
		$perms[] = "can_announce_threads";
		$perms[] = "can_denounce_threads";
		$perms[] = 'can_override_thread_locks';
		$perms[] = 'can_forum_ban_users';
		$perms[] = 'can_manual_issue_penalties';
		
		$perms[] = "can_protect_replies";
		$perms[] = "can_protect_threads";
		$perms[] = "can_unprotect_replies";
		$perms[] = "can_unprotect_threads";
		
		$perms[] = "can_manage_edits";
		$perms[] = "can_delete_edits";
		$perms[] = "can_restore_edits";
		$perms[] = "can_undo_edits";
		
		return $perms;
	}
	
	/**
	*	
	*	This method is for getting the list of the local moderator permissions.
	*	Returns: An array.
	*
	**/
	function getModPerms()
	{
		global $plugins;
		
		$perms = array();
		$perms[] = "can_edit_posts";
		$perms[] = "can_close_threads";
		$perms[] = "can_open_threads";
		$perms[] = "can_stick_threads";
		$perms[] = "can_unstick_threads";
		$perms[] = "can_warn";
		$perms[] = "can_edit_posts";
		
		$perms[] = "can_move_threads";
		$perms[] = "can_split_threads";
		$perms[] = "can_merge_posts";
		
		//$perms[] = "can_hide_replies";
		$perms[] = "can_show_replies";
		$perms[] = "can_hide_threads";
		$perms[] = "can_show_threads";
		
		$perms[] = "can_see_deleted_posts";
		$perms[] = "can_see_deleted_threads";
		$perms[] = "can_delete_replies";
		$perms[] = "can_delete_threads";
		$perms[] = "can_undelete_replies";
		$perms[] = "can_undelete_threads";
		$perms[] = "can_undelete_own_replies";
		$perms[] = "can_undelete_own_threads";
		
		$perms[] = "can_manage_edits";
		$perms[] = "can_delete_edits";
		$perms[] = "can_restore_edits";
		$perms[] = "can_undo_edits";
		
		$perms[] = "can_announce_threads";
		$perms[] = "can_denounce_threads";
		$perms[] = "can_override_thread_locks";
		$perms[] = "can_forum_ban_users";
		$perms[] = "can_manual_issue_penalties";
		
		if(($res = $plugins->hook('permissions_handler_get_mod_perms_end', $perms))!==null) $perms = $res;
		return $perms;
	}
	
	function getForumPerms($tier = null)
	{
		global $plugins;
		
		$perms = array();
		if($tier==null || $tier=='basic')
		{
			$perms[] = "can_view_forums";
			$perms[] = "can_view_threads";
			$perms[] = "can_view_own_threads";
			$perms[] = "can_view_edits";
			
			$perms[] = "can_post_threads";
			$perms[] = "can_post_replies";
			$perms[] = "can_edit_own_posts";
			$perms[] = "can_close_own_threads";
			
			$perms[] = "can_delete_own_replies";
			$perms[] = "can_delete_own_threads";
			$perms[] = "can_see_hidden_posts";
			$perms[] = "can_see_hidden_threads";
		}
		
		if($tier==null || $tier=='mod')
		{
			$perms[] = "can_edit_posts";
			$perms[] = "can_close_threads";
			$perms[] = "can_open_threads";
			$perms[] = "can_stick_threads";
			$perms[] = "can_unstick_threads";
			$perms[] = "can_warn";
			$perms[] = "can_edit_posts";
			
			$perms[] = "can_move_threads";
			
			//$perms[] = "can_hide_replies";
			$perms[] = "can_show_replies";
			$perms[] = "can_hide_threads";
			$perms[] = "can_show_threads";
			
			$perms[] = "can_see_deleted_posts";
			$perms[] = "can_see_deleted_threads";
			$perms[] = "can_delete_replies";
			$perms[] = "can_delete_threads";
			$perms[] = "can_undelete_replies";
			$perms[] = "can_undelete_threads";
			$perms[] = "can_undelete_own_replies";
			$perms[] = "can_undelete_own_threads";
		}
		
		if($tier==null  || $tier=='manager')
		{
			$perms[] = "can_protect_replies";
			$perms[] = "can_protect_threads";
			$perms[] = "can_unprotect_replies";
			$perms[] = "can_unprotect_threads";
			
			$perms[] = "can_manage_edits";
			$perms[] = "can_delete_edits";
			$perms[] = "can_restore_edits";
			$perms[] = "can_undo_edits";
			
			$perms[] = "can_announce_threads";
			$perms[] = "can_denounce_threads";
			$perms[] = "can_override_thread_locks";
			$perms[] = "can_forum_ban_users";
			$perms[] = "can_manual_issue_penalties";
		}
		if(($res = $plugins->hook('permissions_handler_get_forum_perms_end', $perms))!==null) $perms = $res;
		return $perms;
	}
	
	/**
	*	This method is for automatically setting child permissions,
	*	if their parent ones are already set.
	*	
	*	$perms - An array of permissions.
	**/
	function children($perms)
	{
		$plist = $perms;
		foreach($perms as $perm => $pValue)
		{
			if(isset($this->children[$perm]) && $pValue==1)
			{
				if(is_array($this->children[$perm]))
				{
					$children = $this->children[$perm];
					foreach($children as $child) $plist[$child] = 1;
				} else $plist[$this->children[$perm]] = 1;
			}
		}
		return $plist;
	}
	
	function addChild($parent, $children)
	{
		if(!is_array($children)) $children = array($children);
		
		if(isset($this->children[$parent]))
		{
			if(is_array($this->children[$parent])) $this->children[$parent] = array_merge($this->children[$parent],$children);
			else $this->children[$parent] = array_merge(array($this->children[$parent],$children));
		} else $this->children[$parent] = $children;
	}
	
	function getChildren() { return $this->children; }
	
	function getChild($parent)
	{
		if(!isset($this->children[$parent])) return false;
		return $this->children[$parent];
	}
	
	function load($uid)
	{
		global $db;
		
		// User data..
		$user = $db->join('*','users','permissions','uid','uid',"users.uid='{$uid}'",1);
		if($user==0) return false;
		
		// Group data..
		$group = $db->get('*','usergroups',"gid='{$user['gid']}'",1);
		if($group==0) return false;
		
		// Cache it
		global $cache;
		$cache->addUser(array_merge($user,$group));
		
		// Per user or per group?
		if(isset($user['content'])) $perms = unserialize($user['content']);
		else $perms = unserialize($group['permissions']);
		
		// Set the auth level
		$this->level = $group['level'];
		
		// Grab the rank list..
		$list = $this->rankList;
		
		// These should never be set in the group table
		unset($list['user'], $list['super_admin'], $list['founder']);
		
		// Recurse group perms to user perms..
		foreach($list as $k => $r) $perms["is_{$k}"] = $group["is_{$k}"];
		
		// Get the founder..
		global $main;
		$founder = $main->getConfig("founder");
		
		// Set the ranks..
		if($user['uid']==$founder || (!is_numeric($founder)
			&& $user['username']==$founder && $founder!="")) 
				$this->rank = 'founder';
		elseif($user['is_super_admin']) $this->rank = 'super_admin';
		elseif($perms['is_admin']) $this->rank = 'admin';
		elseif($perms['is_super_mod']) $this->rank = 'super_mod';
		else $this->banned = $group['is_banned_group'];
		
		$this->perms = &$perms;
	}
	
	function passByGroup($group)
	{
		$perms = unserialize($group['permissions']);
		
		// Set the level
		$this->level = $group['level'];
		
		// Grab the rank list
		$list = $this->rankList;
		
		// These should never be set in the group table
		unset($list['user'], $list['super_admin'], $list['founder']);
		
		// Recurse group perms to user perms
		foreach($list as $k => $r) $perms["is_{$k}"] = $group["is_{$k}"];
		
		// Get the founder
		global $main;
		$founder = $main->getConfig("founder");
		
		// Set the ranks..
		if($perms['is_admin']) $this->rank = 'admin';
		elseif($perms['is_super_mod']) $this->rank = 'super_mod';
		else $this->banned = $group['is_banned_group'];
		
		$this->perms = &$perms;
	}
	
	function localise() { $localOnly = true; }
	
	function set($name, $value)
	{
		if(!$loaded) return false;
		global $db;
		
		$this->perms[$name] = $value;
		
		// TO-DO: Coming soon..
	}
	
	function getLevel()
	{
		return $this->level;
	}
	
	function getRank()
	{
		return $this->rank;
	}
	
	/**
	*
	*	$rank - The rank which you wish to check against.
	*	$level - The level which you wish to check against.
	*
	**/
	function is($rank, $level = 0)
	{
		if($this->rankList[$this->rank]>$this->rankList[$rank])
			return true;
		elseif($this->rankList[$this->rank]==$this->rankList[$rank])
			if($this->level>=$level) return true;
		return false;
	}
	
	/**
	*
	*	$rank - The rank which you wish to check against.
	*	$level - The level which you wish to check against.
	*
	**/
	function over($rank, $level = 0)
	{
		if($this->rankList[$this->rank]>$this->rankList[$rank])
			return true;
		elseif($this->rankList[$this->rank]==$this->rankList[$rank])
			if($this->level>$level) return true;
		return false;
	}
	
	/**
	*
	*	This method is for checking an individual permission.
	*	$perm - The permission which you wish to check.
	*
	**/
	function check($perm)
	{
		// Super override..
		if($this->rankList[$this->rank]>=$this->rankList["super_admin"])
			return true;
		
		if(!isset($this->perms[$perm]) || $this->perms[$perm]==0) return false;
		return true;
	}
	
	function dump()
	{
		$perms = $this->perms;
		unset($perms['is_admin'], $perms['is_super_mod'], $perms['is_super_admin']);
		return $perms;
	}
}