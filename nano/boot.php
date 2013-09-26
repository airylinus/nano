<?php 

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

namespace Nano;

/**
 * Check php version
 */
if(version_compare(PHP_VERSION, '5.3') < 0) {
	echo 'We need PHP 5.3 or higher, you are running ' . PHP_VERSION;
	exit;
}

/**
 * Register Globals Fix
 */
if(ini_get('register_globals')) {
	$sg = array($_REQUEST, $_SERVER, $_FILES);

	if(isset($_SESSION)) {
		array_unshift($sg, $_SESSION);
	}

	foreach($sg as $global) {
		foreach(array_keys($global) as $key) {
			unset(${$key});
		}
	}
}

/**
 * Magic Quotes Fix
 */
if(get_magic_quotes_gpc()) {
	$gpc = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);

	array_walk_recursive($gpc, function(&$value) {
		$value = stripslashes($value);
	});
}

/**
 * Include base classes and functions
 */
require NANO . '/helpers.php';
require NANO . '/error.php';
require NANO . '/arr.php';
require NANO . '/config.php';
require NANO . '/autoloader.php';

/**
 * Register the autoloader
 */
Autoloader::register();

// set the base path to search
Autoloader::directory(ROOT);

// map application aliases to autoloader so we dont
// have to fully specify the class namespaces each time.
Autoloader::$aliases = Config::get('aliases', array());

/**
 * Error handling
 */
Error::register();