<?php 

/**
 * Aiki 2.
 *
 * LICENSE
 *
 * This source file is subject to the AGPL-3.0 license that is bundled
 * with this package in the file LICENSE.
 *
 * @author      Aikilab http://www.aikilab.com 
 * @copyright   (c) 2008-2011 Aiki Lab Pte Ltd
 * @license     http://www.fsf.org/licensing/licenses/agpl-3.0.html
 * @link        http://www.aikiframework.org
 * @category    Aiki
 * @package     Aiki
 * @filesource
 */




class Aiki2 {
	private $config;
	private $user;
	private $error;
	
	function __construct( $config=NULL, $user=NULL ){
		if ( !is_null($config) ){
			$this->config= $config;
		}
		
		if ( !is_null($user) ){
			$this->user= $user;
		}		
				
		$this->error = false;
		set_error_handler( array($this,"aikiError" ));
		ob_start();
	}
	
	function aikiError( $errno, $errstr ){
		if ($errno==1024) {	
			$this->error= "$errstr";
		} else {
			$this->error= "$errno: $errstr";
		}
		die();
	}
	
	function close(){
		$this->error= false;
	}
		
	function __destruct(){
		if ( $this->error ){			
			echo "aiki dies with:", $this->error;
		} else {			
			ob_flush();
		}
	}
		

	/** magic method that allowed on demand libs and extensions
	 *
	 * @return object loaded class or false
	 */
	public function __get ($name) {		
		if ( $name=='config') {
			return $this->config;
		}
		return $this->load($name);
	}
	
	/**
	 * Loads an aiki library.
	 *
	 * Attempts to load from class first *.php, then tries to load *.php
	 * from extensions, then finally  tries classname/classname.php.
	 *
	 * @param   string $class name of class to be loaded
	 * @global  string $AIKI_ROOT_DIR the full path to the Aiki root directory
	 * @return  mixed
	 */
	
	public function load($class) {
		
		if (isset($this->$class)) {
			return $this->$class;
		}
		
		$path      = dirname(__FILE__) ;
		$classFile = ucwords($class). ".php";
		
		// Try to load the class file in /libs, assets/extensions and
		// assets/extension/$class/$class.php
		if ( file_exists("$path/{$classFile}")) {
			require_once("$path/{$classFile}" );
		} else {

            $path = substr( $path,0,-5); // remove /libs from path;
			
			// filter extensions..
			$allowed = "," . $this->config->get("extensions_allowed", "ALL") . ",";
			// a tip..be sure "web" doesn't match "web2date".
			if ($allowed != ",ALL," && ( $allowed == ",NONE," || strpos($allowed, $class) === false) ) {
				return false;
			}

			// search in dirs
			$SearchIn = $this->config->get("extensions_dir", "assets/extensions");
			$loaded = false;
			foreach (explode(",", $SearchIn) as $dir) {			
				$dir = trim($dir, " \n\r");
				if (file_exists( "$path/$dir/{$classFile}")) {
					require_once( "$path/$dir/{$classFile}");
					$loaded= true;
					break;
				}
				if (file_exists("$path/$dir/$class/{$classFile}")) {
					require_once("$path/$dir/$class/{$classFile}");
					$loaded= true;
					break;
				}

			}
			if (!$loaded) {
				return false;
			}
		}

		$object = new $class( $this->config );
		$this->$class = $object;
		return $object;
	}

				
} 










