<?php


include "../libs/Test.php";

$test = new Test( true  ? COMPLETE : true , "Test Cache class" );
$test->test ( 10, 2+8,"sum");
$test->test ( 20, 12+8,"sum");
$test->test ( 20, 12+8);
$test->test ( 11, 2+8, "no sum");
	
$test->render();

echo "<p class='well'>This test will fail..to  show how works when fails.</p>";
