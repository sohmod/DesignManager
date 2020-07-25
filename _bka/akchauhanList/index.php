<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>jQuery content selection from list.</title>
<link href="test.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="jquery.js"></script>
</head>
<body>
<div class="stack">
      <div class="form_top"> </div>
      <div class="float_break"></div>
        <div class="form">
          <br />
          <div class="formbox">        
            <h5>All Users</h5><br />
            <div id="all_users">
<?php
//$db = new mysqli("localhost", "username", "password", "ckaj");
	//Connect to mysql db
	$conn = mysql_connect('localhost','username','password');
	mysql_select_db('ckaj',$conn);
$bio="SELECT user_id,username,first_name,last_name,kp_s FROM users";
$result=mysql_query($bio); 

while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {

			echo '
           		<div id="user'.$row["user_id"].'" userid="'.$row["user_id"].'" class="innertxt">
					<img src="stafbka/'.$row["username"].'.gif" width="40" height="40"><strong>'.$row["first_name"].' '.$row["last_name"].'</strong>
					<ul>
                    	<li>User ID: '.$row["kp_s"].'</li>
                        <li>Email: '.$row["username"].'@jkr.gov.my</li>
                        <li style="padding-top:5px;"><input type="checkbox" id="select'.$row["user_id"].'" value="'.$row["user_id"].'" class="selectit" /><label for="select'.$row["user_id"].'">&nbsp;&nbsp;Select it.</label></li>
                    </ul>
                 </div>';
				 
				 }
?>				 
                <div class="float_break"></div>
            </div>
            <div style="width:100px; text-align:center; margin-left:20px; padding-top: 100px; width:75px; float:left;">
           	<a href="javascript:void(0);" id="move_right">Right &raquo;</a><br /><br />
            <a href="javascript:void(0);" id="move_left">&laquo; Left</a>
            <div class="float_break"></div>   
            </div>
            <div id="selected_users"></div>
             <div class="float_break"></div> 
            <div class="formbox">
            <input type="button" value="View Selected users Id" id="view" class="form_button"/>
            <div class="float_break"></div>
            </div>
          </div>
          <div class="float_break"></div>
        </div>
      <div class="form_bot"></div>
    </div>
</body>
</html>
<script language="javascript">
	$(document).ready(function () {
		// Uncheck each checkbox on body load
		$('#all_users .selectit').each(function() {this.checked = false;});
		$('#selected_users .selectit').each(function() {this.checked = false;});
		
    	$('#all_users .selectit').click(function() {
			var userid = $(this).val();
			$('#user' + userid).toggleClass('innertxt_bg');
		});
		
		$('#selected_users .selectit').click(function() {
			var userid = $(this).val();
			$('#user' + userid).toggleClass('innertxt_bg');
		});
		
		$("#move_right").click(function() {
			var users = $('#selected_users .innertxt2').size();
			var selected_users = $('#all_users .innertxt_bg').size();
			
			if (users + selected_users > 15) {
				alert('You can only chose maximum 15 users.');
				return;
			}
			
			$('#all_users .innertxt_bg').each(function() {
				var user_id = $(this).attr('userid');
				$('#select' + user_id).each(function() {this.checked = false;});
				
				var user_clone = $(this).clone(true);
				$(user_clone).removeClass('innertxt');
				$(user_clone).removeClass('innertxt_bg');
				$(user_clone).addClass('innertxt2');
				
				$('#selected_users').append(user_clone);
				$(this).remove();
			});
		});
		
		$("#move_left").click(function() {
			$('#selected_users .innertxt_bg').each(function() {
				var user_id = $(this).attr('userid');
				$('#select' + user_id).each(function() {this.checked = false;});
				
				var user_clone = $(this).clone(true);
				$(user_clone).removeClass('innertxt2');
				$(user_clone).removeClass('innertxt_bg');
				$(user_clone).addClass('innertxt');
				
				$('#all_users').append(user_clone);
				$(this).remove();
			});
		});
		
		$('#view').click(function() {
			var users = '';
			$('#selected_users .innertxt2').each(function() {
				var user_id = $(this).attr('userid');
				if (users == '') 
					users += user_id;
				else
					users += ',' + user_id;
			});
			alert(users);
		});
	});
</script>