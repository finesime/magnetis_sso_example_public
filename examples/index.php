<?php

require "../vendor/autoload.php";

use Magnetis\Magnetis;

/**
 * @var string sets your preferred langauge on login through SSO
 * @values (Excluding any spaces)
 * @_1 - en
 * @_2 - fr
 */
$language = "fr";

/**
 * @var string Endpoint provided on Magnetis Console at https://app.magnetis.io/sso/config
 */
$endpoint = "https://app.magnetis.io/sso";

/**
 * @var string Your website endpoint
 */
$issuer = "https://mywebsite.fr/calltracking";

/**
 * @var string Redirection url if token check do not pass or when logout from the Magnetis Console
 */
$redirect_url = "https://www.mywebsite.fr/login";

/**
 * @var string User email who want to connect to Magnetis Console
 */
$email = "myemail@mailbox.fr";

/**
 * @var string Your signing key provided on Magnetis Console at https://app.magnetis.io/sso/config
 */
$signing_key = "";


// Create a new Magnetis token
$magnetis = new Magnetis($issuer, $redirect_url, $email, $signing_key);

// Print a connection URL link
echo '<a href="' . $magnetis->connect($language, $endpoint) . '">Access here</a>';
