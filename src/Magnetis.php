<?php

namespace Magnetis;

use DateTimeImmutable;
use Lcobucci\JWT\Encoding\ChainedFormatter;
use Lcobucci\JWT\Encoding\JoseEncoder;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\Signer\Key\InMemory;
use Lcobucci\JWT\Token\Builder;
use Lcobucci\JWT\UnencryptedToken;

class Magnetis
{
	/**
	 * Generated token
	 */
	private UnencryptedToken $token;

	/**
	 * Redirection URL if login failed
	 */
	private string $redirect;

	/**
	 * 
	 */
	public function __construct(string $issuer, string $redirect_url, string $email, string $signing_key) 
	{
		$this->redirect = $redirect_url;
		$this->token = $this->createToken(
			issuer: $issuer, 
			redirect_url: $redirect_url, 
			email: $email, 
			signing_key: $signing_key
		);
	}

	/**
	 * Generate a new connection URL
	 */
	public function connect(string $lang, string $endpoint) : string
	{
		return $endpoint . '?language=' . strtolower($lang) . '&redirect=' .$this->redirect . '&authenticate=' . $this->token->toString();
	}

	/**
	 * Return the generated token
	 */
	public function getToken() : UnencryptedToken
	{
		return $this->token;
	}
	
	/**
	 * Generate a uniq id based on time
	 */
	private function jti() : string
	{
		return md5(time() . rand());
	}

	/**
	 * Create a new JWT token formatted for Magnetis
	 */
	private function createToken(string $issuer, string $redirect_url, string $email, string $signing_key) : UnencryptedToken
	{
		$tokenBuilder = new Builder(new JoseEncoder(), ChainedFormatter::default());
		$algorithm = new Sha256();
		$now = new DateTimeImmutable();
		$signing_key = InMemory::plainText($signing_key);
		
		$token = $tokenBuilder
			->identifiedBy($this->jti())
			->issuedBy($issuer)
			->issuedAt($now)
			->permittedFor($redirect_url)
			->expiresAt($now->modify('+1 minute'))
			->withClaim("email", $email)
			->getToken($algorithm, $signing_key);

		return $token;
	}
}
