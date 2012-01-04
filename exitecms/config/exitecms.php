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

/*
 * return the current exitecms configuration
 */
return array(
	'version'	=> '8.0',
	'revision'	=> '0',
	'locales'	=> array(
		'en' => 'English',
		'nl' => 'Nederlands',
		'fr' => 'Fran&ccedil;ais',
	),
	'install' =>
	array (
		'mail_hostname' => '',
		'mail_username' => '',
		'mail_password' => '',
		'layout_editor' => '0',
		'layout_listlength' => '5',
		'engine_suffix' => '.jsp',
		'engine_cache_timeout' => '0',
		'engine_compression' => '0',
		'engine_batch' => '0',
		'engine_profiler' => '0',
		'maint_mode' => '0',
		'maint_text' => '',
	),
	'security' =>
	array (
		'account_registration' => '0',
		'account_verify_email' => '1',
		'account_verify_admin' => '0',
		'account_webmasters' => '1',
		'login_https' => '0',
		'login_required' => '0',
		'login_no_access' => '0',
		'login_expiration' => '0',
		'account_logins' => '0',
		'account_no_access' => '0',
		'account_logging' => '0',
		'form_captcha' => '0',
		'encryption_seed' => 'sup3rs3Cr3tk3y564',
	),
	'locales' =>
	array (
		'language_default' => 'en',
		'language_detection' => '1',
		'server_timezone' => 'T405',
		'server_country' => 'us',
	),
	'datetime' =>
	array (
		'shortdate' => '%d/%m/%y',
		'longdate' => '%B %d %Y',
		'shorttime' => '%H:%M',
		'longtime' => '%H:%M:%S',
		'shortdatetime' => '%d/%m/%y %H:%M',
		'longdatetime' => '%B %d %Y %H:%M:%S',
	),
);
