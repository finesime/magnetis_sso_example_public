<?php

	/* 
		@param - sets your preferred langauge on login through SSO
		@values (Excluding any spaces)
		@_1 - english
		@_2 - french
	*/
	$language    = "french";

	/*
	    @params   - available in Magnetis SSO module
	    @index    - change in src/token file, if changed here
	    @email    - email used for logging into account
	    @issuer   - resource address added in sso module
	    @redirect - resource address you are requesting access from
	    @redirect - resource address added in sso module
	    @secret   - SSO key visible in SSO module
	*/ 

	$data = array(
		'email'    => "myemail@mailbox.fr", 
		'issuer'   => "https://mywebsite.fr/calltracking", 
		'redirect' => "https://www.mywebsite.fr/login", 
		'secret'   => "mysecretkey"
	);

	/*
	   @param - SSO Endpoint
	   @value - available in SSO module
	   @used  - required for example/login
	*/
	$endpoint = "https://www.magnetis.fr/console/sso";

?>