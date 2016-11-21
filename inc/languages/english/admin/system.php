<?php
/*
	AtomBB Admin System Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Main part..
$l['system_title'] = "System";
$l['system_unknown'] = "Unknown";
$l['system_overview_head'] = "Overview";
$l['system_alerts_head'] = "Alerts";

$l['system_overview_phpversion'] = "PHP Version";
$l['system_overview_usage'] = "CPU Usage";
$l['system_overview_load'] = "CPU Load";
$l['system_overview_memory_used'] = "Memory Used";
$l['system_overview_memory_allocated'] = "Memory Allocated";
$l['system_overview_disk_free'] = "Free Disk Space";
$l['system_overview_disk_used'] = "Used Disk Space";

$l['system_alert_cpu_error'] = "The server is currently overloaded due to there currently being more tasks than the processor can handle.";
$l['system_alert_cpu_success'] = "The server is keeping pace with all of the tasks which it has to handle.";
$l['system_alert_memory_error'] = "The memory which this application is using is getting dangerously close to the memory limit which has been set on it. You may want to increase the memory limit to one which is higher to fix this issue.";
$l['system_alert_memory_success'] = "There are currently no problems with the memory limit.";
$l['system_alert_disk_error'] = "The hard drive of this server is getting dangerously close to full.";
$l['system_alert_disk_success'] = "There is plenty of free space on the server.";
$l['system_alert_ipv6_error'] = "Your setup of PHP doesn't support IPv6.";

$l['side_nav_head'] = "System";
$l['side_nav_overview'] = "Overview";
$l['side_nav_cache'] = "Cache Manager";
$l['side_nav_tasks'] = "Task Manager";
$l['side_nav_checksums'] = "File Verification";
$l['side_nav_dboptimise'] = "Database Optimisation";
$l['side_nav_statistics'] = "Statistics";
$l['side_nav_security'] = "Security";
$l['side_nav_modlogs'] = "Moderation Logs";
$l['side_nav_adminlogs'] = "Administration Logs";