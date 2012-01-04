<?php
/**
 * ExiteCMS
 *
 * ExiteCMS is web application framework, based on the Fuel PHP Framework
 *
 * @package		ExiteCMS
 * @version		8.0
 * @author		ExiteCMS Development Team
 * @license		Creative Commons BY-NC-ND-3.0
 * @copyright	2011 ExiteCMS Development Team
 * @link		http://www.exitecms.org
 */

namespace ExiteCMS;

class Controller_Messages extends \Controller {

	/*
	 * @var	string	default action
	 */
	public $method = 'index';

	/**
	 * action: return any messages to display
	 *
	 * @access	public
	 * @return	void
	 */
	public function action_index()
	{
		// load the messages viewmodel
		return \ViewModel::forge('messages');
	}

}
/* End of file messages.php */
