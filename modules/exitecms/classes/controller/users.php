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

class Controller_Users extends \ExiteCMS\Core\Forms
{

	/*
	 * @var	string	default action
	 */
	protected $action = 'list';

	/**
	 * @var	mixed	pagination settings
	 */
	protected $paginate = array(
		'items' => 10,
		'pages' => 3
	);

	/**
	 * @var	mixed	default list sort order
	 */
	protected $model_options = array(
		'order' => array(
			'id' => 'ASC',
		),
	);

	// -----------------------------------------------------------------
	// controller constructor
	// -----------------------------------------------------------------

	/*
	 */
	public function __construct(\Request $request, \Response $response)
	{
		// define this form controller's model
		$this->model = Model_User::forge();

		parent::__construct($request, $response);
	}

	/*
	 * List action: There is no tree action for Users
	 */
	public function action_tree()
	{
		$this->invalid_action();
	}

	/*
	 * List action: show a paginated list of defined users
	 */
	public function action_list()
	{
		// do the preparations for the list
		$result = parent::action_list();

		// define the list headers structure
		$this->view->set('headers', array(
			'name' => array(
				'title' => \Lang::get('field.name'),
			),
			'email' => array(
				'title' => \Lang::get('field.email'),
			),
			'joined' => array(
				'title' => \Lang::get('field.joined'),
			),
			'options' => array(
				'title' => \Lang::get('field.actions'),
				'options' => array(
					'style' => 'width:0px; white-space:nowrap; text-align:center;',
				),
			),
		));

		// initialize the data array
		$data = array();

		// add the data to the view
		if ($result)
		{
			// loop through the records found
			foreach($result as $record)
			{
				$data[] = array(
					'name' => array(
						'value' => $record->name
					),
					'email' => array(
						'value' => $record->email
					),
					'joined' => array(
						'value' => strftime(\Config::get('exitecms.datetime.shortdate'), $record->joined)
					),
					'options' => array(
						'options' => array(
							'style' => 'width: 0px;white-space:nowrap;',
						),
						'values' => array(
							array(
								'icon' => 'edit',
								'title' => \Lang::get('icon.edit'),
								'confirm' => false,
								'enabled' => true,
								'url' => $this->baseurl.'/edit/'.$record->id,
							),
							array(
								'icon' => 'delete',
								'title' => \Lang::get('icon.delete'),
								'confirm' => false,
								'enabled' => $record->id != 1,
								'url' => $this->baseurl.'/delete/'.$record->id,
							)
						)
					)
				);
			}

			$this->view->set('data', $data);
		}
	}
}
