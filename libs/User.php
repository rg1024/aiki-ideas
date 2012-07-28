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


class User {
	private $aiki;
	private $logged;
	
	function __construct($aiki){
		if(session_id() == '') { // session isn't started
			session_start();
		}		
		
		if  ( isset($_SESSION["user_id"])){
			$this->load($_SESSION["user_id"]);
		}
		$this->aiki = $aiki;
	}


	function load($id, $password=null){
		if ( is_null($password) ) {
			$SQL = "SELECT * FROM aiki_users WHERE user_id=" .(int) $id;
		} else {
			$id     = $this->aiki->db->escape($id);
			$passwod= $this->aiki->db->escape($password);
			$SQL    = "SELECT * FROM aiki_users WHERE user_login='$id' AND user_password='$password' LIMIT 1";
		}
		$this->user = $this->aiki->db->get_row($SQL);
		$this->logged = ( !is_null($this->user) );
		return $this->logged;
	}	
		
		
	function login( $loginKey="login", $passwordKey="password"){
		if ( isset($_REQUEST[$loginKey]) && isset($_REQUEST[$passwordKey]) ) {
			return $this->load($_REQUEST[$loginKey], $_REQUEST[$passwordKey]);
		}
		return false;
	}	
		
		
	function logout(){
		if  ( isset($_SESSION["user_id"])){
			unset($_SESSION["user_id"]);
		} 
		$this->user   = NULL;
		$this->logged = false;
	}		
				
	function is_logged(){
		return $this->logged;
	}
	
	function __get($name){
		if ( $this->logged && isset( $this->user[$name] ) ){
			return $this->user[$name];
		}
	    return null;
	}
		
}
