<?php

require_once 'Auth/OAuth/Store/Server.php';

class Auth_OAuth_Store_ServerImpl implements Auth_OAuth_Store_Server
{
	private $key;

	private $secret;

	private $request_token_uri;

	private $authorize_uri;

	private $access_token_uri;

	private $signature_methods;

	public function __construct ( $key, $secret )
	{
		$this->key = $key;
		$this->secret = $secret;
	}

	/**
	 * Get the consumer key that has been issued by this server.
	 *
	 * @return string consumer key
	 */
	public function getKey()
	{
		return $this->key;
	}


	/**
	 * Get the consumer secret that has been issued by this server.
	 *
	 * @return string consumer secret
	 */
	public function getSecret()
	{
		return $this->secret;
	}


	/**
	 * Get the request token endpoint URI.
	 *
	 * @return string request token endpoint URI
	 */
	public function getRequestTokenURI()
	{
		return $this->request_token_uri;
	}


	/**
	 * Set the request token endpoint URI.
	 *
	 * @param string $uri request token endpoint URI
	 */
	public function setRequestTokenURI( $uri )
	{
		$this->request_token_uri = $uri;
	}


	/**
	 * Get the authorize endpoint URI.
	 *
	 * @return string authorize endpoint URI
	 */
	public function getAuthorizeURI()
	{
		return $this->authorize_uri;
	}


	/**
	 * Set the authorize endpoint URI.
	 *
	 * @param string $uri authorize endpoint URI
	 */
	public function setAuthorizeURI( $uri )
	{
		$this->authorize_uri = $uri;
	}


	/**
	 * Get the access token endpoint URI.
	 *
	 * @return string access token endpoint URI
	 */
	public function getAccessTokenURI()
	{
		return $this->access_token_uri;
	}


	/**
	 * Set the access token endpoint URI.
	 *
	 * @param string $uri access token endpoint URI
	 */
	public function setAccessTokenURI( $uri )
	{
		$this->access_token_uri = $uri;
	}


	/**
	 * Get the supported signature methods.
	 *
	 * @return array supported signature methods
	 */
	public function getSignatureMethods()
	{
		return $this->signature_methods;
	}


	/**
	 * Set the supported signature methods.
	 *
	 * @param array $methods supported signature methods
	 */
	public function setSignatureMethods( $methods )
	{
		$this->signature_methods = $methods;
	}

}

?>
