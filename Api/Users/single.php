<?php 
	header('ACCESS-Control-Allow-Origin: *');
	header('Content-Type: application/json');

	require_once '../ApiModels/api.php'; 

	$request = new user();
	$request->setUrl('http://localhost/NEW_API/Api/ApiModels/api.php');

	$request->setHeaders(array(
	  'Postman-Token' => 'ba9de993-57e6-409f-8304-390254231657',
	  'cache-control' => 'no-cache'
	));

	try {
		$request->gandertech_public_id = isset($_GET['gandertech_public_id']) ? $_GET['gandertech_public_id'] : die();
	  	$response = $request->single_get();
	} catch (HttpException $ex) {
	  echo $ex;
	}


?>