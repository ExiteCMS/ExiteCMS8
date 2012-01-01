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

class Theme extends \Fuel\Core\Theme
{
	/**
	 * @var  array  $active  Currently active theme
	 */
	protected $active = array(
		'name' => null,
		'path' => null,
		'asset_base' => false,
		'asset' => null,
		'info' => null,
	);

	/**
	 * @var  array  $fallback  Fallback theme
	 */
	protected $fallback = array(
		'name' => null,
		'path' => null,
		'asset_base' => false,
		'asset' => null,
		'info' => null,
	);

	/*
	 * @var	array	defined sections for the currently selected template
	 */
	protected $sections = array();

	/**
	 * @param   array  $config  Optional config override
	 * @return  void
	 */
	public function __construct(array $config = array())
	{
		\Config::load('theme', true, false, true);
		$config = array_merge(\Config::get('theme', false), $config);

		// we require the theme info file. always.
		$config['require_info_file'] = true;

		parent::__construct($config);

		// make sure we've got the parser loaded if view files are not html or php
		if ($this->config['view_ext'] != '.html' and $this->config['view_ext'] != '.php')
		{
			\Package::load('parser');
		}
	}

	/**
	 * Loads a view from the currently loaded theme.
	 *
	 * @param   string  $view         View name
	 * @param   array   $data         View data
	 * @param   bool    $auto_filter  Auto filter the view data
	 * @return  View    New View object
	 */
	public function view($view, $data = array(), $auto_filter = null)
	{
		$view = parent::view($view, $data, $auto_filter);

		// give the theme template access to the theme object
		$view->set('theme', $this, false);

		return $view;
	}

	/**
	 * Loads an asset from the currently active theme.
	 *
	 * @param   string  $path  Relative path to the asset
	 * @return  mixed  Full asset URL or path if outside docroot or the asset instance if no path is given
	 */
	public function asset($path = null)
	{
		if ($this->active['path'] === null)
		{
			throw new \ThemeException('You must set an active theme.');
		}

		if (is_null($path))
		{
			return $this->active['asset'];
		}
		else
		{
			if ($this->active['asset_base'])
			{
				return $this->active['asset_base'].$path;
			}

			return $this->active['path'].$path;
		}
	}

	/**
	 * Sets the currently active theme.  Will return the currently active
	 * theme.  It will throw a \ThemeException if it cannot locate the theme.
	 *
	 * @param   string  $theme  Theme name to set active
	 * @return  array   The theme array
	 * @throws  \ThemeException
	 */
	public function active($theme = null)
	{
		if ($theme !== null and $this->active['name'] != $theme)
		{
			// load the theme information
			$this->active = $this->create_theme_array($theme);

			// update the section definition for this theme
			$sections = $this->info('templates.default.sections');

			foreach (array_keys($sections) as $section)
			{

				isset($this->sections[$section]) or $this->sections[$section] = array();
			}
			foreach (array_keys($this->sections) as $section)
			{
				if ( ! isset($sections[$section]))
				{
					unset($this->sections[$section]);
				}
			}

			$this->active['asset'] = \Asset::instance('theme_active')->add_path(DOCROOT.'themes/'.$this->active['name']);
		}

		return $this->active;
	}

	/**
	 * Sets the currently fallback theme.  Will return the current fallback
	 * theme.  It will throw a \ThemeException if it cannot locate the theme.
	 *
	 * @param   string  $theme  Theme name to set fallback
	 * @return  array   The theme array
	 * @throws  \ThemeException
	 */
	public function fallback($theme = null)
	{
		if ($theme !== null and $this->fallback['name'] != $theme)
		{
			// load the theme information
			$this->fallback = $this->create_theme_array($theme);

			// update the section definition for this theme
			$sections = $this->info('templates.default.sections', null, $this->fallback['info']);

			foreach (array_keys($sections) as $section)
			{

				isset($this->sections[$section]) or $this->sections[$section] = array();
			}
			foreach (array_keys($this->sections) as $section)
			{
				if ( ! isset($sections[$section]))
				{
					unset($this->sections[$section]);
				}
			}

			$this->fallback['asset'] = \Asset::instance('theme_fallback')->add_path(DOCROOT.'themes/'.$this->fallback['name']);
		}

		return $this->fallback;
	}

