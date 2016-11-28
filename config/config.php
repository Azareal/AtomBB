<?php
/*
	AtomBB Configuration File.
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2013 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

// Path to the Hadron Framework?
$config['hpath'] = dirname(dirname(__FILE__))."/hadron";

// The database engine which we're using
$config['database_engine'] = "mysqli";

// The host for the database.
$config['database_host'] = "localhost";

// The username for the user accessing the database
$config['database_username'] = "root";

// The password for the user accessing the database
$config['database_password'] = "password";

// What database are we using?
$config['database_name'] = "atombb";

// What prefix is this installation using for tables?
$config['table_prefix'] = "atombb_";


// What language are we using?
$config['site_language'] = "english";

// Where's the Control Panel?
$config['admin_dir'] = "panel";

// Who's the big boss?
//$config['founder'] = "Admin";
$config['founder'] = 1;