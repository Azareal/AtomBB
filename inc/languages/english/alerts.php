<?php
/*
	AtomBB Alerts System Language File
	Created by Azareal.
	Licensed under the terms of the GPLv3.
	Copyright Azareal (c) 2012 - 2014.
*/

// Is someone trying to access this directly?
if(!defined("HADRON_START")) die("You are not allowed to access this file directly.");

$l['alerts_topic_new'] = "$1 has created a new topic";
$l['alerts_topic_deleted'] = "$1 has been deleted";
$l['alerts_topic_reply'] = "$1 has replied to $2";

$l['alerts_post_deleted'] = "A post in $1 has been deleted";
$l['alerts_post_deleted_yours'] = "Your post in $1 has been deleted";
$l['alerts_post_reply'] = "$1 replied to $2";
$l['alerts_post_reply_yours'] = "$1 replied to your post in $2";
$l['alerts_post_upvote'] = "$1 loved $2's post in $3";
$l['alerts_post_upvote_yours'] = "$1 loved your post in $2";
$l['alerts_post_mentioned'] = "$1 mentioned you";

$l['alerts_comment_new'] = "$1 has created a new comment";
$l['alerts_comment_new_yours'] = "$1 has commented on your profile";

$l['alerts_comment_reply'] = "$1 replied to $2's comment on $3's profile";
$l['alerts_comment_reply_yours'] = "$1 replied to $2's comment on your profile";
$l['alerts_comment_upvote'] = "$1 loved $2's comment on $3's profile";
$l['alerts_comment_upvote_yours'] = "$1 loved $2's comment on your profile";

$l['alerts_awards_stacked'] = "You have unlocked $1 titles";

// Errors..
$l['alerts_guest'] = "You need to login or to register to see your alerts.";
$l['alerts_noalerts'] = "There aren't any new alerts.";
$l['alerts_offline'] = "The forums are currently in maintenance mode.";
$l['alerts_norealtime'] = "The real-time feature for the alerts system is currently disabled.";