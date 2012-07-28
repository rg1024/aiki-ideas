<?php


class Db {

	private $db;
		
	
	public function configure() { /* auto-configure firm */
		return array (			
			"setting-group"=> "db",
			"settings"     => array (
				array(
					"name" =>"db_type",
					"type" =>"listof mysql,oracle",
					"label"=>"Database type"),					
				array(
					"name" =>"db_user",
					"type" =>"string 64",
					"label"=>"User"),
				array(
					"name" =>"db_password",
					"type" =>"password 64",
					"label"=>"password"),	
				array(
					"name" =>"db_name",
					"type" =>"string 64",
					"label"=>"Database name"),
				array(
					"name" =>"db_host",
					"type" =>"string 90",
					"label"=>"Host / Server",
					"info" =>"Normaly, localhost")														
			) // end settings
			);		
	}	
		
	public function __set($name, $value) {
        $this->db->$name = $value;
    }

    public function __get($name) {
		return $this->db->$name;
	}
	
	public function __call($name, $args) {
		return call_user_func_array(array($this->db, $name), $args);
	}
						
	function __construct($config) {
			
		$ezDir = substr(dirname(__FILE__),0,-4) ."libs3rd/ezSQL"; // -3 to extract "lib"
				
		require_once ("$ezDir/shared/ez_sql_core.php");			
		
		switch ($config->get('db_type') ){		

			case "mysql":
				require_once("$ezDir/mysql/ez_sql_mysql.php");
				$this->db = new ezSQL_mysql( 
					$config->get('db_user') , 
					$config->get('db_pass') , 
					$config->get('db_name') , 
					$config->get('db_host') );
				break;
			default:
				trigger_error('Fatal Error: Please use valid value for $config "db_type" in config.php');
				break;
		}		

	}			
}
		/* @TODO 	
		case "mssql":
			require_once("$ezDir/mssql.php");
			$db = new ezSQL_mssql($config['db_user'] , $config['db_pass'] , $config['db_name'] , $config['db_host']);
			break;	
			
		case "oracle":
			require_once("$ezDir/oracle8_9.php");
			$db = new ezSQL_oracle8_9( $config['db_user'] , $config['db_pass'] , $config['db_name'] );
			break;

		case "pdo":			
			require_once("$ezDir/pdo.php");	
			if ( isset ($db_dsn) &&  (!isset($config['db_path']) || !$config['db_path'] ) ){
				$config['db_path'] = $db_dsn;
			}
			$db = new ezSQL_pdo( $config['db_path'], $config['db_user'] , $config['db_pass'] );
			break;

		case "postgresql":
			require_once("$ezDir/postgresql.php");
			$db = new ezSQL_postgresql( $config['db_user'] , $config['db_pass'] , $config['db_name'] , $config['db_host'] );
			break;

		case "sqlite":
			require_once("$ezDir/sqlite.php");
			$db = new ezSQL_sqlite( $config['db_path'] , $config['db_name'] );
			break;
		*/

 
	/* OLD AIKI 
	$this->debug_echo_is_on = isset($config['enable_database_debug']) && $config['enable_database_debug'];
 
	if (isset($config['enable_query_cache']) && $config['enable_query_cache']) {
		$this->cache_queries = true;
	}

	if (isset($config['cache_dir']) && isset($config['use_disk_cache']) &&
		$config['use_disk_cache']) {
		$this->cache_timeout  = isset($config['db_cache_timeout']) ? $config['db_cache_timeout'] : 24;
		$this->cache_dir      = $config['cache_dir'];
		$this->use_disk_cache = true;
	}
	*  

*/

