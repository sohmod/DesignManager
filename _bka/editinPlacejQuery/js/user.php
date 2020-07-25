<?php
// sql ::  ALTER TABLE eb_users ADD COLUMN user_website varchar(250) NOT NULL AFTER user_name;


function eb_login($email,$password,$key) {
	settype($key,"integer");
	if(session_id()=="") eb_pre();
	if($key==0) $password=md5($password);
       else $password=htmlentities($password,ENT_QUOTES);
       $email=htmlentities($email,ENT_QUOTES);
	$sql="SELECT user_id FROM eb_users WHERE user_email=\"".$email."\" AND md5(user_password)=\"".$password."\"";
	$query=mysql_query($sql);
	if(mysql_num_rows($query)==0) return false;
 	else {
		$_SESSION['user_id-'.$_SERVER['SERVER_NAME']]=mysql_result($query,0);
		setcookie("email-".str_replace(".","_",$_SERVER['SERVER_NAME']),"dummytext",time()-60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
		setcookie("password-".str_replace(".","_",$_SERVER['SERVER_NAME']),"dummytext",time()-60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
		setcookie("email-".str_replace(".","_",$_SERVER['SERVER_NAME']),$email,time()+60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
		setcookie("password-".str_replace(".","_",$_SERVER['SERVER_NAME']),$password,time()+60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
		return true;
	}
}


function eb_logout() {
	if(session_id()=="") eb_pre();
	if(empty($_SERVER['HTTP_REFERER'])) $_SERVER['HTTP_REFERER']="index.php";
	unset($_SESSION['user_id-'.$_SERVER['SERVER_NAME']]);
	setcookie("email-".str_replace(".","_",$_SERVER['SERVER_NAME']),"dummytext",time()-60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
	setcookie("password-".str_replace(".","_",$_SERVER['SERVER_NAME']),"dummytext",time()-60*60*24*365,"/",$_SERVER['SERVER_NAME'],0);
	header("Location: index.php");
}


function eb_checkadmin($id) {
	settype($id,"integer");
	$sql="SELECT user_flag FROM eb_users WHERE user_id=".$id;
	$query=mysql_query($sql);
	if(mysql_num_rows($query)>0) {
		if(mysql_result($query,0)==2) return true;
		else return false;
	}
	else return false;
}

	
function eb_userdetails() {
	global $lang;
	if(!isset($_SESSION["user_id-".$_SERVER['SERVER_NAME']])) header("Location: index.php");
	$output="<h3>".ucwords($lang['my_details'])."</h3>\r\n";
	if(!empty($_POST['password']) && !empty($_POST['name']) && !empty($_POST['password'])) {
		$sql="UPDATE eb_users SET user_name=\"".htmlentities($_POST["name"],ENT_QUOTES)."\",user_website=\"".htmlentities($_POST["website"],ENT_QUOTES)."\",user_email=\"".htmlentities($_POST["email"],ENT_QUOTES)."\",user_password=\"".htmlentities($_POST["password"],ENT_QUOTES)."\" WHERE user_id=".$_SESSION["user_id-".$_SERVER['SERVER_NAME']];
		mysql_query($sql);
		$output.="\t<table>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['username'])."</th><td>".htmlentities($_POST['name'],ENT_QUOTES)."</td></tr>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['website'])."</th><td>".htmlentities($_POST['website'],ENT_QUOTES)."</td></tr>\r\n";
		
		$output.="\t\t<tr><th>".ucwords($lang['email'])."</th><td>".htmlentities($_POST['email'],ENT_QUOTES)."</td></tr>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['password'])."</th><td>******</td></tr>\r\n";
		$output.="\t</table>\r\n";
	}
	else {
		$sql="SELECT user_name,user_website,user_email,user_password FROM eb_users WHERE user_id=".$_SESSION["user_id-".$_SERVER['SERVER_NAME']];
		$query=mysql_query($sql);
		$row=mysql_fetch_row($query);
		$output.="<form action=\"".$_SERVER['PHP_SELF']."\" method=\"post\">\r\n";
		$output.="\t<table>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['username'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"name\" value=\"".$row[0]."\" /></td></tr>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['website'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"website\" value=\"".$row[1]."\" /></td></tr>\r\n";
		
		$output.="\t\t<tr><th>".ucwords($lang['email'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"email\" value=\"".$row[2]."\" /></td></tr>\r\n";
		$output.="\t\t<tr><th>".ucwords($lang['password'])."</th><td><input class=\"inputtext\" type=\"password\" name=\"password\" value=\"".$row[3]."\" /></td></tr>\r\n";
		$output.="\t\t<tr><th></th><td><input type=\"submit\" name=\"submit\" value=\"".ucwords($lang['save'])."\" /></td></tr>\r\n";
		$output.="\t</table>\r\n";
		$output.="</form>\r\n";
	}
	echo $output;
}


function eb_forgot() {
	global $config,$lang;
	$output="\t\t<h3>".ucwords($lang['forgot_password'])."</h3>\r\n";
	if(!empty($_POST['email'])) {
		$_POST['email']=htmlentities($_POST['email'],ENT_QUOTES);
		$sql="SELECT user_password FROM eb_users WHERE user_email=\"".$_POST['email']."\"";
		$query=mysql_query($sql);
		if(mysql_num_rows($query)==1) {
			mail($_POST['email'],$lang['forgot_password'],$lang['email'].": ".$_POST['email']."\r\n".$lang['password'].": ".mysql_result($query,0)."\r\n\r\n".$config['uri'],"From: ".$config['title']."<".$config['email'].">\r\n");
			$output.="\t\t<p>".$lang['forgot_ok'].".</p>\r\n";
		}
		else {
			$output.="\t\t<p>".$lang['forgot_not_found'].".</p>\r\n";
			$output.="\t\t<form action=\"forgot.php\" method=\"post\">\r\n";
			$output.="\t\t\t<p><b>".ucwords($lang['email'])."</b>: <input class=\"inputtext\" type=\"text\" name=\"email\" value=\"".$_POST['email']."\" /></p>\r\n";
			$output.="\t\t\t<input type=\"submit\" name=\"submit\" value=\"".$lang['search']."\" />\r\n";
			$output.="\t\t</form>\r\n";
		}
	}
	else {
		$output.="\t\t<form action=\"forgot.php\" method=\"post\">\r\n";
		$output.="\t\t\t<p><b>".ucwords($lang['email'])."</b>: <input class=\"inputtext\" type=\"text\" name=\"email\" /></p>\r\n";
		$output.="\t\t\t<input type=\"submit\" name=\"submit\" value=\"".ucwords($lang['search'])."\" />\r\n";
		$output.="\t\t</form>\r\n";
	}
	return $output;
}


function eb_register() {
	global $lang;
	foreach($_POST as $key=>$value) $_POST[$key]=htmlentities($value,ENT_QUOTES);
	$output="\t\t<h3>".ucwords($lang['register'])."</h3>\r\n";
//	if(!empty($_POST['captcha']) && !empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['password'])) {
	if(!empty($_POST['captcha']) && !empty($_POST['name']) && !empty($_POST['email'])) {
	
		if($_SESSION['captcha']==$_POST['captcha']) {
			$sql="SELECT user_flag FROM eb_users WHERE user_email=\"".$_POST['email']."\"";
			$query=mysql_query($sql);
			if(mysql_num_rows($query)==1) {
				if(mysql_result($query,0)==0) {
					mysql_query("UPDATE eb_users SET user_flag=1 WHERE user_email=\"".$_POST['email']."\"");
					$output.="\t\t<table>\r\n";
					$output.="\t\t\t<tr><th>".ucwords($lang['username'])."</th><td>".$_POST['name']."</td></tr>\r\n";
					$output.="\t\t\t<tr><th>".ucwords($lang['website'])."</th><td>".$_POST['website']."</td></tr>\r\n";
					
					$output.="\t\t\t<tr><th>".ucwords($lang['email'])."</th><td>".$_POST['email']."</td></tr>\r\n";
					$output.="\t\t\t<tr><th>".ucwords($lang['password'])."</th><td>".$_POST['password']."</td></tr>\r\n";
					$output.="\t\t</table>\r\n";
				}
				else {
					$output.="\t\t<p>".$lang['register_fail'].".</p>\r\n";
					$output.="\t\t<p><a href=\"forgot.php\">".$lang["forgot_password"]."?</a></p>\r\n";
				}
			}
			else {
				$sql="INSERT INTO eb_users SET user_flag=1,user_name=\"".htmlentities($_POST['name'],ENT_QUOTES)."\",user_website=\"".htmlentities($_POST['website'],ENT_QUOTES)."\",user_email=\"".htmlentities($_POST['email'],ENT_QUOTES)."\",user_password=\"".htmlentities($_POST['password'],ENT_QUOTES)."\"";
				mysql_query($sql);
				$output.="\t\t<table>\r\n";
				$output.="\t\t\t<tr><th>".ucwords($lang['username'])."</th><td>".$_POST['name']."</td></tr>\r\n";
				$output.="\t\t\t<tr><th>".ucwords($lang['website'])."</th><td>".$_POST['website']."</td></tr>\r\n";
				
				$output.="\t\t\t<tr><th>".ucwords($lang['email'])."</th><td>".$_POST['email']."</td></tr>\r\n";
				$output.="\t\t\t<tr><th>".ucwords($lang['password'])."</th><td>".$_POST['password']."</td></tr>\r\n";
				$output.="\t\t</table>\r\n";
			}
		}
		else {
			$output.="\t\t<p>".$lang['captcha_wrong'].".</p>\r\n";
			$output.="\t\t<p>".$lang['error_goback'].".</p>\r\n";
		}
	}
	else {
		$output.="\t\t<form action=\"register.php\" method=\"post\">\r\n";
		$output.="\t\t\t<table>\r\n";
		$output.="\t\t\t\t<tr><th>".ucwords($lang['username'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"name\" /></td></tr>\r\n";
		$output.="\t\t\t\t<tr><th>".ucwords($lang['website'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"website\" /></td></tr>\r\n";
		
		$output.="\t\t\t\t<tr><th>".ucwords($lang['email'])."</th><td><input class=\"inputtext\" type=\"text\" name=\"email\" /></td></tr>\r\n";
		$output.="\t\t\t\t<tr><th>".ucwords($lang['password'])."</th><td><input class=\"inputtext\" type=\"password\" name=\"password\" /></td></tr>\r\n";
		$output.="\t\t\t\t<tr><th>".ucwords($lang['captcha'])."</th><td><img src=\"captcha.php\" width=\"150\" height=\"55\" /><br /><br />".$lang['captcha_enter'].":<br /><input type=\"text\" name=\"captcha\" class=\"inputtext\" /></td></tr>\r\n";
		$output.="\t\t\t\t<tr><th></th><td><input type=\"submit\" name=\"submit\" value=\"".ucwords($lang['save'])."\" /></td></tr>\r\n";
		$output.="\t\t\t</table>\r\n";
		$output.="\t\t</form>\r\n";
	}
	return $output;
}

?>