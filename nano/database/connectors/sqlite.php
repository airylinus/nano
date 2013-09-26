<?php namespace Nano\Database\Connectors;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

use PDO;
use Nano\Database\Connector;

class Sqlite extends Connector {

	/**
	 * The sqlite wrapper
	 *
	 * @var string
	 */
	public $wrapper = '[%s]';

	/**
	 * Create a new sqlite connector
	 *
	 * @param array
	 */
	protected function connect($config) {
		extract($config);

		$dns = 'sqlite:' . $database;
		return new PDO($dns);
	}

}