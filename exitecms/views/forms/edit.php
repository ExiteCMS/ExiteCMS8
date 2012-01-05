<?php
// fetch the definition of this form
$formdata = \Config::get('forms.default');

// add a form header
$formdata['form_template'] = str_replace('{legend}', \Lang::get('global.information'), $formdata['form_template']);
$formdata['form_template'] = str_replace('{info}', \Lang::get('action.edit.info'), $formdata['form_template']);
$formdata['form_template'] = str_replace('{header}', \Lang::get('action.edit.form'), $formdata['form_template']);

// add buttons
$formdata['form_template'] = str_replace('{buttons}',
	Form::submit('formbutton[save]', \Lang::get('global.save'), array('id' => 'form_formbutton[save]', 'class' => 'formbutton positive')).
	Form::submit('formbutton[refresh]', \Lang::get('global.refresh'), array('id' => 'form_formbutton[refresh]', 'class' => 'formbutton', 'formnovalidate')).
	Form::submit('formbutton[cancel]', \Lang::get('global.cancel'), array('id' => 'form_formbutton[cancel]', 'class' => 'formbutton negative', 'formnovalidate')),
	$formdata['form_template']
);

// create the fieldset
$fieldset = Fieldset::forge('users')->set_config($formdata)->set_config(array('form_attributes' => array('onsubmit' => 'fuel_set_csrf_token(this)')))->add_model($model)->populate($model, true);

// add our custom fields to the fieldset
if (isset($custom_fields))
{
	foreach ($custom_fields as $field)
	{
		isset($field['before']) and $fieldset->add_before($field['name'], $field['label'], $field['attributes'], $field['rules'], $field['before']);
		isset($field['after']) and $fieldset->add_after($field['name'], $field['label'], $field['attributes'], $field['rules'], $field['after']);
	}
}

// add the form_id and the CSRF token to the form
isset($form_id) and	$fieldset->add('form_id', '', array('type' => 'hidden', 'value' => $form_id));
$fieldset->add(\Config::get('security.csrf_token_key', 'fuel_csrf_token'), '', array('type' => 'hidden', 'value' => \Security::fetch_token()));

// generate the form
echo $fieldset->build();
