
<style type="text/css">
	<!--
	@import url("bstyle.css");
	#align_center {
	text-align: center;
	width: 400px;
	}
	//-->
	</style>

<div id="align_center">
<div class="form_fields">


<h1>boastMachine installation</h1>

<form method="post" action="install.php" name="install">
<div>
<input type="hidden" name="c_url" value="" />
<input type="hidden" name="install" value="true" />
Autoset directory permissions? : <input type="checkbox" name="set_perm" value="true" /><br />
(Most likely to fail)
<br /><br />
MySQL server : <input type="text" name="db_host" /><br />
MySQL user : <input type="text" name="db_user" /><br />
MySQL password : <input type="password" name="db_pass" /><br />
MySQL database : <input type="text" name="db_name" /><br />
Overwrite existing tables? <input type="checkbox" name="ow" /><br /><br />

Create new database? <input type="checkbox" name="new_db" /><br />
(Only if you dont want to use an existing db)
<br /><br />

Desired admin username : <input type="text" name="admin_id" /><br />
Password : <input type="password" name="admin_pass" /><br />
Password #2 : <input type="password" name="admin_pass2" /><br /><br />

<input type="submit" value="Continue"><br /><br />
<div class="small_text">Warning! Overwriting the tables will destroy all existing data!</div>
</form>
</div>
<a href="http://boastology.com">boastMachine <?php echo BMC_VERSION; ?></a>
</div>
