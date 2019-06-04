<?php 
	header('ACCESS-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: PUT');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-width ');

	require_once '../ApiModels/api.php'; 

	$request = new user();
	$request->setUrl('http://localhost/NEW_API/Api/ApiModels/api.php');

	$request->setHeaders(array(
	  'Postman-Token' => 'ba9de993-57e6-409f-8304-390254231657',
	  'cache-control' => 'no-cache'
	));

	try {
		$data = json_decode(file_get_contents("php://input"));
		$request->gandertech_public_id = $data->gandertech_public_id;

		$request->gandertech_username = $data->gandertech_username;
		$request->gandertech_user_email = $data->gandertech_user_email;
		$request->gandertech_password = $data->gandertech_password;
	  	$response = $request->put();

	} catch (HttpException $ex) {
	  echo $ex;
	}


?>


