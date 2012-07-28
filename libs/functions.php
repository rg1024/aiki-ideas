<?php

/** Aiki Framework Tests (PHP)
 *
 * Tests the markup library
 *
 * LICENSE
 *
 * This source file is subject to the AGPL-3.0 license that is bundled
 * with this package in the file LICENSE.
 *
 * @author      Roger Martin 
 * @copyright   (c) 2008-2011 Aiki Lab Pte Ltd
 * @license     http://www.fsf.org/licensing/licenses/agpl-3.0.html
 * @link        http://www.aikiframework.org
 * @category    Aiki
 * @package     Tests
 * @filesource */


error_reporting (E_ALL);

function array_default_options( $defaults, $options ) {
	$ret = array();
	if ( !is_null($options) && is_array($options) ) {
		foreach ( $defaults as $key=>$value) {
			$ret[$key]= isset($options[$key]) ? $options[$key]: $value;
		}				
	} else {
		return $defauls;
	}			

	return $ret;
}



