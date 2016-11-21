<?php
exit;
function getLevel($score = 0, $level = 0)
{
	// Base to start from..
	if($level > 1) $i = $level + 4;
	else $i = 5;
	
	// Level loop..
	while($i <= 24)
	{
		// Calculate the next level..
		$points = (pow(2, $i) - pow(2, $i - 3) - ($i - 2)) * 1;
		
		// Another rule for really high levels..
		if($level >= 10) $points = $points -= pow(2, $i - 3);
		
		// Still going?
		$level = ($i - 4);
		echo "Level {$level}: {$points}<br />";
		
		// Increment this..
		$i++;
	}
	
	return $level;
}
getLevel(0,0);