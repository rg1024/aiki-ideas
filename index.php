<?php

/**
 * Aiki 2.
 *
 */
 
 
 if ( !defined("AIKI2") ) {
   define("AIKI2", basename( __FILE__) );
 }
 
 
/* STEP 0: Configuration  and create AIKI object*/
if (!file_exists("config.php") ) {
   die( "No config file exists. Please copy config.default to config.php");
}

 //load core configuration file and create $config object
include_once ("config.php");     
include_once ("libs/Config.php");
$config = new Config($config); 
 
include_once "libs/Aiki2.php";
$aiki = new Aiki2($config);

/* STEP 1: Cache, triggers and logs.*/
if ( $aiki->config->get("caches",false) ){
	$aiki->cache->out();
}

if ( $aiki->config->get("triggers",false) ){
	$aiki->triggers->run();
}

if ( $aiki->config->get("logs",false) ){
	$aiki->logs->init();
}

/* STEP 2: Connect database. */
$aiki->db->get_var("SELECT NOW()");   

/* STEP 3: session / authenticate users.*/
$aiki->user;

/* STEP 4: determine / site / view / language. */
/* STEP 5: engine generate content */
$content = "Hi, i'm aiki";

/* STEP 6: output content. */
echo $content;

/* STEP 7: cache and other transformations. */

/* 
if ( $aiki->config->get("caches",false") ){
	$aiki->cache->out();
}
*/ 
 
