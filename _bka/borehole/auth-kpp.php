<?php
	//Start session
	session_start();
	
	//Check whether the session variable SESS_MEMBER_ID is present or not
/*	if(!isset($_SESSION['OIC']) || (trim($_SESSION['OIC']) == '')) {
		header("location: access-denied.php");
		exit();
	} */
	if (!$_SESSION['OIC'] && !$_SESSION['username']): header("location: access-denied2.php");
		exit();
				elseif (!$_SESSION['OIC'] && $_SESSION['username']): header("location: access-denied.php");
		exit(); 
					else:  // do nothing ;
						endif;
	
	
	
?>