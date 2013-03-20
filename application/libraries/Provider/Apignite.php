<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Apignite OAuth2 Provider
 *
 * @package    CodeIgniter/OAuth2
 * @category   Provider
 * @author     Andrei Oprisan
 * @copyright  (c) 2012 ApiGnite
 */

class OAuth2_Provider_Apignite extends OAuth2_Provider
{
	public function url_authorize()
	{
		return 'http://'.$_SERVER["HTTP_HOST"].'/oauth2/authorize';
	}

	public function url_access_token()
	{
		return 'http://'.$_SERVER["HTTP_HOST"].'/oauth2/access_token';
	}

	public function action(OAuth2_Token_Access $token, $path)
	{
		$url = 'https://'.$_SERVER["HTTP_HOST"].'/'.$path.'/?'.http_build_query(array(
			'access_token' => $token->access_token,
		));

		// Create a response from the request
		return array(
			'result' => json_decode(file_get_contents($url))
		);
	}
}
