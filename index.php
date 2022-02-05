<?php
include "MovieController.php";
//header("Access-Control-Allow-Origin: *");
//header("Access-Control-Allow-Methods: GET, POST, PUT");
//header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");

/*
 * header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');
*/

header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");
//$data = json_decode(file_get_contents("php://input"));
//echo "received data";
//var_dump($data);


//var_dump ($_REQUEST);
//var_dump ($_SERVER);

$data = json_decode(file_get_contents("php://input"), true);
//
var_dump($data);
////echo implode($_REQUEST);
////echo($_REQUEST['movieName']);
////echo($_REQUEST['releaseYear']);
////echo($_REQUEST['desc']);
////echo($_REQUEST['poster']);
if (isset($data)) {
    var_dump($_SERVER);
    $movieController = new MovieController();
    $movieController->switcher($_SERVER['PATH_INFO'], $data);
}
