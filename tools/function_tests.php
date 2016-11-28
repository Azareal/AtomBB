<?php
define("HADRON_START", 1);
define("SCRIPT_NAME","/tools/function_tests.php");
require_once("../global.php");
require_once(ABB_INCLUDES."/functions.php");

if(!$perms->is("admin")) die($error->getError(403));
echo sanitise_url_part("1234567890-=qwertyuiop]asdfghjkl;'#\zxcvbnm,./!\"£$%^&*()_+");
echo "<br />";
