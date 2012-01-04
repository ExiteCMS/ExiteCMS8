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

namespace ExiteCMS;

class Controller_Dashboard extends \ExiteCMS\Core\Forms {

	/**
	 * @var	string	the action's view object
	 */
	protected $view = 'forms/dashboard';

	/**
	 * constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct(\Request $request, \Response $response)
	{
		$this->model = Model_User::forge();

		parent::__construct($request, $response);
	}

	/**
	 * action: index - show the dashboard (default action)
	 *
	 * @access	public
	 * @return	Reponse
	 */
	public function action_index()
	{
		// set the widget title
		$this->widget_data('title', \Lang::get('title.index'));

		// load the SimplePie package
		\Package::load('simplepie');

		// fetch the news feed from the exitecms website
		$feed = new \Simplepie\Factory();
//		$feed->set_feed_url('http://datamapper.wanwizard.eu/rss.xml');
		$feed->set_feed_url('http://www.exitecms.org/rss.xml');
		$feed->set_cache_location('/tmp');
		$feed->init() and $this->view->set('news', $feed->get_items(), false);

		// fetch the user information
		$this->view->users = array(
			'usercount' => $this->model->count(),
			'useractive' => $this->model->count(array('where' => array(array('status','=','0')))),
			'userinactive' => $this->model->count(array('where' => array(array('status','=','1')))),
			'userwaiting' => $this->model->count(array('where' => array(array('status','=','2')))),
			'userdeleted' => $this->model->count(array('where' => array(array('status','=','3')))),
			'usersystem' => $this->model->count(array('where' => array(array('status','=','4')))),
			'userexternal' => $this->model->count(array('where' => array(array('status','=','5')))),
		);

		// *TODO*: fetch the released version status
		$status = true ? \Lang::get('info.status_ok') : \Lang::get('info.status_nok');

		// get the current released revision level
		$this->view->update = true ? \Lang::get('info.current') : \Lang::get('info.update');

		// *TODO*: fetch the exitecms information
		$this->view->set('exitecms',
			\Lang::get('info.exitecms',
				array(
					'version' => \Config::get('exitecms.version', '?'),
					'revision' => \Config::get('exitecms.revision', '?'),
					'websites' => 1, //$sites = Model_Site::count(),
					'pages' => 1, //Model_Page::count() - $sites,	// remove the root nodes from the count
					'update' => $status
				)
			),
			false
		);

		// get the DB type used
		$db = \Config::get('db');
		$db = strtoupper($db[$db['active']]['type']);

		// get the DB version
		$dbversion = 'unknown';
		switch ($db)
		{
			case "MYSQL":
			case "MYSQLI":
				if ($dbversion = \DB::query('SELECT VERSION() AS VERSION')->execute())
				{
					$dbversion = $dbversion[0]['VERSION'];
				}
			break;
		}
		// fetch the platform information
		$this->view->platform = array(
			'server' => $_SERVER['SERVER_SOFTWARE'],
			'db' => $db,
			'php' => phpversion(),
			'dbversion' => $dbversion,
			'fuel' => \Fuel::VERSION,
		);
	}

}
