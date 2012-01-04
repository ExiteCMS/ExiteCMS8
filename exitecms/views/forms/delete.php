<?php
// display the widget info text
if ( ! empty($info))
{
	echo '<fieldset>', "\n";
	echo "\t", '<legend>', \Lang::get('global.information'), '</legend>', "\n";
	echo "\t", '<div class="info">', $info, '</div>', "\n";
	echo '</fieldset>', "\n";
}

// build the form
echo \Form::open(array('onsubmit' => 'fuel_set_csrf_token(this)'));
echo \Form::hidden('form_id', $form_id);
echo \Form::hidden(\Config::get('security.csrf_token_key', 'fuel_csrf_token'), \Security::fetch_token());

// widget buttons

if ( ! empty($buttons))
{
	echo '<div style="text-align:center;margin:20px 0px;">',"\n";

	foreach($buttons as $name => $button)
	{
		echo \Form::submit('formbutton['.$name.']', $button['title'], array('class' => 'formbutton '.$button['class']));
	}

	echo '</div>',"\n";
}

echo \Form::close();
