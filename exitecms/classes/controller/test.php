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
		Theme::instance()->add_widget('content', 'THIS IS STATIC CONTENT!', array('title' => 'title'));
		Theme::instance()->add_widget('messages', 'THIS IS A MESSAGE!', array('title' => 'title'));

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
		$content = \Request::forge('phpinfo/phpinfo/index', false)->execute()->response->body();
		Theme::instance()->add_widget('content', $content);

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
		Theme::instance()->add_widget('content', $content);

		// return the loaded theme template
		return \Response::forge(
			Theme::instance()
			->view('templates/default')
			->set('title', 'dashboard module test')
		);
	}
}
