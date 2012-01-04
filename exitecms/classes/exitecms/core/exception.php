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

namespace ExiteCMS\Core;

class Exception extends \Exception {

	/**
	 * Process the custom error
	 *
	 * @return  void
	 */
	public function handle()
	{
		ob_end_clean();
		echo \View::forge('exception', array('exception' => $this), false);
	}
}
