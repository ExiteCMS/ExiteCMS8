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

class View extends Fuel\Core\View
{
	/*
	 */
	public function __construct($file = null, $data = null, $filter = null)
	{
		parent::__construct($file, $data, $filter);
		$this->set('theme', \Theme::instance(), false);
	}

	public function set_filename($file)
	{
		parent::set_filename($file);
		$this->set('form_id', $this->hash());

		return $this;
	}

	public function hash()
	{
		return md5($this->file_name);
	}
}
