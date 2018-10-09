<?php

declare(strict_types=1);

/**
 * Autoloader class.
 * Every call to a class, helpers, ... not yet loaded will be
 * handled by this class and his autoLoad() function like coded
 * in the init() function:
 *
 * 		spl_autoload_register(__CLASS__ . '::autoLoad');
 *
 * Only once, in the index.php file f.i. add the two following lines
 * at the top of the file, during the initialization:
 *
 * 		require_once 'autoloader.php';
 *			$autoload = new ClassLoader();
 *
 * From now, it's no more needed to code require_once("....") for
 * loading classes or helpers. Just use it directly. If not yet loaded,
 * this Autoloader class will do it for us; once.
 *
 * Based on the work of SHAMIL CHOUDHURY
 * @link https://shamil.xyz/autoloading-classes-php-7/
 */

namespace MyApp;

define('DS', DIRECTORY_SEPARATOR);

class ClassLoader
{
	const UNABLE_TO_LOAD = 'Sorry, unable to load class %s';

	// Used to hold list of directories that may contain class files.
	protected static $dirs = [];

	// Check if the loader class has already been registered as autoloader.
	protected static $registered = 0;

	/**
	 * Initializes directories array
	 *
	 * @param array $dirs
	 */
	public function __construct(array $dirs = [])
	{
		self::init($dirs);
	}

	/**
	 * Adds a directory to the list of supported directories
	 * Also registers "autoload" as an autoloading method
	 *
	 * @param array | string $dirs
	 */
	public static function init(array $dirs = [])
	{
		if ($dirs) {
			self::addDirs($dirs);
		}
		if (self::$registered == 0) {
			spl_autoload_register(__CLASS__ . '::autoLoad');
			self::$registered++;
		}
	}

	/**
	 * Adds directories to the existing array of directories
	 *
	 * @param array | string $dirs
	 */
	public static function addDirs($dirs)
	{
		if (is_array($dirs)) {
			self::$dirs = array_merge(self::$dirs, $dirs);
		} else {
			self::$dirs[] = $dirs;
		}
	}

	/**
	 * Confirm or not if a string is starts with ...
	 *
	 * 	startsWith('Laravel', 'Lara') ==> true
	 *
	 * @link https://stackoverflow.com/a/834355/1065340

	 * @param  string  $string The string
	 * @param  string  $prefix The prefix to search
	 * @return boolean True when the string is ending with that prefix
	 */
	private static function startsWith(string $string, string $prefix) : bool
	{
		$length = strlen($prefix);

		return boolval(substr($string, 0, $length) === $prefix);
	}

	/**
	 * Locates a class file and load the file when found.
	 *
	 * @param  string  $class For instance MyApp\Helpers\HTML
	 * @return boolean
	 */
	public static function autoLoad($class) : bool
	{
		// When the class (f.i. MyApp\Helpers\HTML) is within the
		// same namespace of this class (MyApp), we need to search for
		// a folder caller "Helpers" and not "MyApp" then "Helpers"
		if (self::startsWith($class, __NAMESPACE__)) {
			$class = str_replace(__NAMESPACE__ . '\\', '', $class);
		}

		$success = false;

		// Get the filename. When the class is called Helpers\HTML,
		// the derived filename will be Helpers/HTML.php
		// Assume that the classname respect the naming standards
		$fileName = str_replace('\\', DS, $class) . '.php';

		foreach (self::$dirs as $start) {
			$file = $start . DS . $fileName;
			if (self::loadFile($file)) {
				$success = true;
				break;
			}
		}

		// Ouch, the file wasn't found.
		if (!$success) {
			if (!self::loadFile(__DIR__ . DS . $fileName)) {
				throw new \Exception(sprintf(self::UNABLE_TO_LOAD, $class));
			}
		}

		return $success;
	}

	/**
	 * Loads a file
	 *
	 * @param  string  $file
	 * @return boolean
	 */
	protected static function loadFile($file) : bool
	{
		if (file_exists($file)) {
			require_once $file;

			return true;
		}

		return false;
	}
}
