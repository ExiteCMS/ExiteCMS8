<?php
/**
 * Part of the Fuel framework.
 *
 * @package    Fuel
 * @version    1.0
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2011 Fuel Development Team
 * @link       http://fuelphp.com
 */


return array(

	/*
	 * default forms layout
	 */
	'default' => array(
		'prep_value'            => true,
		'auto_id'               => true,
		'auto_id_prefix'        => 'default_',
		'form_method'           => 'post',
		'form_template'         => "<fieldset>\n\t<legend>{legend}</legend>\n\t<div class='info'>{info}\n\t</div>\n</fieldset>\n\t\t{open}\n\t\t<table>\n\t\t<tr><th colspan='2'>{header}</th></tr>\n\t\t<tr><td colspan='2' class='spacer'></td></tr>\n{fields}\n\t\t</table>\n\t\t<div style='text-align:center;margin:20px 0px;'>\n\t\t\t{buttons}\n\t\t</div>\n{close}\n",
		'fieldset_template'     => "\n\t\t<tr><td colspan=\"2\">{open}<table>\n{fields}</table></td></tr>\n\t\t{close}\n",
		'field_template'        => "\t\t<tr>\n\t\t\t<td class=\"{error_class} odd label\">{label}{required}</td>\n\t\t\t<td class=\"{error_class}\">{field} {help_text} {error_msg}</td>\n\t\t</tr>\n",
		'multi_field_template'  => "\t\t<tr>\n\t\t\t<td class=\"{error_class} odd label\">{group_label}{required}</td>\n\t\t\t<td class=\"{error_class}\">{fields}\n\t\t\t\t{field} {label}\n{fields}{help_text}\t\t\t{error_msg}\n\t\t\t</td>\n\t\t</tr>\n",
		'error_template'        => '<span>{error_msg}</span>',
		'required_mark'         => '*',
		'inline_errors'         => false,
		'error_class'           => 'validation_error',
		'help_text'             => Theme::instance()->asset()->img('form_help.png', array('title' => '{help_text}', 'class' => 'tooltip', 'style' => 'padding-left:5px;', 'alt' => '')),
	),
);
