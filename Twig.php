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
 * @version 0.2
 */
class Twig {

	var $kirby;

	public function __construct() {
		$this->kirby = kirby();

		$this->autoloader();
		$this->twig();
	}

	/**
	 * Require the autoloader
	 */
	private function autoloader() {
		if ( ! file_exists( $this->kirby->roots()->vendor() . '/autoload.php' ) ) {
			die( 'Composer autoload does not exist.' );
		}
		require_once( $this->kirby->roots()->vendor() . '/autoload.php' );
	}

	/**
	 * Load Twig
	 */
	private function twig() {
		$loader = new Twig_Loader_Filesystem( $this->kirby->roots()->twig() );
		$twig = new Twig_Environment( $loader, array(
			'debug' => c::get( 'debug' ),
		) );

		if ( c::get( 'debug' ) ) {
			$twig->addExtension( new Twig_Extension_Debug() );
		}

		tpl::set( 'twig', $twig );
	}

}