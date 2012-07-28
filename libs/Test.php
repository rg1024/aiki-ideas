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

   	
class test { 
	private $options;
	private $fails; 
	private $count;
	private $output;
	
    public function __construct( $complete , $title) {		
	
		$this->options["complete"] = (boolean) $complete;
		$this->options["title"]    = (is_null($title) ? "Test result" : $title );
		
		$this->fails = 0;
		$this->count = 0;
		$this->output= "";
		
		error_reporting(E_ALL);
    }
    
    
    function render () {		
		if ( !$this->options["complete"]) {
		   echo ($this->fails ? "fails" : "ok" );
		   return;
		}
		
		echo "<h2>{$this->options['title']}</h2>";
		
		echo "<table class='table'><thead><th>Result</th></thead><tbody>";
		
		echo "<tr><td>" . implode ($this->output,"</tr></td>\n<tr><td>") . "</td></tr>";;
		echo "</tbody></table>";
		
		echo "<h3>RESULT:</h3>";
				
		if ( $this->fails ) {
			echo "<div class='alert alert-error'>";
			echo "<i class='icon-remove'></i> {$this->fails} fails<br> ";			
			echo "<i class='icon-ok'></i> ". ($this->count - $this->fails) . " ok<br>";
			echo "<i class='icon-list'></i> ". $this->count . " total<br>";
			echo "</div>";
		} else {
			echo "<div class='alert alert-success'><i class='icon-ok icon-white'></i> All passed ( ".   $this->count . " test)</div>";
		}
	}	
    
    function test ( $expected, $result, $description="" ) {		
		
		if ( $expected !== $result ) {
			$this->fails++;		
			$result = "fails";
		} else {			
			$result = "ok";
		}
		$this->count++;
		
		if ( $this->options["complete"]) {
			$this->output[] = $result." ". ( $description ? $description : $result) ;
		}										
	}				

	
       
} // end class

