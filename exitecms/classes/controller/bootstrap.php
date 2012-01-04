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
class Controller_Bootstrap extends Controller
{
	/**
	 * @access  public
	 * @return  void
	 */
	public function __construct(\Request $request, \Response $response)
	{
		parent::__construct($request, $response);

		// load the exitecms configuration
		\Config::load('exitecms', true);

		// global language files
		\Lang::load('global');
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function router()
	{
		// start the session
		$session = \Session::forge();

		// get the current flash_id and set it to exitecms
		$fk = $session->get_flash_id();
		$session->set_flash_id('exitecms');

		// do we have any messages in flash?
		$messages = $session->get_flash('messages');

		// if there were any stored, add them to the messages array
		if ( is_array($messages) )
		{
			// restore the messages
			foreach($messages as $message)
			{
				\ExiteCMS\Core\Messages::set($message['message'], $message['type']);
			}
		}

		// restore the original flash_id
		$session->set_flash_id($fk);

		//
		// TEST CODE BELOW !
		//

		// get the first URI segment
		$segments = \Uri::segments();
		$controller = array_shift($segments);

		\ExiteCMS\Core\Util::set_baseurl($controller);

		\ExiteCMS\Core\Util::set_segments($segments);

		// for now, call our test controller so we can test core functionality
		$test = new \Controller_Test($this->request, $this->response);
		if (method_exists($test, $controller))
		{
			return $test->{$controller}();
		}
		else
		{
			throw new \ExiteCMS\Core\Exception('No test method requested or method not found');
		}
	}
}
