<?php
include "MovieController.php";
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Disposition, Content-Type, Content-Length, Accept-Encoding");
header("Content-type:application/json");

$data = json_decode(file_get_contents("php://input"), true);
$movieController = new MovieController();
$movieController->switcher($_SERVER['PATH_INFO'], $data, $_GET);

