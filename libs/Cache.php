<?php 

class Cache {
	
	private $start;
	private $debug;
	private $caches;

	public function __construct( $config ) {
		$this->debug  = $config->get('debug');
		$this->start  = $config->get('start', microtime(true));
		$this->caches = $config->get('caches');
	}

	public function configure() { /* auto-configure firm */
		return array (
			"uses"         => array("debug", "start"),
			"setting-group"=> "cache",
			"settings"     => array (
				array(
					"name" =>"caches",
					"type" =>"array[type,dir,timeout]",
					"label"=>"Cache configuration",
					"info" =>"Type, dir (must exist), timeout in miliseconds")
			) // end settings
			);		
	}


	private function cached_file ( $type, $firm ){
		return 		
			$this->caches[$type]["dir"] . '/' . 
			md5( is_null($firm) ? $_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING'] : $firm) ;
	}

	public function is_cacheable( $type ){
		return $this->caches && isset($this->caches[$type]);
	}
	
	public function out($type="html", $firm=NULL) {	
		
		if ( ! $this->cached_type($type) ) {
			return false;
		}
						
		$cached_file = $this->cached_file($firm);		
		$timeout     = $this->cache["type"]["timeout"];

		if (!file_exists($cached_file)) {
			return $cached_file;			
		// Only use this cache file if less than 'timeout' (milisecond);
		} elseif ( (time() - filemtime($cached_file)) > $timeout) {
			// remove cache file, because aiki means on next attempt, creates
			unlink($cached_file);		
			return $cached_file;
		} 
				
		// read file from cache and a firm
		$message="";
		if ( $this->debug ) {
			$time= sprintf("%4.f seconds", microtime(true)-$this->start);
			switch ($type) {
				case "html":
					$message= "\n<!--Served From HTML Cache in $time -->";
					break;
				case "css" :
					$message= "\n/* Served From CSS Cache in $time */";
					break;			
			}
		}
		readfile($cached_file);
		die($message);
	}
				
} 

