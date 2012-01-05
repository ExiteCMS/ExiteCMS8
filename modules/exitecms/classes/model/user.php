<?php
/**
 * ExiteCMS
 *
 * ExiteCMS is web application framework, based on the Fuel PHP Framework
 *
 * @package		ExiteCMS
 * @version		8.0
 * @author		ExiteCMS Development Team
 * @license		Creative Commons BY-NC-ND-3.0
 * @copyright	2011 ExiteCMS Development Team
 * @link		http://www.exitecms.org
 */

namespace ExiteCMS;

class Model_User extends \Orm\Model
{

	/*
	 * @var	string	name of the table
	 */
	protected static $_table_name = 'users';

	/*
	 * @var	array	this models properties
	 */
	protected static $_properties = array (
	  'id' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'id',
		'default' => NULL,
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 1,
		'display' => '9',
		'comment' => '',
		'extra' => 'auto_increment',
		'key' => 'PRI',
		'privileges' => 'select,insert,update',
	  ),
	  'name' => array (
		'type' => 'string',
		'name' => 'name',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 2,
		'character_maximum_length' => '30',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'required' => true,
			'size' => 60,
		),
   	  ),
	  'fullname' => array (
		'type' => 'string',
		'name' => 'fullname',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 3,
		'character_maximum_length' => '50',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'required' => true,
			'size' => 60,
		),
	  ),
	  'password' => array (
		'type' => 'string',
		'name' => 'password',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 4,
		'character_maximum_length' => '32',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'email' => array (
		'type' => 'string',
		'name' => 'email',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 5,
		'character_maximum_length' => '100',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'required' => true,
			'size' => 60,
		),
	  ),
	  'location' => array (
		'type' => 'string',
		'name' => 'location',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 6,
		'character_maximum_length' => '50',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'size' => 60,
		),
	  ),
	  'web' => array (
		'type' => 'string',
		'name' => 'web',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 7,
		'character_maximum_length' => '50',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'size' => 60,
		),
	  ),
	  'birthdate' => array (
		'type' => 'string',
		'name' => 'birthdate',
		'default' => '0000-00-00',
		'data_type' => 'date',
		'null' => false,
		'ordinal_position' => 8,
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'gender' => array (
		'type' => 'string',
		'name' => 'gender',
		'default' => 'U',
		'data_type' => 'enum',
		'null' => false,
		'ordinal_position' => 9,
		'collation_name' => 'utf8_general_ci',
		'options' => array (
			  0 => 'M',
			  1 => 'F',
			  2 => 'U',
			),
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'type' => 'radio',
		),
	  ),
	  'forum_datestamp' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'forum_datestamp',
		'default' => '0',
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 10,
		'display' => '10',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'locale' => array (
		'type' => 'string',
		'name' => 'locale',
		'default' => 'en',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 11,
		'character_maximum_length' => '5',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'type' => 'select',
		),
	  ),
	  'auth' => array (
		'type' => 'string',
		'name' => 'auth',
		'default' => 'local',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 12,
		'character_maximum_length' => '25',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'timezone' => array (
		'type' => 'string',
		'name' => 'timezone',
		'default' => 'T405',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 13,
		'character_maximum_length' => '4',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'type' => 'select',
		),
	  ),
	  'country' => array (
		'type' => 'string',
		'name' => 'country',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 23,
		'character_maximum_length' => '2',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'type' => 'select',
		),
	  ),
	  'avatar' => array (
		'type' => 'string',
		'name' => 'avatar',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 14,
		'character_maximum_length' => '100',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'sig' => array (
		'type' => 'string',
		'character_maximum_length' => '65535',
		'name' => 'sig',
		'default' => '',
		'data_type' => 'text',
		'null' => false,
		'ordinal_position' => 15,
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'posts' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'posts',
		'default' => '0',
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 16,
		'display' => '9',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'joined' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'joined',
		'default' => '0',
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 17,
		'display' => '10',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
		'form' => array (
			'type' => false,
		),
	  ),
	  'lastvisit' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'lastvisit',
		'default' => '0',
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 18,
		'display' => '10',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'ip' => array (
		'type' => 'string',
		'name' => 'ip',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 19,
		'character_maximum_length' => '20',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'status' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '255',
		'name' => 'status',
		'default' => '0',
		'data_type' => 'tinyint unsigned',
		'null' => false,
		'ordinal_position' => 20,
		'display' => '1',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'ban_reason' => array (
		'type' => 'string',
		'character_maximum_length' => '255',
		'name' => 'ban_reason',
		'default' => '',
		'data_type' => 'tinytext',
		'null' => false,
		'ordinal_position' => 21,
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'ban_expire' => array (
		'type' => 'int',
		'min' => '0',
		'max' => '4294967295',
		'name' => 'ban_expire',
		'default' => '0',
		'data_type' => 'int unsigned',
		'null' => false,
		'ordinal_position' => 22,
		'display' => '10',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'datastore' => array (
		'type' => 'string',
		'character_maximum_length' => '65535',
		'name' => 'datastore',
		'default' => '',
		'data_type' => 'text',
		'null' => false,
		'ordinal_position' => 24,
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	  'password_salt' => array (
		'type' => 'string',
		'name' => 'password_salt',
		'default' => '',
		'data_type' => 'varchar',
		'null' => false,
		'ordinal_position' => 25,
		'character_maximum_length' => '32',
		'collation_name' => 'utf8_general_ci',
		'comment' => '',
		'extra' => '',
		'key' => '',
		'privileges' => 'select,insert,update',
	  ),
	);

	public static function _init()
	{
		// load the language file for this model
		\Lang::load('users');

		// load the countries by countrycode
		\Lang::load('countrycodes', 'countries');

		// load the timezones
		\Lang::load('timezones', 'timezones');

		// set the field labels
		foreach (\Lang::get('field') as $field => $value)
		{
			isset(static::$_properties[$field]) and static::$_properties[$field]['form']['label'] = $value;
		}

		// set the field help texts
		foreach (\Lang::get('help') as $field => $value)
		{
			isset(static::$_properties[$field]) and static::$_properties[$field]['form']['help_text'] = $value;
		}

		// hide all properties from the form that don't have a label
		foreach (static::$_properties as $field => &$value)
		{
			isset($value['form']['label']) or $value['form']['type'] = false;
		}

		// set the gender options
		static::$_properties['gender']['form']['options'] = \Lang::get('other.genderlist');

		// set the locale options
		static::$_properties['locale']['form']['options'] = \Config::get('exitecms.locales');

		// set the timezone options
		static::$_properties['timezone']['form']['options'] = \Lang::get('timezones');

		// set the country options
		static::$_properties['country']['form']['options'] = \Lang::get('countries');
	}

	public function populate(array $data = array())
	{
		// get the data
		empty($data) and $data = \Input::post();

		foreach ($data as $name => $value)
		{
			isset(static::$_properties[$name]) and $this->{$name} = $value;
		}
	}
}
