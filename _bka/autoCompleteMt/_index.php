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
	
<?php
//Connect to mysql db
$conn = mysql_connect('localhost','username','password');
mysql_select_db('ckaj',$conn);

    $query = "SELECT daftar_id, tajuk FROM daftar_projek ORDER BY daftar_id ASC";

$o = "var tokens2 = [";
$result=mysql_query($query); 

if (!$result) {
die( 'ada error '. mysql_error()); }
  
while ($row = mysql_fetch_array($result)) {
    $o .= "'".trim($row['tajuk'])."',";
}
$o .= "'myprojek'];";
echo $o;
?>	
	
	
		// Test source, list of countries
		var tokens = ['Afghanistan', 'Åland Islands', 'Albania', 'Algeria', 'American Samoa', 'Andorra', 'Angola', 'Anguilla', 'Antarctica', 'Antigua And Barbuda', 'Argentina', 'Armenia', 'Aruba', 'Australia', 'Austria', 'Azerbaijan', 'Bahamas', 'Bahrain', 'Bangladesh', 'Barbados', 'Belarus', 'Belgium', 'Belize', 'Benin', 'Bermuda', 'Bhutan', 'Bolivia', 'Bosnia And Herzegovina', 'Botswana', 'Bouvet Island', 'Brazil', 'British Indian Ocean Territory', 'Brunei Darussalam', 'Bulgaria', 'Burkina Faso', 'Burundi', 'Cambodia', 'Cameroon', 'Canada', 'Cape Verde', 'Cayman Islands', 'Central African Republic', 'Chad', 'Chile', 'China', 'Christmas Island', 'Cocos (Keeling) Islands', 'Colombia', 'Comoros', 'Congo', 'Congo, The Democratic Republic Of The', 'Cook Islands', 'Costa Rica', 'Cote D\'ivoire', 'Croatia', 'Cuba', 'Cyprus', 'Czech Republic', 'Denmark', 'Djibouti', 'Dominica', 'Dominican Republic', 'Ecuador', 'Egypt', 'El Salvador', 'Equatorial Guinea', 'Eritrea', 'Estonia', 'Ethiopia', 'Falkland Islands (Malvinas)', 'Faroe Islands', 'Fiji', 'Finland', 'France', 'French Guiana', 'French Polynesia', 'French Southern Territories', 'Gabon', 'Gambia', 'Georgia', 'Germany', 'Ghana', 'Gibraltar', 'Greece', 'Greenland', 'Grenada', 'Guadeloupe', 'Guam', 'Guatemala', 'Guernsey', 'Guinea', 'Guinea-Bissau', 'Guyana', 'Haiti', 'Heard Island And Mcdonald Islands', 'Holy See (Vatican City State)', 'Honduras', 'Hong Kong', 'Hungary', 'Iceland', 'India', 'Indonesia', 'Iran, Islamic Republic Of', 'Iraq', 'Ireland', 'Isle Of Man', 'Israel', 'Italy', 'Jamaica', 'Japan', 'Jersey', 'Jordan', 'Kazakhstan', 'Kenya', 'Kiribati', 'Korea, Democratic People\'s Republic Of', 'Korea, Republic Of', 'Kuwait', 'Kyrgyzstan', 'Lao People\'s Democratic Republic', 'Latvia', 'Lebanon', 'Lesotho', 'Liberia', 'Libyan Arab Jamahiriya', 'Liechtenstein', 'Lithuania', 'Luxembourg', 'Macao', 'Macedonia, The Former Yugoslav Republic Of', 'Madagascar', 'Malawi', 'Malaysia', 'Maldives', 'Mali', 'Malta', 'Marshall Islands', 'Martinique', 'Mauritania', 'Mauritius', 'Mayotte', 'Mexico', 'Micronesia, Federated States Of', 'Moldova, Republic Of', 'Monaco', 'Mongolia', 'Montenegro', 'Montserrat', 'Morocco', 'Mozambique', 'Myanmar', 'Namibia', 'Nauru', 'Nepal', 'Netherlands', 'Netherlands Antilles', 'New Caledonia', 'New Zealand', 'Nicaragua', 'Niger', 'Nigeria', 'Niue', 'Norfolk Island', 'Northern Mariana Islands', 'Norway', 'Oman', 'Pakistan', 'Palau', 'Palestinian Territory, Occupied', 'Panama', 'Papua New Guinea', 'Paraguay', 'Peru', 'Philippines', 'Pitcairn', 'Poland', 'Portugal', 'Puerto Rico', 'Qatar', 'Reunion', 'Romania', 'Russian Federation', 'Rwanda', 'Saint Helena', 'Saint Kitts And Nevis', 'Saint Lucia', 'Saint Pierre And Miquelon', 'Saint Vincent And The Grenadines', 'Samoa', 'San Marino', 'Sao Tome And Principe', 'Saudi Arabia', 'Senegal', 'Serbia', 'Seychelles', 'Sierra Leone', 'Singapore', 'Slovakia', 'Slovenia', 'Solomon Islands', 'Somalia', 'South Africa', 'South Georgia And The South Sandwich Islands', 'Spain', 'Sri Lanka', 'Sudan', 'Suriname', 'Svalbard And Jan Mayen', 'Swaziland', 'Sweden', 'Switzerland', 'Syrian Arab Republic', 'Taiwan, Province Of China', 'Tajikistan', 'Tanzania, United Republic Of', 'Thailand', 'Timor-Leste', 'Togo', 'Tokelau', 'Tonga', 'Trinidad And Tobago', 'Tunisia', 'Turkey', 'Turkmenistan', 'Turks And Caicos Islands', 'Tuvalu', 'Uganda', 'Ukraine', 'United Arab Emirates', 'United Kingdom', 'United States', 'United States Minor Outlying Islands', 'Uruguay', 'Uzbekistan', 'Vanuatu', 'Venezuela', 'Viet Nam', 'Virgin Islands, British', 'Virgin Islands, U.S.', 'Wallis And Futuna', 'Western Sahara', 'Yemen', 'Zambia', 'Zimbabwe'];
	
		// Our instance for the element with id "demo-local"
		new Autocompleter.Local('demo-local', tokens, {
			'minLength': 1, // We wait for at least one character
			'overflow': true // Overflow for more entries
		});
	
		// Our instance for the element with id "demo-remote"
		new Autocompleter.Ajax.Json('demo-remote', 'data/country.php', {
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
		width:350px;
		border:1px solid #444;
	}
	</style>
</head>
<body>

<h1>Auto Complete</h1>
<h2>MooTools</h2>
<h3>Example 1.: Country Lookup</h3>
<p>Using <abbr title="Asynchronous JavaScript and XML">AJAX</abbr> to interrogate the database.</p>
<p>Example data: Australia, Bulgaria, United Kingdom</p>
<form name="frmAutoCompleteCountry" id="frmAutoCompleteCountry" action="#" method="post">
<p>
<label for="demote-remote">Country</label>
<input type="text" name="country" id="demo-remote" />
</p>
</form>

<h3>Example 2.: Country Lookup</h3>
<p>Using a local array to populate data.</p>
<p>Example data: Bradford, Leeds, Salisbury, York</p>
<form name="frmAutoCompleteCountry" id="frmAutoCompleteCountry" action="#" method="post">
<p>
<label for="demo-local">Country</label>
<input type="text" name="country" id="demo-local" />
</p>
</form>
</body>
</html>
