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

define('START_TIME', microtime(true));
define('DS', DIRECTORY_SEPARATOR);
define('ENV', getenv('APP_ENV'));

define('ROOT', __DIR__ . DS);
define('APP', ROOT . 'app' . DS);
define('NANO', ROOT . 'nano' . DS);
define('EXT', '.php');

require NANO . 'start.php';
