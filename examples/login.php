<?php
	
	require "params.php";
	require "../src/Magnetis.php";

	/*
	    @access link requires params 

	    @param1 - Endpoint - required
	    @param2 - language - if not added or available in access link, default is french language
	    @param3 - data['redirect'] - required
	    @param4 - data - required

	    @method token - generates token
	    @required - update values in params.php

	*/

	if(empty($endpoint))
		echo 'Please add Endpoint in examples/params.php';
	elseif(empty($data['redirect']))
		echo 'Please add Redirect value in examples/params.php';
	elseif(empty($data['issuer']))
		echo 'Please add Issuer value in examples/params.php';
	elseif(empty($data['secret']))
		echo 'Please add SSO key in examples/params.php';
	elseif($empty($data['email']))
		echo 'Please add your email to access in examples/params.php';
	else
	    echo '<a href="'.$endpoint.'?language=' . strtolower($language) . '&redirect=' . $data['redirect'] . '&authenticate=' . $sso->token($data) . '">Access here</a>';


?>