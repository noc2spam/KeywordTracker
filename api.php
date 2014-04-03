<?php
/*

This script is licensed under Apache 2.0. View the license here:
http://www.apache.org/licenses/LICENSE-2.0.html
Copyright Reserved to g0g0l
Contact @ Skype : noc2spam
*/

/*$mtime = microtime();
   $mtime = explode(" ",$mtime);
   $mtime = $mtime[1] + $mtime[0];
   $starttime = $mtime; 
require 'bootstrap.php';

//$user = new User();
//$user->insert();

  //  $user->attributes = array('a1' => rand(0, 4), 'a2' => rand(0, 44), 'a5' => rand(0, 444));


//$user->insert();

var_dump($googleScraper);
$mtime = microtime();
   $mtime = explode(" ",$mtime);
   $mtime = $mtime[1] + $mtime[0];
   $endtime = $mtime;
   $totaltime = ($endtime - $starttime);
   echo "This page was created in ".$totaltime." seconds"; */
   require('bootstrap.php');
	$task = @$_REQUEST['task'];
	
	switch($task){
		default:
		echo json_encode(array('error' => true, 'data' => 'Invalid API Method.' ));
		break;
		
		case 'getranking':
		echo  googleScraper::scrape('Google search', array('http://www.google.com'));
		break;
		
	}
	die();