<?php
/*
	AtomBB Ban System Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['bans_badban'] = "Either a group for this ban doesn't exist or you're trying to ban a supermod or higher.";
$l['bans_none'] = "The user who you're trying to ban does not exist.";
$l['bans_superadminban'] = "You do not have authorisation to ban the superadmins.";
$l['bans_nobanban'] = "You do not have authorisation to ban users with ban immunity.";
$l['bans_equalban'] = "You do not have authorisation to ban users with equal or higher status than you.";
$l['bans_nobanperms'] = "Automatic banning has failed as you do not have authorisation to issue indirect bans";
$l['bans_selfban'] = "You may not ban yourself, ask someone to do it for you.";
$l['bans_founderban'] = "You do not have authorisation to ban the founder.";