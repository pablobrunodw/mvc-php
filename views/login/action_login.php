<?php 
include_once '../../config/env.php';
include_once '../../controllers/user_controller.php';
include_once '../../models/db.php';
include_once '../../models/user_model.php';

session_start();

$json = file_get_contents( 'php://input' );
$datos = json_decode( $json,true );
$handlerUser = new UserController();
$data = $handlerUser->login($datos['email'],$datos['password']);

$rta['status'] = (isset($data['Type'])) ? 400 : 200;
$rta['data'] = $data;
echo json_encode( $rta,JSON_UNESCAPED_UNICODE );
// echo $_POST['inp_email'];
// echo $_POST['inp_password'];