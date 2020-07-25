<?php
/*

We get the following values by default from EditInPlace:

id - The DOM id
form_type - The edit field type (text, textarea, select)
old_content - The pre-edited content
new_content - The edited content

If the form_type was select then we'll also get

old_option - The pre-edited option
new_option - The edited option
old_option_text - The pre-edited display option
new_option_text - The edited display option

If any additional data was specified via the xhr_data option
then it will also be provided.

 */

// Add a little delay so that the user has a chance
// to actually see the saving message.
sleep(0);

$id				= $_GET["id"];


print_r("<pre>\n" . print_r($_GET, true) . "\n</pre>\n");

?>
