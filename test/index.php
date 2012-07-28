<?php

$action = isset($_GET["action"]) ? $_GET["action"] : "welcome" ;

$welcome = "<h1 class='well'>Aiki2 Test Suite</h1>";

switch ( $action ) {
	case "welcome";
		$welcome ="
	<div class='hero-unit'>
      <h1>Aiki2 Test Suite</h1>
      <p class='lead'>Test-driven development</p>
    </div>";
		
	case "home":
		$content = list_test_files();
		break;
	
	case "test":
		$file = basename($_GET["file"]);
		ob_start();		
		include $file;
		echo "<div class='actions'><a class='btn btn-primary' href='index.php?action=home'><i class='icon-repeat icon-white'></i> list of test</a></p>";
		
		$content = ob_get_contents();
		
		ob_clean();
		break;
	
		
}


function list_test_files() {
	$files = false;
	foreach ( glob("*.php") as $file ) {
		if ( substr($file,0,5)=="test_") {
			$files[] = $file;			
		}		
	}
	
	if ( !$files ){
		return "No test files found";		
	}
	
	$ret .= "<table class='table table-striped'><thead><th>filename</th><th>action</th></thead>\n<tbody>";
	
	foreach ( $files as $file) {
		$ret .= "<tr><td><a href='?action=test&file=$file''>$file</a></td><td>test</td></td></tr>\n";		
	}
	$ret .= "\n</tbody>\n</table>";
	
	return $ret;	
}



?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Aiki 2? Test Suite</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
    </style>
    <link href="../assets/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="brand" href="#">Aiki2 Test-Suite</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="index.php">Home</a></li>              
              <li><a href="#contact">Docs</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

	
      
	  <?php 
	  echo $welcome;
	  
	  echo $content; ?>

    </div> <!-- /container -->


  </body>
</html>
