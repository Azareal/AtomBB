<?php
/*
	AtomBB Gadget Functions
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2015 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

function getGadgets($zone)
{
	global $db, $cache;
	
	$zone = str_replace('\\','_',$zone);
	$zone = explode('.',$zone)[0];
	
	$gdata = array();
	$both = 0;
	if($cache->loadCache('global','gadgets',ONE_MONTH))
	{
		$gdata = $cache->get('gadgets');
		$gdata = $gdata['global'];
		$both++;
	}
	
	if($cache->loadCache($zone,'gadgets',ONE_MONTH))
	{
		$tdata = $cache->get('gadgets');
		$gdata = array_merge($gdata, $tdata[$zone]);
		$both++;
	}
	
	if($both==2) return $gdata;
	
	$gdata = $db->join('*','slots','gadgets','sid','sid',"(gadgets.script='{$zone}.php' OR gadgets.script='') AND gadgets.enabled=1 AND slots.enabled=1",100,"gadgets.order ASC");
	if(isset($gdata['enabled'])) $gdata = array($gdata);
	
	// Process the results in order to push the right gadgets onto the right pile
	$glocal = array();
	$gglobal = array();
	foreach($gdata as $gitem)
	{
		if($gitem['script']=='') $gglobal[] = $gitem;
		else $glocal[] = $gitem;
	}
	
	if($glocal!=null) register_shutdown_function(array($cache,'writeCache'),"gadgets_{$zone}", $glocal,"gadgets/{$zone}");
	if($gglobal!=null) register_shutdown_function(array($cache,'writeCache'),"gadgets_global", $gglobal,"gadgets/global");
	
	return $gdata;
}