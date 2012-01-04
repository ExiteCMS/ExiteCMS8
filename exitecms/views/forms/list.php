<?php
/**
 * Default view file for the ExiteCMS\Core\Forms list widget
 */

$theme->asset()->js('jquery.tipTip.minified.js', array(), 'footer');

// display the widget info text
if ( ! empty($info))
{
	echo '<fieldset>', "\n";
	echo "\t", '<legend>', \Lang::get('global.information'), '</legend>', "\n";
	echo "\t", '<div class="info">', $info, '</div>', "\n";
	echo '</fieldset>', "\n";
}

// generate the list table
echo '<table id="listtable">',"\n";

// table headers
if ( ! empty($headers))
{
		echo "\t<tr>\n";
		foreach($headers as $header)
		{
			// make sure the required entries exist
			empty($header['options']) and $header['options'] = array();
			empty($header['title']) and $header['title'] = '?';

			echo "\t\t", html_tag('th', $header['options'], $header['title']) ,"\n";
		}
		echo "\t</tr>\n";
}

// table data
if ( ! empty($data))
{
	foreach($data as $record)
	{
		// new table row
		echo "\t<tr>\n";

		foreach($record as $field)
		{
			// make sure the required entries exist
			empty($field['options']) and $field['options'] = array();
			empty($field['title']) and $field['title'] = '';

			// icon column?
			if (isset($field['icon']))
			{
				$icon = $theme->asset()->img('icons/'.$field['icon'].'.png', array('title' => $field['title'], 'alt' => $field['title']));
				echo "\t\t", html_tag('td', $field['options'], $icon) ,"\n";
			}
			elseif (isset($field['values']))
			{
				$values = '';
				foreach ($field['values'] as $value)
				{
					// make sure the required entries exist
					empty($value['options']) and $value['options'] = array();
					empty($value['title']) and $value['title'] = '';
					empty($value['url']) and $value['url'] = $baseurl.'/'.$value['icon'];

					if (isset($value['confirm']) and $value['confirm'])
					{
						$value['options']['onclick'] = 'return confirm("'.htmlentities($value['confirm']).'");';
					}
					if ( ! isset($value['enabled']) or $value['enabled'])
					{
						$icon = $theme->asset()->img('icons/tbl_opt_'.$value['icon'].'.png', array('title' => $value['title'], 'alt' => $value['title']));
						$values .= \Html::anchor(\Uri::create($value['url']), $icon)."\n";
					}
					else
					{
						$values .= "\t\t".$theme->asset()->img('icons/tbl_opt_none.png', array('title' => $field['title'], 'alt' => $field['title']))."\n";
					}
				}
				echo "\t\t", html_tag('td', $field['options'], $values) ,"\n";
			}
			else
			{
				echo "\t\t", html_tag('td', $field['options'], $field['value']) ,"\n";
			}

		}

		echo "\t</tr>\n";
	}
}

echo '</table>',"\n";

if ( empty($data))
{
	echo '<h4 style="text-align:center;padding:20px 0px;">', \Lang::get('global.no_data'), '</h4>';
}

// deal with pagination

if ( ! empty($paginate) and count($paginate) > 1)
{
	echo '<div class="pagination">',"\n\t",'<table>',"\n";
	foreach($paginate as $page)
	{
		if ($page['type'] == 'current')
		{
			echo "\t\t",html_tag('td', array('class' => 'odd', 'style' => 'white-space:nowrap;'), $page['page']), "\n";
		}
		else
		{
			$options = array(
				'onclick' => 'location.href=\''.$baseurl.($page['page']==0?'':('/list/'.$page['page'])).'\'',
				'style' => 'cursor:pointer;cursor:hand;white-space:nowrap',
			);
			if ($page['type'] == 'first')
			{
				$icon = $theme->asset()->img('icons/tbl_paginate_first.png');
			}
			elseif ($page['type'] == 'last')
			{
				$icon = $theme->asset()->img('icons/tbl_paginate_last.png');
			}
			else
			{
				$icon = $page['page'];
			}
			echo "\t\t",html_tag('td', $options, $icon), "\n";
		}
	}
	echo "\t", '</table>', "\n", '</div>',"\n";
}

// widget buttons

if ( ! empty($buttons))
{
	echo '<div style="text-align:center;margin:20px 0px;">',"\n";
	echo \Form::open(array('onsubmit' => 'fuel_set_csrf_token(this)'));
	echo \Form::hidden('form_id', $form_id);
	echo \Form::hidden(\Config::get('security.csrf_token_key', 'fuel_csrf_token'), \Security::fetch_token());

	foreach($buttons as $name => $button)
	{
		echo \Form::submit('formbutton['.$name.']', $button['title'], array('class' => 'formbutton '.$button['class']));
	}

	echo \Form::close();
	echo '</div>',"\n";
}
