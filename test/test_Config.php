<?php


include "../libs/Test.php";

include "../libs/Config.php";


// providers..
$test = new Test( defined ("COMPLETE") ? COMPLETE : true , "Test Config class" );

$config = new Config ( array (
	"test-1"  => 1,
	"test-2" => false) );

// test 
$test->test(1    , $config->get("test-1"), "get");	
$test->test(false, $config->get("test-2"), "get");		
$test->test(NULL , $config->get("test-3"), "get null");			
	
	
$test->render();
