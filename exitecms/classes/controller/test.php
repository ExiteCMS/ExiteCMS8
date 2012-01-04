<?php

/**
 * ExiteCMS
 *
 * ExiteCMS is a fast and lightweight web application framework.
 *
 * @package		ExiteCMS
 * @version		8.0
 * @author		ExiteCMS Development Team
 * @license		Open Software License v. 3.0
 * @copyright	2011-2012 ExiteCMS Development Team
 * @link		http://www.exitecms.org
 */
class Controller_Test extends Controller
{

	/**
	 * @access  public
	 * @return  Response
	 */
	public function theme()
	{
		// load a theme instance;
		Theme::instance();

		// add some dummy content
		Theme::instance()->section('messages', array('title' => 'title'));
		Theme::instance()->widget('messages', 'THIS IS A MESSAGE!', array('title' => 'title'));

		Theme::instance()->section('content', array('title' => 'title'));
		Theme::instance()->widget('content', '<p>THIS IS STATIC CONTENT!</p>', array('title' => 'title A'));
		Theme::instance()->widget('content', '<p>THIS IS MORE CONTENT!</p>', array('title' => 'title B'));

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'template rendering tests')
		);
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function phpinfo()
	{
		// load a theme instance;
		Theme::instance();

		// fetch the phpinfo data and add the content
		Theme::instance()->section('content', array('title' => 'title'));
		$content = \Request::forge('phpinfo/phpinfo/index', false)->execute()->response->body();
		Theme::instance()->widget('content', $content, array('title' => 'PHPINFO widget'));

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'phpinfo module test')
		);
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function dashboard()
	{
		// load a theme instance;
		Theme::instance();

		// fetch the phpinfo data and add the content
		$content = \Request::forge('exitecms/dashboard/index', false)->execute()->response->body();

		Theme::instance()->widget('content', $content['content'], $content['data']);

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'dashboard module test')
		);
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function users()
	{
		Fuel::add_module('exitecms');

		// load a theme instance
		Theme::instance();

		// create some window dressing
		Theme::instance()->widget('header-nav', '<ul><li><a href="">TEST</a></li><li><a href="">TEST</a></li><li><a href="">TEST</a></li></ul>');
		Theme::instance()->widget('main-nav', '<ul><li><a href="">TEST</a></li><li><a href="">TEST</a></li><li><a href="">TEST</a></li></ul>');

		// fetch the users list page and add it to our widget
		Theme::instance()->widget('content', \Request::forge('exitecms/users/index', false)->execute()->response->body());

		// add the message widget
		Theme::instance()->widget('messages', Request::forge('exitecms/messages/index', false)->execute()->response->body());

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'dashboard module test')
		);
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function fieldset()
	{
		Fuel::add_module('exitecms');

		// load the form definition
		Config::load('forms', true);

		// load a theme instance
		Theme::instance();

		// create some window dressing
		Theme::instance()->widget('header-nav', '<ul><li><a href="">TEST</a></li></ul>');
		Theme::instance()->widget('main-nav', '<ul><li><a href="">TEST</a></li></ul>');

		// fetch some user info, we need a model record
		$user = \Exitecms\Model_User::find('first');

		// fetch the definition of this form
		$formdata = \Config::get('forms.default');

		// add a form header
		$formdata['form_template'] = str_replace('{legend}', \Lang::get('global.information'), $formdata['form_template']);
		$formdata['form_template'] = str_replace('{info}', \Lang::get('action.edit.info'), $formdata['form_template']);
		$formdata['form_template'] = str_replace('{header}', \Lang::get('action.edit.form'), $formdata['form_template']);

		// add buttons
		$formdata['form_template'] = str_replace('{buttons}',
			Form::submit('formbutton[save]', \Lang::get('global.save'), array('id' => 'form_formbutton[save]', 'class' => 'formbutton positive')).
			Form::submit('formbutton[refresh]', \Lang::get('global.refresh'), array('id' => 'form_formbutton[refresh]', 'class' => 'formbutton')).
			Form::submit('formbutton[cancel]', \Lang::get('global.cancel'), array('id' => 'form_formbutton[cancel]', 'class' => 'formbutton negative')),
			$formdata['form_template']
		);

		// create the fieldset
		$fieldset = Fieldset::forge('user')->set_config($formdata)->add_model($user)->populate($user, true);

		// add our custom fields
		$fieldset->add_after('password2', \Lang::get('field.password2'),array('help_text' => \Lang::get('help.password2')), array(), 'password');

		// add the form
		Theme::instance()->widget('content', $fieldset->build(), array('title' => \Lang::get('action.edit.title')));

		// add the jQuery tooltips
		Theme::instance()->asset()->js('jquery.tipTip.minified.js', array(), 'footer');

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'dashboard module test')
		);
	}
}
