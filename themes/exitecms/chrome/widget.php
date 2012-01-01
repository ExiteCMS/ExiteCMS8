<?php
echo "<fieldset style='border:1px solid red;background-color:blue;margin:5px;padding:5px;'>
	<legend>";
echo isset($title) ? $title : 'WIDGET';
echo "</legend>
$_content_
</fieldset>\n";
