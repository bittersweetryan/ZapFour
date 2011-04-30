<?php


require_once 'Auth/OAuth/Store.php';
require_once 'Auth/OAuth/Util.php';
require_once 'Auth/OAuth/Store/ConsumerImpl.php';
require_once 'Auth/OAuth/Store/ServerImpl.php';
require_once 'Auth/OAuth/TokenImpl.php';

/**
 * An OAuth store implementation that stores everything in memory.  This implementation 
 * is only really useful as an example of an OAuth Store implementation, or for 
 * testing other components of the library.  If you don't understand why this 
 * should never be used in production, you probably shouldn't be using this library.
*/
class Auth_OAuth_Store_InMemory implements Auth_OAuth_Store
{
	
	/**
	 * Associative array of Auth_OAuth_Store_Consumer objects, keyed on consumer_key.
	 *
	 * @var array
	 */
	private $consumers;

	/**
	 * Associative array of Auth_OAuth_Token objects, keyed on token value.
	 *
	 * @var array
	 */
	private $consumer_tokens;

	/**
	 * Associative array of Auth_OAuth_Store_Server objects, keyed on consumer_key.
	 *
	 * @var array
	 */
	private $servers;

	/**
	 * Associative array of Auth_OAuth_Token objects, keyed on token value.
	 *
	 * @var array
	 */
	private $server_tokens;

	/**
	 * Constructor.
	 *
	 */
	public function __construct()
	{
		$this->consumers = array();
		$this->consumer_tokens = array();
		$this->servers = array();
		$this->server_tokens = array();
	}

	/**
	 * Get an OAuth Consumer.
	 *
	 * @param string $consumer_key consumer key to get
	 * @return Auth_OAuth_Store_Consumer
	 */
	public function getConsumer ( $consumer_key ) 
	{
		if (array_key_exists($consumer_key, $this->consumers)) {
			return $this->consumers[$consumer_key];
		}
	}


	/**
	 * Update an OAuth Consumer.  If a consumer does not already exist with the 
	 * consumer_key, a new one will be added.
	 *
	 * @param Auth_OAuth_Store_Consumer $consumer consumer to update
	 */
	public function updateConsumer ( Auth_OAuth_Store_Consumer $consumer ) 
	{
		$this->consumers[$consumer->getKey()] = $consumer;
	}


	/**
	 * Delete an OAuth Consumer.
	 *
	 * @param string $consumer_key consumer key to delete
	 */
	public function deleteConsumer ( $consumer_key ) 
	{
		if (array_key_exists($consumer_key, $this->consumers)) {
			unset($this->consumers[$consumer_key]);
		}
	}


	/**
	 * Get an OAuth Consumer Token.
	 *
	 * @param string $token_key token to get
	 * @return Auth_OAuth_Token
	 */
	public function getConsumerToken ( $token_key ) 
	{
		if (array_key_exists($token_key, $this->consumer_tokens)) {
			return $this->consumer_tokens[$token_key];
		}
	}


	/**
	 * Get all OAuth Consumer Tokens issued to the specified user.
	 *
	 * @param int $user ID of user to get tokens for.  If null, tokens for all users will be retrieved.
	 * @return array of Auth_OAuth_Token objects
	 */
	public function getConsumerTokens ( $user = null ) 
	{
		$tokens = array();

		foreach ($this->consumer_tokens as $token) {
			if ($user == null || $user == $token->getUser()) {
				$tokens[] = $token;
			}
		}

		return $tokens;
	}


	/**
	 * Update an OAuth Consumer Token.  If a token does not already exist with the 
	 * token value, a new one will be added.
	 *
	 * @param Auth_OAuth_Token $token consumer token to add or update
	 */
	public function updateConsumerToken ( Auth_OAuth_Token $token )
	{
		$this->consumer_tokens[$token->getToken()] = $token;
	}


	/**
	 * Delete a consumer token.
	 *
	 * @param string $token_key token to be deleted
	 */
	public function deleteConsumerToken ( $token_key ) 
	{
		if (array_key_exists($token_key, $this->consumer_tokens)) {
			unset($this->consumer_tokens[$token_key]);
		}
	}


	/**
	 * Get an OAuth Server.
	 *
	 * @param string $consumer_key consumer key of server to get
	 * @return Auth_OAuth_Store_Server
	 */
	public function getServer ( $consumer_key ) 
	{
		if (array_key_exists($consumer_key, $this->servers)) {
			return $this->servers[$consumer_key];
		}
	}


	/**
	 * Update an OAuth Server.  If a server does not already exist with the 
	 * consumer_key, a new one will be added.
	 *
	 * @param Auth_OAuth_Store_Server $server server to update
	 */
	public function updateServer ( Auth_OAuth_Store_Server $server ) 
	{
		$this->servers[$consumer->getKey()] = $server;
	}


	/**
	 * Delete an OAuth Server.
	 *
	 * @param string $consumer_key consumer key to delete
	 */
	public function deleteServer ( $consumer_key ) 
	{
		if (array_key_exists($consumer_key, $this->servers)) {
			unset($this->servers[$consumer_key]);
		}
	}


	/**
	 * Get an OAuth Server Token.
	 *
	 * @param string $token_key token to get
	 * @return Auth_OAuth_Token
	 */
	public function getServerToken ( $token_key ) 
	{
		if (array_key_exists($token_key, $this->server_tokens)) {
			return $this->server_tokens[$token_key];
		}
	}


	/**
	 * Get all OAuth Server Tokens issued to the specified user.
	 *
	 * @param int $user ID of user to get tokens for.  If null, tokens for all users will be retrieved.
	 * @return array of Auth_OAuth_Token objects
	 */
	public function getServerTokens ( $user = null ) 
	{
		$tokens = array();

		foreach ($this->server_tokens as $token) {
			if ($user == null || $user == $token->getUser()) {
				$tokens[] = $token;
			}
		}

		return $tokens;
	}


	/**
	 * Update an OAuth Server Token.  If a token does not already exist with the 
	 * token value, a new one will be added.
	 *
	 * @param Auth_OAuth_Token $token server token to add or update
	 */
	public function updateServerToken ( Auth_OAuth_Token $token )
	{
		$this->server_tokens[$token->getToken()] = $token;
	}


	/**
	 * Delete a server token.
	 *
	 * @param string $token_key token to be deleted
	 */
	public function deleteServerToken ( $token_key ) 
	{
		if (array_key_exists($token_key, $this->server_tokens)) {
			unset($this->server_tokens[$token_key]);
		}
	}

}


?>
