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
	if($cache->loadCache('global','gadgets',60 * 60 * 24 * 31))
	{
		$gdata = $cache->get('gadgets');
		$gdata = $gdata['global'];
		$both++;
	}
	
	if($cache->loadCache($zone,'gadgets',60 * 60 * 24 * 31))
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
	
	// TO-DO: Turn this lambda into a more general purpose caching solution rather than it being specific to the gadget system..
	$gadgetCache = function($gadgets, $zone)
	{
		if(file_exists(ABB_BASE."/cache/gadgets/{$zone}.php")) $handle = @fopen(ABB_BASE."/cache/gadgets/{$zone}.php",'w');
		else $handle = false;
		if(!$handle) return;
		$str = "<?php\n";
		$str .= "\${$zone} = array();\n";
		foreach($gadgets as $key => $value)
		{
			foreach($value as $fieldName => $fieldData)
			{
				$fieldName = str_replace("'","\'",$fieldName);
				$fieldData = str_replace("'","\'",$fieldData);
				$str .= "\${$zone}['{$key}']['{$fieldName}'] = '{$fieldData}';\n";
			}
		}
		$str .= "?>";
		fwrite($handle, $str);
		fclose($handle);
	};
	
	register_shutdown_function($gadgetCache, $glocal, $zone);
	register_shutdown_function($gadgetCache, $gglobal,'global');
	
	return $gdata;
}