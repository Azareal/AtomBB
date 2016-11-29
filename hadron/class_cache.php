<?php
/**
*
*	Hadron Framework: Cache Class
*	Created by Azareal.
*	Licensed under the terms of the GPLv3.
*	Copyright Azareal (c) 2013 - 2017.
*
**/

// Hadron Framework namespace..
namespace Hadron;

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

class Cache
{
	protected $main = null;
	
	// Users..
	protected $users = [];
	protected $gids = [];
	
	// Global data..
	public $data = [];
	protected $original = [];
	
	// Other caches..
	public $other = [];
	protected $oOriginal = [];
	
	// Speed up finding data in the caches..
	protected $indexes = [];
	
	// Memcached..
	protected $mcache = null;
	
	/**
	*
	*	$user - The user data for the current user.
	*
	**/
	function __construct(Container $main, array $config)
	{
		$this->main = $main;
		$this->other['groups'] = [];
		$db = $main->getDatabase();
		
		if(isset($config['memcached']) && $mem = $config['memcached'])
		{
			$this->mcache = new Memcached();
			foreach($mem as $item) $this->mcache->addServer($item['host'], $item['port']);
		}
		
		// Grab the cached data..
		$cache = $db->get('*','cache',"name='global'",1);
		if($cache!=0)
		{
			$this->original = $cache['content'];
			$this->data = unserialize($cache['content']);
		}
	}
	
	function init(array $user, array $group = [])
	{
		$this->users[$user['uid']] = $user;
		$this->gids[$user['gid']] = [$user['uid']];
		
		$this->indexes['usernames'] = [];
		$this->indexes['usernames'][$user['username']] = $user['uid'];
		
		if($this->mcache)
		{
			$this->mcache->set('user_'.$user['uid'], $user);
			$this->mcache->set('group_'.$user['gid'], $group);
			$this->mcache->set('usernames', [$user['username'] => $user['uid']]);
		}
	}
	
	/**
	*
	*	$name - Name of the cache which you wish to load.
	*
	**/
	function load($name)
	{
		// Grab the cached data..
		$cache = $this->main->getDatabase()->get('*','cache',"name='{$name}'",1);
		if($cache!=0)
		{
			$this->oOriginal = $cache['content'];
			$this->other = unserialize($cache['content']);
			return true;
		}
		return false;
	}
	
	function commit()
	{
		$db = $this->main->getDatabase();
		$cache = serialize($this->data);
		if($cache!=$this->original) $db->update("cache","content='{$cache}'","name='global'");
		//elseif($this->other!=$this->oOriginal)
		//	$db->update("cache","content='".serialize($this->other)."'","name='{$this->other['name']}'");
	}
	
	/**
	*
	*	Automatically update the cache data on the database upon
	*	object destruction.
	*
	**/
	/*function __destruct()
	{
		$db = $this->main->getDatabase();
		$cache = serialize($this->data);
		if($cache!=$this->original)
			$db->update("cache","content='{$cache}'","name='global'");
		elseif($this->other!=$this->oOriginal)
			$db->update("cache","content='".serialize($this->other)."'","name='{$this->other['name']}'");
	}*/
	
	/**
	*
	*	An array holding the user data.
	*
	**/
	function addUser(array $user, array $group = null)
	{
		if($group!=null) $this->other['groups'][$group['gid']] = $group;
		$this->users[$user['uid']] = $user;
		$this->gids[$user['gid']][] = $user['uid'];
		
		if($this->mcache)
		{
			$this->mcache->set('user_'.$user['uid'], $user);
			if(!$unames = $this->mcache->get('usernames')) $unames = [];
			$unames[$user['username']] = $user['uid'];
			$this->mcache->set('usernames', $unames);
			if($group!=null) $this->mcache->add('group_'.$user['gid'], $group);
		}
	}
	
	function addUsers(array $users, $shutdown = false)
	{
		if(isset($users['uid'])) $users = [$users];
		
		foreach($users as $user)
		{
			list($udata, $gdata) = $this->splitUserDataByGroup($user);
			if(!$shutdown) register_shutdown_function([$this,'addUser'], $udata, $gdata);
			else addUser($udata, $gdata);
		}
	}
	
	function setUserField($uid, $field, $data)
	{
		if(isset($this->users[$uid])) $this->users[$uid][$field] = $data;
		
		// Let the memcached cache regenerate naturally.
		if($this->mcache) $this->mcache->delete('user_'.$user['uid']);
	}
	
