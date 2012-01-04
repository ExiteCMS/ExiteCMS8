<?php
/**
 * Fuel
 *
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package		Fuel
 * @version		1.0
 * @author		Harro "WanWizard" Verton
 * @license		MIT License
 * @copyright	2010 - 2011 Fuel Development Team
 * @link		http://fuelphp.com
 */

return array(
	/**
	 * global configuration
	*/

	// set it to false to prevent the static session from auto-initializing, know that it might make your session
	// expire sooner because it's not updated when it's not used. note that auto-initializing always loads the default driver
	'auto_initialize'	=> true,

	// if no session type is requested, use the default
	'driver'			=> 'db',

	// check for an IP address match after loading the cookie (optional, default = false)
	'match_ip'			=> false,

	// check for a user agent match after loading the cookie (optional, default = true)
	'match_ua'			=> true,

	// cookie domain  (optional, default = '')
	'cookie_domain' 	=> '',

	// cookie path  (optional, default = '/')
	'cookie_path'		=> '/',

	// cookie http_only flag  (optional, default = use the cookie class default)
	'cookie_http_only'	=> true,

	// if true, the session expires when the browser is closed (optional, default = false)
	'expire_on_close'	=> true,

	// session expiration time, <= 0 means 2 years! (optional, default = 2 hours)
	'expiration_time'	=> 7200,

	// session ID rotation time  (optional, default = 300)
	'rotation_time'		=> 300,

	// default ID for flash variables  (optional, default = 'flash')
	'flash_id'			=> 'flash',

	// if false, expire flash values only after it's used  (optional, default = true)
	'flash_auto_expire'	=> true,

	// for requests that don't support cookies (i.e. flash), use this POST variable to pass the cookie to the session driver
	'post_cookie_name'	=> '',

	/**
	 * specific driver configurations. to override a global setting, just add it to the driver config with a different value
	*/

	// special configuration settings for cookie based sessions
	'cookie'			=> array(
		'cookie_name'		=> 'fuelcid',				// name of the session cookie for cookie based sessions
						),

	// specific configuration settings for file based sessions
	'file'				=> array(
		'cookie_name'		=> 'fuelfid',				// name of the session cookie for file based sessions
		'path'				=>	'/tmp',					// path where the session files should be stored
		'gc_probability'	=>	5						// probability % (between 0 and 100) for garbage collection
						),

	// specific configuration settings for memcached based sessions
	'memcached'			=> array(
		'cookie_name'		=> 'fuelmid',				// name of the session cookie for memcached based sessions
		'servers'			=> array(					// array of servers and portnumbers that run the memcached service
								array('host' => '127.0.0.1', 'port' => 11211, 'weight' => 100)
							),
						),

	// specific configuration settings for database based sessions
	'db'			=> array(
		'cookie_name'		=> 'fueldid',					// name of the session cookie for database based sessions
		'database'			=> Config::get('db.active'),	// name of the database name (as configured in config/db.php)
		'table'				=> 'sessions',					// name of the sessions table
		'gc_probability'	=> 5							// probability % (between 0 and 100) for garbage collection
						),

	// specific configuration settings for redis based sessions
	'redis'			=> array(
		'cookie_name'		=> 'fuelrid',				// name of the session cookie for redis based sessions
		'database'			=> 'default'				// name of the redis database to use (as configured in config/db.php)
						)
);

/* End of file config/session.php */