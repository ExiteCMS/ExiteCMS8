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

class Forms extends \Controller
{

	/**
	 * @var	string	this objects baseurl
	 */
	protected $baseurl = '';

	/**
	 * @var	string	the database model object used for the form
	 */
	protected $model = null;

	// options to be based to the query (usually sort options)
	protected $model_options = null;

	/**
	 * @var	string	the action's view object
	 */
	protected $view = null;

	/**
	 * @var	string	data to pass on to the widget
	 */
	protected $widget = array();

	/**
	 * @var	string	the default action
	 */
	protected $action = 'index';

	/**
	 * @var	array	Holds the object URI parameters
	 */
	protected $uri_params = array();

	/**
	 * @var	mixed	Number of lines per table, or false if no pagination is needed
	 */
	protected $paginate = false;

	/**
	 * Forms constructor
	 *
	 * @access	public
	 * @return	void
	 */
	public function __construct(\Request $request, \Response $response)
	{
		// call the controller constructor
		parent::__construct($request, $response);

		// load the form definition
		\Config::load('forms', true);

		// load the generic forms language file
		\Lang::load('forms');

		// load this class' language file
		\Lang::load(strtolower(str_replace('_', '/', ltrim(strrchr(get_class($this), '_'), '_'))));

		// fetch the module's URI parameters
		$this->uri_params = \ExiteCMS\Core\Util::segments();

		// if any parameters are present, the first key doubles as the action
		if ( ! empty($this->uri_params))
		{
			$this->action = key($this->uri_params);
		}

		// fetch the module's base url
		$this->baseurl = \ExiteCMS\Core\Util::baseurl();
	}

	/**
	 * Capture the requested action so we can process it
	 *
	 * @access	public
	 * @return	void
	 */
	public function router($method)
	{
		// process the formbutton first
		if (isset($_POST['formbutton']) and method_exists($this, 'button_'.key($_POST['formbutton'])))
		{
			$this->{'button_'.key($_POST['formbutton'])}();
		}

		// bail out if the action does not exist
		if ( ! method_exists($this, 'action_'.$this->action))
		{
			\ExiteCMS\Core\Messages::set(\Lang::get('forms.not_a_valid_action', array('action' => $this->action)), 'E');
			$this->invalid_action();
		}
		else
		{
			try
			{
				// check if a view is disabled for this request
				if ($this->view === false)
				{
					// request has no output
					$this->view = '';
				}
				else
				{
					// create the view object for this forms method
					empty($this->view) and $this->view = 'forms'.DS.$this->action;

					if ( ! $this->view instanceOf \View and ! $this->view instanceOf \ViewModel)
					{
						try
						{
							$this->view = \View::forge($this->view);
						}
						catch (\FuelException $e)
						{
							// request has no output
							$this->view = '';
						}
					}
				}

				// add some system fields to it
				$this->view->set('baseurl', $this->baseurl, false);

			}
			catch (\Fuel_Exception $e)
			{
				throw new \ExiteCMS\Core\Exception('unable to locate the view: "'.$this->view.'".');
			}

			// call the action method
			$this->{'action_'.$this->action}();
		}

		return array(
			'widget' => $this->view,
			'data' => $this->widget
		);
	}

	/**
	 * Add data to the widget this controller generates
	 *
	 * @access	public
	 * @param	string
	 * @param	mixed
	 * @return	void
	 */
	public function widget_data($var, $value)
	{
		$this->widget[$var] = $value;
	}

	// -----------------------------------------------------------------
	// define the view if needed
	// -----------------------------------------------------------------
	protected function set_view(\View $view)
	{
		$this->view = $view;

	}

	// -----------------------------------------------------------------
	// access the URI's named parameters
	// -----------------------------------------------------------------
	protected function uri_param($name = null)
	{
		if (is_null($name))
		{
			return $this->uri_params;
		}
		elseif (array_key_exists($name, $this->uri_params))
		{
			return $this->uri_params[$name];
		}
		elseif (is_numeric($name))
		{
			$array = array_values($this->uri_params);
			return isset($array[--$name]) ? $array[$name] : null;
		}
		else
		{
			return null;
		}
	}

	// -----------------------------------------------------------------
	// default action methods
	// -----------------------------------------------------------------
	public function action_list()
	{
		// set the widget title
		$this->widget_data('title', \Lang::get('action.list.title'));

		// set the form info block
		$this->view->set('info', \Lang::get('action.list.info'), false);

		// buttons to be placed under the form
		$this->view->buttons = array(
			'add' => array(
				'title' => \Lang::get('button.add'),
				'class' => 'add'
			),
		);

		// do we want pagination?
		if ( ! empty($this->paginate))
		{
			// calculate the number of
			$records = $this->model->count($this->model_options);
			$pages = ceil($records / $this->paginate['items']);

			$recnbr = $this->uri_param(1);
			if ( ! empty($recnbr) and is_numeric($recnbr) and $recnbr >= 1)
			{
				$this->paginate['current'] = $recnbr;
				$this->model_options['offset'] = ($recnbr-1) * $this->paginate['items'];
				if ($this->model_options['offset'] > $records)
				{
					\ExiteCMS\Core\Messages::set(\Lang::get('forms.page_not_found'), 'E');
					\ExiteCMS\Core\Util::redirect($this->baseurl);
				}
			}
			else
			{
				$this->model_options['offset'] = 0;
				$this->paginate['current'] = 1;
			}
			$this->model_options['limit'] = $this->paginate['items'];

			// create the pagination array
			$this->view->paginate = array();
			if ($this->paginate['current'] - $this->paginate['pages'] > 1)
			{
				$this->view->paginate[] = array('page' => 0, 'type' => 'first');
			}
			for ($i = $this->paginate['current'] - $this->paginate['pages']; $i <= $this->paginate['current'] + $this->paginate['pages']; $i++)
			{
				if ($i > 0 && $i <= $pages)
				{
					$this->view->paginate[] = array('page' => $i, 'type' => $this->paginate['current'] == $i ? 'current' : '');
				}
			}
			if ($this->paginate['current'] + $this->paginate['pages'] < $pages)
			{
				$this->view->paginate[] = array('page' => $pages, 'type' => 'last');
			}
		}

		return $this->model->find('all', $this->model_options);
	}

