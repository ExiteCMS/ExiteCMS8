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

class Util
{
	/*
	 * @var	string	segment string for the current page request
	 */
	protected static $segments = null;

	/*
	 * @var	string	prefix URI prefix after site aliasing
	 */
	protected static $prefix = null;

	/*
	 * @var	string	prefix URI prefix after site aliasing
	 */
	protected static $baseurl = null;

	/**
	 * @param array
	 * @return void
	 */
	public static function set_segments($segments = array())
	{
		// *TODO*
		if (empty($segments))
		{
			static::$segments = array();
		}
		else
		{
			count($segments) % 2 !== 0 and $segments[] = null;
			static::$segments = \Arr::to_assoc($segments);
		}
	}

	/**
	 * @param string
	 * @return void
	 */
	public static function set_baseurl($baseurl = '')
	{
		static::$baseurl = \Input::protocol().'://'.\Input::server('http_host').'/' . $baseurl;
	}

	/**
	 * @return void
	 */
	public static function segments()
	{
		return static::$segments;
	}

	/**
	 * @param string
	 * @return void
	 */
	public static function baseurl($uri = null)
	{
		if (is_null($uri))
		{
			return static::$baseurl;
		}
		else
		{
			if (is_array($uri))
			{
				$temp = array();
				foreach ($uri as $key => $val)
				{
					if ( ! is_numeric($key))
					{
						$temp[] = $key;
					}
					$temp[] = $val;
				}
				$uri = implode('/', $temp);
			}

			return \Uri::create($uri);
		}
	}

	/**
	 * @param string
	 * @return void
	 */
	public static function prefix()
	{
		if (is_null(static::$prefix))
		{
			static::$prefix = '';
		}

		return static::$prefix;
	}

	/**
	 * saves all pending messages to session flash and redirect
	 *
	 * @param void
	 * @param string
	 * @return void
	 */
	public static function redirect($url = '', $method = 'location', $redirect_code = 302)
	{
		// save outstanding messages to flash
		\ExiteCMS\Core\Messages::to_flash();

		// make sure the url is fully qualified
		strpos($url, '::/') === false and $url = \Uri::create($url);

		// and redirect
		\Response::redirect($url, $method, $redirect_code);
	}

	/*
	 * TODO : has to move to a date or time class
	 */
	public function get_timezone($code, $timezones)
	{
		$timezone = '';
		foreach ($timezones as $key => $value)
		{
			if ($key == $code)
			{
				return $value;
			}
			elseif (is_array($value))
			{
				$timezone .= (empty($timezone) ? '' : '/') .  $key;
				$result = $this->get_timezone($code, $value);
				if ($result)
				{
					return $timezone . '/' . $result;
				}
				$timezone = '';
			}
		}

		return false;
	}

}
