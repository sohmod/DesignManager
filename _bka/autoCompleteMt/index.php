<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Auto Complete - MooTools &amp; PHP</title>
	<script type="text/javascript" src="scripts/mootools.js"></script>
	<script type="text/javascript" src="scripts/Observer.js"></script>
	<script type="text/javascript" src="scripts/Autocompleter.js"></script>
	<link rel="stylesheet" href="styles/Autocompleter.css" type="text/css" media="screen" />

	<script type="text/javascript">
	/* <![CDATA[ */
	window.addEvent('domready', function() {
	
	
		// Our instance for the element with id "demo-remote"
		new Autocompleter.Ajax.Json('demo-remote', 'data/tajukprojek_.php', {
			//name the element containing the search term something suitable
			//otherwise defaults to 'value'
			'postVar': 'q'
		});
	});
	/* ]]> */
	</script>
	<style type="text/css">
	#demo-local, #demo-remote
	{
		width:750px;
		height:40px;
		border:1px solid #444;
	}
	</style>
</head>
<body>

<h1>Auto Complete - Kecukupan Sendiri</h1>
<h2>MooTools - perkakasanlembu</h2>
<h3>Example - Contoh : Project Lookup - Kesan Projek</h3>
<form name="frmAutoCompleteCountry" id="frmAutoCompleteCountry" action="#" method="post">
<p>
<label for="demote-remote">Tajuk projek</label>
<textarea type="text" name="country" id="demo-remote" ></textarea>
</p>
</form>



</body>
</html>
