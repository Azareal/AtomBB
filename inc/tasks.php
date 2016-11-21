<?php
/*
	AtomBB Task System
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$time = time();
$nextrun = 60 * 15;
if(($cache->data['lastTaskRun'] + $nextrun) < $time)
{
	$res = $db("UPDATE {\$prefix}users AS users LEFT JOIN {\$prefix}warnings AS warns ON users.uid=warns.target SET users.warnpoints=users.warnpoints - warns.points WHERE warns.active='1' AND warns.expiry<='{$time}' AND warns.expiry!='-1'");
	if($res) $db->update("warnings","active=0","active=1 AND expiry<='{$time}' AND expiry!='-1'");
	
	$res = $db("UPDATE {\$prefix}users AS users LEFT JOIN {\$prefix}bans AS bans ON users.uid=bans.uid SET users.gid=bans.nextGroup WHERE bans.active='1' AND bans.expiry<='{$time}' AND bans.expiry!='-1'");
	if($res) $db->update("bans","active=0","active=1 AND expiry<='{$time}' AND expiry!='-1'");
	$cache->data['lastTaskRun'] = $time;
}