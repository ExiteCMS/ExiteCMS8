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
$fieldset = Fieldset::forge('user')->set_config($formdata)->add_model($model)->populate($model, true);

// add our custom fields
$fieldset->add_after('password2', \Lang::get('field.password2'),array('help_text' => \Lang::get('help.password2')), array(), 'password');

// generate the form
echo $fieldset->build();
