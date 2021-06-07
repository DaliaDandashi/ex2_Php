<?php
require_once 'connection.php';
session_start();

// if($user->is_loggedin()!="")
// {
//     $user->redirect('index.php');
// }

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Application: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

// $log = new Auth();
$user=$log->logout();
if($user){
// echo json_encode(array('status' => 200, 'Location' => '/index.php'));
$user->redirect('index.php');
}else{
    echo json_encode(array('status' => 500, 'message' => 'something went wrong'));
}


?>
<?php 
if (isset($_POST['logout'])){
    $user->logout();

    

}


?>

