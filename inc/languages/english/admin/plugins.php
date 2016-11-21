<?php
/*
	AtomBB Admin Plugins Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2017.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Main part..
$l['plugins_title'] = "Plugins";

$l['side_nav_head'] = "Plugins";
$l['side_nav_import'] = "Import Plugin";
$l['side_nav_settings'] = "Settings";

$l['plugins_row_author'] = "Author";
$l['plugins_row_nooptions'] = "No options available";
$l['plugins_row_install'] = "Install";
$l['plugins_row_uninstall'] = "Uninstall";
$l['plugins_row_activate'] = "Activate";
$l['plugins_row_deactivate'] = "Deactivate";
$l['plugins_row_noversion'] = "None";

$l['plugins_success_activate'] = "The plugin has successfully been activated.";
$l['plugins_success_deactivate'] = "The plugin has successfully been deactivated.";
$l['plugins_success_install'] = "The plugin has successfully been installed.";
$l['plugins_success_uninstall'] = "The plugin has successfully been uninstalled.";
$l['plugins_success_import'] = "The plugin has successfully been imported.";
$l['plugins_error_reservedname'] = "The plugin which you are attempting to install uses a reserved name.";
$l['plugins_error_namemismatch'] = "The name of the plugin directory doesn't match the defined plugin name.";
$l['plugins_error_install'] = "An error occured during the installation process.";
$l['plugins_error_install_dupe'] = "This plugin has already been installed.";
$l['plugins_error_depends'] = "A required dependency for this plugin has not been installed.";
$l['plugins_error_missing'] = "This plugin has missing files.";
$l['plugins_error_activate'] = "An error occured during the activation process.";
$l['plugins_error_activate_notinstalled'] = "This plugin hasn't been installed.";
$l['plugins_error_activate_depends'] = "A required dependency for this plugin may be corrupt.";
$l['plugins_error_deactivate_force'] = "The execution of the plugin has been successfully terminated. Not all deactivation routines have run successfully.";
$l['plugins_error_deactivate_notfound'] = "The system was unable to find the plugin files for the plugin which you are trying to deactivate.";
$l['plugins_error_deactivate_already'] = "The plugin which you are trying to deactivate is not activated.";
$l['plugins_error_deactivate_badxml'] = "The XML file for this plugin could not be processed properly.";

$l['plugins_head'] = "Plugins";
$l['plugins_none'] = "There are currently no plugins.";

$l['plugins_badsession'] = "The provided session string is not valid.";