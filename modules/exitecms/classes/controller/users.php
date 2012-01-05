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

	/**
	 * @var	array	Defined form observers
	 */
	protected $observers = array(
		'hash_password' => array(
			'events' => array('before_save'),
		),
	);

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
		// do the preparations for the list form
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

	public function action_add()
	{
		// do the preparations for the add form
		parent::action_add();

		// add our custom fields to the form
		$this->view->set('custom_fields',
			array(
				array('name' => 'password1', 'label' => \Lang::get('field.password1'), 'attributes' => array('help_text' => \Lang::get('help.password1'), 'required' => true), 'rules' => array(), 'after' => 'name'),
				array('name' => 'password2', 'label' => \Lang::get('field.password2'), 'attributes' => array('help_text' => \Lang::get('help.password2'), 'required' => true), 'rules' => array(), 'after' => 'password1'),
			),
			false
		);
	}

	public function action_edit()
	{
		// do the preparations for the edit form
		parent::action_edit();

		// add our custom fields to the form
		$this->view->set('custom_fields',
			array(
				array('name' => 'password1', 'label' => \Lang::get('field.password1'), 'attributes' => array('help_text' => \Lang::get('help.password1'), 'required' => true), 'rules' => array(), 'after' => 'name'),
				array('name' => 'password2', 'label' => \Lang::get('field.password2'), 'attributes' => array('help_text' => \Lang::get('help.password2'), 'required' => true), 'rules' => array(), 'after' => 'password1'),
			),
			false
		);
	}

	public function action_delete()
	{
		// do the preparations for the delete form
		parent::action_delete();

		// set the form info block
		$this->view->set('info', \Lang::get('action.delete.info', array('name' => $this->model->name)), false);

	}

	/*
	 * Observer (before_save): Hash password
	 */
	 protected function hash_password()
	 {
		 $this->model->password = md5(md5(\Input('password1')));
	 }
}
