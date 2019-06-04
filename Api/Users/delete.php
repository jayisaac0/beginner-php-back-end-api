<?php 
	header('ACCESS-Control-Allow-Origin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: DELETE');
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
		$request->public_id = $data->public_id;
	  	$response = $request->delete();

	} catch (HttpException $ex) {
	  echo $ex;
	}
?>