	/**
	 * Returns the whole or part of the info array of a theme
	 *
	 * @param   string  $var      info variable in dot-notation, or null for the entire info array
	 * @param   array   $default  default value to return if $var does not exist
	 * @param   bool    $theme    theme the return info of. if null, use the active them. can also be a theme array
	 * @return  mixed  the result
	 */
	public function info($var = null, $default = null, $theme = null)
	{
		if ($theme === null and ($value = \Arr::get($this->active['info'], $var, null)) !== null)
		{
			return $value;
		}

		if ($theme !== null)
		{
			$info = is_array($theme) ? $theme : $this->all_info($theme);
			return \Arr::get($info, $var, $default);
		}

		return $default;
	}

	/**
	 * Returns the whole or part of the sections array
	 *
	 * @param   string  $section  name of the section to return, or null for all sections
	 * @return  mixed  the result
	 */
	public function sections($section = null)
	{
		if (isset($this->sections[$section]))
		{
			return $this->sections[$section];
		}
		else
		{
			return is_null($section) ? $this->sections : null;
		}
	}

	/**
	 * Returns the stored content of a widget section
	 *
	 * If defined, widget and section chrome templates will be applied
	 *
	 * @param   string  $section  name of the section whose content should be returned
	 * @return  mixed  the result
	 */
	public function widgets($section, $error = true)
	{
		$output = '';

		if (isset($this->sections[$section]))
		{
			$info = $this->info('templates.default.sections.'.$section);

			foreach ($this->sections[$section] as $data)
			{
				if ( ! empty($info['chrome']['widget']))
				{
					$output .= \View::forge($this->find_file('chrome'.DS.$info['chrome']['widget']), $data, false)->render();
				}
				else
				{
					$output .= (string) $data['_content_'];
				}
			}

			if ( ! empty($info['chrome']['section']))
			{
				$output = \View::forge($this->find_file('chrome'.DS.$info['chrome']['section']), array('_content_' => $output), false)->render();
			}
		}
		else
		{
			if ( ! empty($error))
			{
				throw new \ThemeException('Undefined widget section: "'.$section.'". Verify your the section definition for template "'.$this->active['name'].'" in your theme.info file');
			}
		}

		return $output;
	}

	/**
	 * Add the content of a widget to a section
	 *
	 * @param   string  $section  name of the section to which the content should be added
	 * @param   mixed  $content  the actual content. can be a string, View or Viewmodel
	 * @param   array  $data     data to be added to the content in case of a View or Viewmodel
	 * @return  void
	 */
	public function add_widget($section, $content, Array $data = array())
	{
		if (isset($this->sections[$section]))
		{
			$this->sections[$section][] = array('_content_' => $content, 'data' => $data);
		}
	}

	/**
	 * Checks if an section has widgets, and return the count
	 *
	 * @param   string  $section  name of the section to which the content should be added
	 * @return  mixed  the number of widgets defined, or false if the section does not exist
	 */
	public function has_widgets($section = '')
	{
		return (isset($this->sections[$section])) ? count($this->sections[$section]) : false;
	}

	/**
	 * Count the number of defined widgets in the given section(s)
	 *
	 * @param   mixed  $section  name of the section or array of sections whose widgets should be counted
	 * @return  mixed  the number of widgets defined
	 */
	/*
	 *
	 */
	public function widget_count($sections = '')
	{
		is_array($sections) or $sections = array($sections);

		$count = 0;

		foreach ($sections as $section)
		{
			isset($this->sections[$section]) and $count += count($this->sections[$section]);
		}

		return $count;
	}

	/**
	 * Creates a theme array by locating the given theme and setting all of the
	 * option.  It will throw a \ThemeException if it cannot locate the theme.
	 *
	 * @param   string  $theme  Theme name to set active
	 * @return  array   The theme array
	 * @throws  \ThemeException
	 */
	protected function create_theme_array($theme)
	{
		$theme = parent::create_theme_array($theme);

		// validate the info array
		isset($theme['info']['system']) or $theme['info']['system'] = false;

		if ( ! isset($theme['info']['details']))
		{
			throw new \ThemeException(sprintf('Info file for theme "%s" is missing the required "details" section.', $theme['name']));
		}

		if ( ! isset($theme['info']['templates']))
		{
			throw new \ThemeException(sprintf('Info file for theme "%s" is missing the required "templates" section.', $theme['name']));
		}

		foreach($theme['info']['templates'] as $name => &$template)
		{
			// make sure required entries exist
			isset($template['description']) or $template['description'] = '';
			isset($template['options']) or $template['options'] = array();
			isset($template['sections']) or $template['sections'] = array();

			// merge the global properties with the section definitions
			if (isset($template['properties']))
			{
				foreach($template['sections'] as $name => $section)
				{
					$template['sections'][$name] = \Arr::merge($template['properties'], $section);
				}
				unset($template['properties']);
			}
		}

		return $theme;
	}
}
