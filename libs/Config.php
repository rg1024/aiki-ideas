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



Class Config{
	private $options;
	
	function __construct($options){
		$this->options= $options;
	}
		
	function get($option, $default=null){
		return ( isset($this->options[$option]) ? $this->options[$option] : $default );
	}	
	
	function set($option, $value){
		$old = isset($this->options[$option]) ? $this->options[$option]: null;
		$this->options[$option] = $value;
		return $value;
	}	
		
	
}
