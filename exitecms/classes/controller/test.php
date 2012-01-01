<?php

/**
 * The Test Controller.
 *
 * @package  app
 * @extends  Controller
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
			->set('title', 'This is the page title')
			->set('version', 8.0)
			->set('revision', 0)
			->set('build', 218)
		);
	}
}
