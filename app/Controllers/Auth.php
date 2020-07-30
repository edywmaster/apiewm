<?php
namespace App\Controllers;

use \App\Libraries\Oauth;
use \OAuth2\Request;
use \CodeIgniter\API\ResponseTrait;
use App\Models\CadastroModel;

class Auth extends BaseController
{
	use ResponseTrait;


	public function index()
	{
		$oauth = new Oauth();
		$request = new Request();
		$respond = $oauth->server->handleTokenRequest($request->createFromGlobals());
		$code = $respond->getStatusCode();
		$body = $respond->getResponseBody();
		return $this->respond(json_decode($body), $code);
	}

	//--------------------------------------------------------------------

}
