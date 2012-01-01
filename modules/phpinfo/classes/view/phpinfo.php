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

class View_Phpinfo extends \ViewModel {

	protected $_view = 'phpinfo';

	/**
	 * The default view method
	 * Should set all expected variables upon itself
	 */
	public function view()
	{
		// fetch the raw phpinfo() output and parse it into an array
		ob_start();
		phpinfo();
		$phpinfo = array('phpinfo' => array());
		if(preg_match_all('#(?:<h2>(?:<a name=".*?">)?(.*?)(?:</a>)?</h2>)|(?:<tr(?: class=".*?")?><t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>(?:<t[hd](?: class=".*?")?>(.*?)\s*</t[hd]>)?)?</tr>)#s', ob_get_clean(), $matches, PREG_SET_ORDER))
		{
			foreach($matches as $match)
			{
				if(strlen($match[1]))
				{
					$phpinfo[$match[1]] = array();
				}
				elseif(isset($match[3]))
				{
					$keys = array_keys($phpinfo);
					$phpinfo[end($keys)][$match[2]] = isset($match[4]) ? array($match[3], $match[4]) : $match[3];
				}
				else
				{
					$keys = array_keys($phpinfo);
					$phpinfo[end($keys)][] = $match[2];
				}
			}
		}

		// loop through the array, and determine the number of columns per section
		foreach($phpinfo as $name => $section)
		{
			$col2 = 2;
			foreach($section as $key => $val)
			{
				if ( is_array($val) )
				{
					foreach($val as $valkey => $valval)
					{
						// see if we need to shorten the string...
						$valln1 = explode(' ', $valval);
						$valln2 = '';
						foreach ($valln1 as $ln1)
						{
							if ( strlen($ln1) > 75 OR strpos($ln1, ' ') > 75)
							{
								$valln2 .= substr(trim($ln1), 0, 75).'...';
							}
							else
							{
								$valln2 .= ' '.$ln1;
							}
						}
						$phpinfo[$name][$key][$valkey] = $valln2;
					}
					$cols = 3;
					break;
				}
				elseif (! is_numeric($key))
				{
					// remove this unneeded column header
					if ( $key === 'Variable' && $val === 'Value' )
					{
						unset($phpinfo[$name][$key]);
					}
					else
					{
						// see if we need to shorten the string...
						$valln1 = explode(' ', $val);
						$valln2 = '';
						foreach ($valln1 as $ln1)
						{
							if ( strlen($ln1) > 75 OR strpos($ln1, ' ') > 75)
							{
								$valln2 .= substr(trim($ln1), 0, 75).'...<br />';
							}
							else
							{
								$valln2 .= ' '.$ln1;
							}
						}
						$phpinfo[$name][$key] = trim($valln2);
					}
					$cols = 2;
				}
				else
				{
					// nothing here
				}
			}
			$phpinfo[$name]['_cols'] = $cols;
		}

		// remove PHP and Zend images and links
		unset($phpinfo['phpinfo'][0]);
		unset($phpinfo['phpinfo'][1]);
		unset($phpinfo['mbstring'][0]);
		unset($phpinfo['Additional Modules'][0]);
		unset($phpinfo['PHP License']);

		// inject the current PHP version, phpinfo() doesn't give you this, odd enough
		$phpinfo['phpinfo'] = array('PHP Version' => phpversion()) + $phpinfo['phpinfo'];

		// assign it to the template
		$this->set('phpinfo', $phpinfo, false);
	}
}

/* End of file phpinfo.php */
