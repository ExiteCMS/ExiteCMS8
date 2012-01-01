<?php

/**
 * ExiteCMS Bootstrap Controller.
 *
 * @package  app
 * @extends  Controller
 */
class Controller_Bootstrap extends Controller
{
	/**
	 * @access  public
	 * @return  Response
	 */
	public function router()
	{
		$segments = Uri::segments();
		isset($segments[0]) or $segments[0] = null;

		// for now, call our test controller so we can test core functionality
		$test = new Controller_Test($this->request, $this->response);

		switch ($segments[0])
		{
			// theme class and asset loading tests
			case "theme":
				return $test->theme();

			default:
				throw new HttpNotFoundException('No test method requested');
		}
	}
}
