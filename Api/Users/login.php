<?php 
	header('ACCESS-Control-Allow-Origin: http://localhost/');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-width ');

	require_once '../ApiModels/auth.php'; 

	$request = new Authentication();
	$request->setUrl('http://localhost/NEW_API/Api/ApiModels/auth.php');

	$request->setHeaders(array(
	  'cache-control' => 'no-cache',
	  'Connection' => 'keep-alive',
	  'content-length' => '',
	  'accept-encoding' => 'gzip, deflate',
	  'Host' => 'localhost',
	  'Postman-Token' => '7d86e168-4865-4b31-9925-5739ec56cefe,cf6ea1c5-9201-4734-974c-6dd180422595',
	  'Cache-Control' => 'no-cache',
	  'Accept' => '*/*',
	  'User-Agent' => 'PostmanRuntime/7.11.0',
	  'Content-Type' => 'application/json'
	));	

	try {
		$data = json_decode(file_get_contents("php://input"));
		$request->username = $data->username;
		$request->password = $data->password;
	  	$response = $request->generate_token();

	} catch (HttpException $ex) {
	  echo $ex;
	}


?>