	public function action_tree()
	{
		$this->invalid_action();
	}

	public function action_add()
	{
		if ($this->form_posted())
		{
			// populate the model from the post information
			$this->model->populate();

			// save the updated record
			if ($this->is_changed())
			{
				// save the updated record
				try
				{
					if ($this->model->save())
					{
						\ExiteCMS\Core\Messages::set(\Lang::get('action.add.success'), 'C');
					}
					else
					{
						\ExiteCMS\Core\Messages::set(\Lang::get('action.add.failure'), 'E');
					}
				}
				catch (\Orm\ValidationFailed $e)
				{
					\Debug::dump('FORM VALIDATION FAILED!', $e->getMessage());
					die();
				}
			}
			else
			{
				\ExiteCMS\Core\Messages::set(\Lang::get('forms.record_not_changed'), 'W');
			}

			\ExiteCMS\Core\Util::redirect($this->baseurl);
		}

		$this->view->set('model', $this->model);
	}

	public function action_edit()
	{
		// try to locate the requested record
		$this->model = $this->model->find($this->uri_param('edit'));

		// did we find it?
		if ($this->model)
		{
			if ($this->form_posted())
			{
				// populate the model from the post information
				$this->model->populate();

				// save the updated record
				if ($this->is_changed())
				{
					// save the updated record
					try
					{
						if ($this->model->save())
						{
							\ExiteCMS\Core\Messages::set(\Lang::get('action.edit.success'), 'C');
						}
						else
						{
							\ExiteCMS\Core\Messages::set(\Lang::get('action.edit.failure'), 'E');
						}
					}
					catch (\Orm\ValidationFailed $e)
					{
						\Debug::dump('FORM VALIDATION FAILED!', $e->getMessage());
						die();
					}
				}
				else
				{
					\ExiteCMS\Core\Messages::set(\Lang::get('forms.record_not_changed'), 'W');
				}

				\ExiteCMS\Core\Util::redirect($this->baseurl);
			}

			$this->view->set('model', $this->model);
		}
		else
		{
			\ExiteCMS\Core\Messages::set(\Lang::get('forms.record_not_found'), 'E');
			\ExiteCMS\Core\Util::redirect($this->baseurl);
		}
	}

	public function action_delete()
	{
		// try to locate the requested record
		$this->model = $this->model->find($this->uri_param('edit'));

		// did we find it?
		if ($this->model)
		{
			// set the widget title
			$this->widget_data('title', \Lang::get('action.delete.title'));

			// set the form info block
			$this->view->set('info', \Lang::get('action.delete.info'), false);

			// buttons to be placed under the table
			$this->view->buttons = array(
				'delete' => array(
					'title' => \Lang::get('global.delete'),
					'class' => 'positive'
				),
				'cancel' => array(
					'title' => \Lang::get('global.cancel'),
					'class' => 'negative'
				),
			);
		}
		else
		{
			\ExiteCMS\Core\Messages::set(\Lang::get('forms.record_not_found'), 'E');
			\ExiteCMS\Core\Util::redirect($this->baseurl);
		}
	}

	// -----------------------------------------------------------------
	// check for changes to the loaded model object
	// -----------------------------------------------------------------
	protected function is_changed()
	{
		return $this->model->is_changed();
	}

	// -----------------------------------------------------------------
	// deal with an invalid action
	// -----------------------------------------------------------------
	protected function invalid_action()
	{
		\ExiteCMS\Core\Util::redirect($this->baseurl);
	}

	// -----------------------------------------------------------------
	// Check if our form is posted
	// -----------------------------------------------------------------
	protected function form_posted($name = null)
	{
		// is this our form?
		$name = is_null($name) ? 'form_id' : $name;

		if ($name = \Input::post($name) and $name = $this->view->hash())
		{
			// validate the crsf token
			if ( ! \Security::check_token())
			{
				\ExiteCMS\Core\Messages::set(\Lang::get('global.form_expired'), 'E');
				\ExiteCMS\Core\Util::redirect(\Input::uri());
			}

			return true;
		}

		return false;
	}

	// -----------------------------------------------------------------
	// Default button processing methods
	// -----------------------------------------------------------------

	protected function button_add()
	{
		\ExiteCMS\Core\Util::redirect(\ExiteCMS\Core\Util::baseurl(array($this->baseurl, 'add' => 0)));
	}

	// -----------------------------------------------------------------

	protected function button_refresh()
	{
		// reset the form
		$_POST = array();
	}

	// -----------------------------------------------------------------

	protected function button_cancel()
	{
		\ExiteCMS\Core\Messages::set(\Lang::get('forms.action_canceled'), 'I');
		\ExiteCMS\Core\Util::redirect($this->baseurl);
	}
}
