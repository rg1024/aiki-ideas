<?php


include "../libs/Test.php";

include "../libs/functions.php";


$test = new Test( defined ("COMPLETE") ? COMPLETE : true , "Test Config class" );

// providers..
$a= array("def-1"=>true, "def-2"=>false ); 
$b= array("def-2"=>true, "def-3"=>"999");
$good= array("def-1"=>true, "def-2"=>true  );

// tests
$test->test($good  , array_default_options($a,$b) ,"array_default_option");	

	
$test->render();


