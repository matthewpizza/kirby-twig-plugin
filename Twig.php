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

	public function __construct() {
		$this->autoloader();
		$this->twig();
	}

	/**
	 * Require the autoloader
	 */
	private function autoloader() {
		if ( ! file_exists( kirby()->roots()->vendor() . '/autoload.php' ) ) {
			die( 'Composer autoload does not exist.' );
		}
		require_once( kirby()->roots()->vendor() . '/autoload.php' );
	}

	/**
	 * Load Twig
	 */
	private function twig() {
		$loader = new Twig_Loader_Filesystem( kirby()->roots()->twig() );
		$twig = new Twig_Environment( $loader, array(
			'debug' => c::get( 'debug' ),
		) );

		if ( c::get( 'debug' ) ) {
			$twig->addExtension( new Twig_Extension_Debug() );
		}

		tpl::set( 'twig', $twig );
	}

}