	function getUserField($uid, $field, $data)
	{
		return $this->users[$uid][$field] = $data;
	}
	
	function splitUserDataByGroup(array $data)
	{
		$user = array_diff_key($data, $this->main->settings['groupSchema']);
		$group = array_intersect_key($data, $this->main->settings['groupSchema']);
		return [$user,$group];
	}
	
	/**
	*
	*	An integer corresponding with the user's internal identifier number.
	*
	**/
	function getUser($uid, $group = false)
	{
		if(isset($this->users[$uid]) && $group) return array_merge($this->users[$uid],$this->other['groups']);
		elseif(isset($this->users[$uid])) return $this->users[$uid];
		
		if($this->mcache)
		{
			if(!$user = $this->mcache->get('user_'.$uid)) return false;
			if(!$group = $this->mcache->get('group_'.$uid)) $this->users[$user['uid']] = $user;
			else $this->users[$user['uid']] = array_merge($user, $group);
			
			$this->gids[$user['gid']][] = $user['uid'];
			
			$this->indexes['usernames'][$user['username']] = $user['uid'];
			return $this->users[$user['uid']];
		}
		return false;
	}
	
	function getUserByName($username)
	{
		if($this->mcache)
		{
			$unames = $this->mcache->get('usernames');
			if($unames) return false;
			
			$uid = $unames[$username];
		}
		else return false;
		return $this->getUser($uid);
	}
	
	function getUsersInBulk(array $ids, $group = false)
	{
		$result = [];
		$groups = [];
		
		// Anything in memory..?
		$source = array_intersect_key(array_flip($ids), $this->users);
		//$source = array_unique($source, SORT_NUMERIC);
		foreach($source as $key => $item)
		{
			$result[$key] = $this->users[$key];
			if($group) $groups[$this->users[$key]['gid']] = $this->other['groups'][$this->users[$key]['gid']];
			unset($ids[array_search($key, $ids)]);
		}
		
		// Anything in memcached..?
		/*if($this->mcache)
		{
			$users = $this->mcache->getMulti(array_walk($ids, function(&$str)
			{
				$str = "user_{$str}";
			}));
			if($users)
			{
				foreach($users as $user)
				{
					$result[$user['uid']] = $user;
					$this->users[$user['uid']] = $user;
					$this->indexes['usernames'][$user['username']] = $user['uid'];
					$this->gids[$user['gid']][] = $user['uid'];
					unset($ids[array_search($item)]);
				}
			}
		}*/
		
		// Anything in the file cache system..?
		
		if($group) return [$result,$groups];
		return $result;
	}
	/*
	public function getGroupsInBulk(array $gids)
	{
		if(!$group = $this->mcache->get('group_'.$uid))
			$this->users[$user['uid']] = $user;
	}
	*/
	
	function hasUser($uid)
	{
		return isset($this->users[$uid]);
	}
	
	/**
	*
	*	An integer corresponding with the user's internal identifier number.
	*
	**/
	function userHasGroup($uid)
	{
		return isset($this->users[$uid]['name']);
	}
	
	function hasGroup($gid)
	{
		return isset($this->other[$gid]);
	}
	
	// Must benchmark this..
	function getUserByGroup($gid)
	{
		if(!isset($this->gids[$gid]) || count($this->gids[$gid])==0) return false;
		$users = $this->gids[$gid];
		foreach($users as $user) $return[] = $this->users[$user];
		return $return;
	}
	
	/**
	*
	*	$cache - A string holding the name of the cache.
	*
	**/
	function read($cache, $ext = 'php')
	{
		if(!include(ABB_BASE."/cache/{$cache}.{$ext}")) return false;
		return $$cache;
	}
	
	function getLastModifiedTime($cache, $ext = 'php')
	{
		return filemtime(ABB_BASE."/cache/{$cache}.{$ext}");
	}
	
	function cacheExists($cache, $folder = null, $ext = 'php')
	{
		if($folder==null) return file_exists(ABB_BASE."/cache/{$cache}.{$ext}");
		return file_exists(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}");
	}
	
	function destroyCache($cache, $folder = null, $ext = 'php')
	{
		if($folder==null) return unlink(ABB_BASE."/cache/{$cache}.{$ext}");
		return unlink(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}");
	}
	
