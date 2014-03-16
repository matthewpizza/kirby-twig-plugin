<?php

namespace Kirby\Plugin;

use c;
use tpl;
use Twig_Loader_Filesystem;
use Twig_Environment;
use Twig_Extension_Debug;

/**
 * A Twig <http://twig.sensiolabs.org/> plugin for Kirby <http://getkirby.com/>
 * @author Matthew Spencer <http://matthewspencer.me/>
 * @version 0.1
 */
class Twig {

	var $rootVendor;
	var $rootTwig;

	public function __construct($params=array()) {
		$this->rootVendor = c::get('root.vendor');
		$this->rootTwig = c::get('root.twig');

		$this->autoloader();
		$this->twig();
	}

	/**
	 * Require the autoloader
	 */
	private function autoloader() {
		if ( ! file_exists($this->rootVendor . '/autoload.php') ) {
			die('Composer autoload does not exist.');
		}
		require_once($this->rootVendor . '/autoload.php');
	}

	/**
	 * Load Twig
	 */
	private function twig() {
		$loader = new Twig_Loader_Filesystem($this->rootTwig);
		$twig = new Twig_Environment($loader, array(
			'debug' => c::get('debug'),
		));

		if ( c::get('debug') ) {
			$twig->addExtension(new Twig_Extension_Debug());
		}

		tpl::set('twig', $twig);
	}

}
return new Twig();