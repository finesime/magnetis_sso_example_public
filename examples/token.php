<?php
	
	require "params.php";
	require "../src/Magnetis.php";

	/*
	   @method token - generates token
	   @required - update values in params.php
	*/
	echo $sso->token($data);
?>