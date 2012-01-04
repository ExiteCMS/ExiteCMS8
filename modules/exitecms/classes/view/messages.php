<?php
namespace ExiteCMS;

class View_Messages extends \ViewModel {

	protected $_view = 'messages';

	/**
	 * The default view method
	 * Should set all expected variables upon itself
	 */
	public function view()
	{
		// fetch all stored messages
		$this->messages = \ExiteCMS\Core\Messages::get();

		// make the theme accessable
		$this->theme = \Theme::instance();

	}
}

/* End of file show.php */