	function emptyCache($cache, $folder = false, $ext = 'php')
	{
		if(!$folder) return unlink(ABB_BASE."/cache/{$cache}.{$ext}");
		if(!$handle = opendir(ABB_BASE."/cache/{$cache}")) return false;
		
		// Loop through the directory...
		while(($entry = readdir($handle))!==false)
		{
			if($entry=="." || $entry=="..") continue;
			$entry = str_replace("\0","",$entry);
			if($entry=='index.html') continue;
			if(!unlink(ABB_BASE."/cache/{$cache}/{$entry}")) return false;
		}
		return true;
	}
	
	function writeCache($name, $data = null, $path = null, $raw = false, $ext = 'php')
	{
		if($data==null) $data = $this->other[$name];
		if($path==null) $path = str_replace("\0",'',$name);
		
		$plugins = $this->main->getPlugins();
		if(($res = $plugins->hook('cache_write_start', $name, $data, $path, $raw))!==null) return $res;
		
		if($this->mcache) $this->mcache->add($name, $data);
		
		$handle = fopen(ABB_BASE."/cache/{$path}.{$ext}",'w');
		if(!$raw)
		{
			$str = "<?php\nif(!defined('HADRON_START')) die('You\'re not supposed to be here');\n";
			if(is_array($data))
			{
				$str .= "\$cached_data = [];\n";
				foreach($data as $key => $value)
				{
					if(is_array($value))
					{
						foreach($value as $k => $v)
						{
							$key = str_replace("'","\'",$key);
							$k = str_replace("'","\'",$k);
							$v = str_replace("'","\'",$v);
							$str .= "\$cached_data['{$key}']['{$k}'] = '{$v}';\n";
						}
					}
					else
					{
						$key = str_replace("'","\'",$key);
						$value = str_replace("'","\'",$value);
						$str .= "\$cached_data['{$key}'] = '{$value}';\n";
					}
				}
			} else {
				$data = str_replace("'","\'",$data);
				$str .= "\$cached_data = '{$data}';\n";
			}
		} else $str = $data;
		fwrite($handle, $str);
		fclose($handle);
	}
	
	function loadCache($cache, $folder = false, $cache_expiry = null, $novars = false, $ext = 'php')
	{
		if($cache_expiry==null) $cache_expiry = $this->main->settings['cache_expiry'];
		
		$cache = str_replace("\0",'', $cache);
		
		$plugins = $this->main->getPlugins();
		if(($res = $plugins->hook('cache_load_start', $cache, $folder, $cache_expiry))!==null) return $res;
		
		if($this->mcache)
		{
			if(!$folder) $cname = $cache;
			else $cname = "{$folder}_{$cache}";
			
			if($res = $this->mcache->get($cname))
			{
				if(!$folder) $this->other[$cache] = $res;
				else $this->other[$folder][$cache] = $res;
				return true;
			}
		}
		
		if(!$folder)
		{
			if(!file_exists(ABB_BASE."/cache/{$cache}.{$ext}") || ((filemtime(ABB_BASE."/cache/{$cache}.{$ext}") + $cache_expiry) < time())) return false;
			if($novars)
			{
				ob_start();
				if(!include(ABB_BASE."/cache/{$cache}.{$ext}")) return false;
				$this->other[$cache] = ob_get_contents();
				ob_end_clean();
			}
			else
			{
				if(!include(ABB_BASE."/cache/{$cache}.{$ext}")) return false;
				$this->other[$cache] = $cached_data;
			}
			$cname = $cache;
		} else {
			if(!file_exists(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}") || ((filemtime(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}") + $cache_expiry) < time())) return false;
			if($novars)
			{
				ob_start();
				if(!include(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}")) return false;
				$this->other[$folder][$cache] = ob_get_contents();
				ob_end_clean();
			}
			else {
				if(!include(ABB_BASE."/cache/{$folder}/{$cache}.{$ext}")) return false;
				$this->other[$folder][$cache] = $cached_data;
			}
			$cname = "{$folder}_{$cache}";
		}
		
		if($this->mcache) $this->mcache->add($cname, $this->other[$folder][$cache]);
		
		return true;
	}
	
	function isLoaded($name, $folder = false)
	{
		if(!$folder) return isset($this->order[$cache]);
		else return isset($this->order[$folder][$name]);
	}
	
	function addCache($cache, $data)
	{
		$this->other[$cache] = $data;
	}
	
	function getCache($cache)
	{
		return $this->other[$cache];
	}
	
	function removeCache($cache)
	{
		unset($this->other[$cache]);
	}
	
	function get($name, $cache = null)
	{
		if($cache==null) return $this->other[$name];
		return $this->other[$cache][$name];
	}
	
	function set($name, $value, $cache)
	{
		$this->other[$cache][$name] = $value;
	}
}