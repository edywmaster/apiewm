<?php namespace App\Controllers;

class Home extends BaseController
{


var $test_api_url = "http://localhost/auth";
var $client_id = "ewmeventos.com";
var $client_secret = "ewm201510";

	function authclient()
	{

	    //$client = \Config\Services::curlrequest();
			//$response = $client->request('POST', 'http://localhost/auth', [
      //  'auth' => ['user', 'pass']
			//]);

			$ch = curl_init();

curl_setopt_array($ch, [

    CURLOPT_URL => 'http://localhost/',

    CURLOPT_POST => true,

    CURLOPT_HTTPHEADER => [
        'Content-Type: application/x-www-form-urlencoded'
    ],

    CURLOPT_POSTFIELDS => json_encode([
        'coment' => 'Check out developer.linkedin.com!',
        'content' => ''
    ]),

    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_PROTOCOLS => CURLPROTO_HTTPS
]);

echo $resultado = curl_exec($ch);
curl_close($ch);

	}


	function getAccessToken() {
		global $test_api_url, $client_id, $client_secret;

		$content = "grant_type=client_credentials";
		$authorization = base64_encode("$client_id:$client_secret");
		$header = array("Authorization: Basic {$authorization}","Content-Type: application/x-www-form-urlencoded");

		$curl = curl_init();
		curl_setopt_array($curl, array(
			CURLOPT_URL => $test_api_url,
			CURLOPT_HTTPHEADER => $header,
			CURLOPT_SSL_VERIFYPEER => false,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_POST => true,
			CURLOPT_POSTFIELDS => $content
		));
		$response = curl_exec($curl);
		curl_close($curl);

		echo $response;

		//return json_decode($response)->access_token;
	}

	function getAuthCode() {
		$client_id = '###.apps.googleusercontent.com';
		$redirect_uri = 'http://localhost/phpConnectToDB/csv/refreshFusionTable.php';
		$client_secret = '###';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "https://accounts.google.com/o/oauth2/token");
		curl_setopt($ch, CURLOPT_POST, TRUE);
		$code = $_REQUEST['code'];
		// This option is set to TRUE so that the response
		// doesnot get printed and is stored directly in
		// the variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		'code' => $code,
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'redirect_uri' => $redirect_uri,
		'grant_type' => 'authorization_code'
		));
		$data = curl_exec($ch);
		var_dump($data);
	}

	function getClientCred() {
		$client_id = 'ewmeventos.com';
		$client_secret = 'ewm201510';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://localhost/auth");
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_POSTFIELDS, array(
		'client_id' => $client_id,
		'client_secret' => $client_secret,
		'grant_type' => 'client_credentials'
		));
		$data = curl_exec($ch);
		var_dump($data);
	}


	public function index()
	{
		//$this->getClientCred();
		//die();
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
