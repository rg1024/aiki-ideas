<?php


include "../libs/Test.php";

// providers
include "../libs/Config.php";

$config = new Config ( array (
	"start" => microtime(),
	"debug" => true,
	"caches"=> array( 
		"html" => array("dir"=>"tmp", "timeout"=>500))
	));


include "../libs/Cache.php";


//@TODO phpUNIT
$dir = dirname(__FILE__) ."/tmp";
if ( !is_dir($dir) ) {
	mkdir (  dirname(__FILE__) ."/tmp");
}

$cache = new Cache( $config );


$test = new Test( defined ("COMPLETE") ? COMPLETE : true , "Test Cache class" );

$test->test(  true  , $cache->is_cacheable("html"), "cacheable html" );	
$test->test(  false , $cache->is_cacheable("png"), "cacheable png" );		
	
	
$test->render();


