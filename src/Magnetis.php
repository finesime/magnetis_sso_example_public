<?php
require "../vendor/autoload.php";

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Magnetis{

	public function jti()
	{
		return md5(time().rand());
	}

	public function sanitize()
	{
		if(empty($data['issuer']))
			return FALSE;

		if(empty($data['redirect']))
			return FALSE;
		
		if(empty($data['email']))
			return FALSE;

		if(empty($data['secret']))
			return FALSE;
	}

	public function token($data)
	{
		if(!$this->sanitize($data))
			return FALSE;

		$token = (new Builder())->setIssuer($data['issuer']) 
		                        ->setAudience($data['redirect'],true) 
		                        ->setId($this->jti(), true) 
		                        ->setIssuedAt(time()) 
		                        ->setNotBefore(time() + 60) 
		                        ->setExpiration(time() + (10 * 365 * 24 * 60 * 60)) 
		                        ->set('email', $data['email'])
		                        ->sign(new Sha256(), $data['secret']) 
		                        ->getToken();

		return (string)$token;
	}
}

$sso = new Magnetis();