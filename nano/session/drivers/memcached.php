<?php namespace Nano\Session\Drivers;

/**
 * Nano
 *
 * Just another php framework
 *
 * @package		nano
 * @link		http://madebykieron.co.uk
 * @copyright	http://unlicense.org/
 */

use Memcached as M;
use Nano\Config;
use Nano\Session\Driver;

class Memcached extends Driver {

	private $key;

	public $server;

	public function __construct($config) {
		$this->config = $config;
		$this->key = Config::app('key');

		// setup the memcache server
		extract(Config::cache('memcached'));

		$this->server = new M;
		$this->server->addServer($host, $port);
	}

	public function read($id) {
		if($data = $this->server->get($this->key . '_' . $id)) {
			return unserialize($data);
		}
	}

	public function write($id, $cargo) {
		extract($this->config);

		// if the session is set to never expire
		// we will set it to 1 year
		if($lifetime == 0) {
			$lifetime = (3600 * 24 * 365);
		}

		$this->server->set($this->key . '_' . $id, serialize($cargo), $lifetime);
	}

}