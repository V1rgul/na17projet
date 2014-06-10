<?php
	function title(){
		$in = $_SERVER['SCRIPT_NAME'];
		$start = strrpos($in, "/")+1;
		$end = strpos($in, ".php");
		$title = str_replace("_", " ", substr($in, $start, $end-$start) );

		$action = strpos($in, "op=");
		$action = $action? $action+3 : "";

		return ucfirst($title)." ".ucfirst($action);
	}


?>



<head>
	<title><?php title(); ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<link rel="stylesheet" media="screen" type="text/css" title="Design" href="style.css" />
	<link rel="icon" type="image/png" href="favicon.png" />
	<script	type="text/javascript"	src="jquery-1.11.1.min.js"></script>
	<script	type="text/javascript"	src="scripts.js"></script>
</head>

