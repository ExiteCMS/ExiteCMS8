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

namespace Phpinfo;

class Controller_Phpinfo extends \Controller {

	/*
	 * @var	string	default action
	 */
	public $method = 'index';

	/**
	 * action: show PHP Info information
	 *
	 * @access	public
	 * @return	void
	 */
	public function action_index()
	{
		// load the phpinfo viewmodel
		return \ViewModel::forge('phpinfo');
	}
}
/* End of file phpinfo.php */
