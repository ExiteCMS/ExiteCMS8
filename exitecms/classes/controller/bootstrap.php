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
	}

	/**
	 * @access  public
	 * @return  Response
	 */
	public function router()
	{
		// get the first URI segment
		$segments = Uri::segments();
		isset($segments[0]) or $segments[0] = null;

		// for now, call our test controller so we can test core functionality
		$test = new Controller_Test($this->request, $this->response);
		if (method_exists($test, $segments[0]))
		{
			return $test->{$segments[0]}();
		}
		else
		{
			throw new HttpNotFoundException('No test method requested or method not found');
		}
	}
}
