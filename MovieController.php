<?php

use CRUD\Model\Actions;
include_once "Movie.php";

include_once "./MovieHelper.php";
include_once "./Actions.php";
class MovieController
{
    private $movieHelper;

    public function __construct()
    {
        $this->movieHelper = new MovieHelper();
    }
    public function switcher($uri,$request,$get)
    {
        switch ($uri) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request,$get['id']);
                break;
            case Actions::READ:
//                $this->readByCondition($request);
                $this->read($get['id']);
                break;
            case Actions::READ_ALL:
                  $this->readAll($request);
//               return $lastResult;
                break;
            case Actions::DELETE:
                $this->delete($get['id']);
                break;
                case Actions::SEARCH:
                    $this->readByCondition($get['search']);
                break;
            default:
                break;
        }
    }

//    public function createAction($request)
//    {
//        if ($_POST['insert']) {
////            if (!empty($_FILES["poster"]["name"])) {
//            $fileName = basename($_FILES["poster"]["name"]);
//            $fileType = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
//            $targetFilePath = "uploads/" . $fileName;
//            //Allow certain file format
//            $allowTypes = array('jpg', 'png', 'jpeg');
//            if (in_array($fileType, $allowTypes)) {
//                //Upload file to server
//                if (move_uploaded_file($_FILES["file"]["name"], $targetFilePath)) {
//                    //Create movie object
//                    $movie = new Movie();
//                    $movie->setMovieName($request['movieName']);
//                    $movie->setReleaseYear($request['releaseYear']);
//                    $movie->setDescription($request['description']);
//                    $movie->setPosterPath($fileName);
//                    $this->movieHelper->insert($movie);
//
//                }
//            }
////            }
//        }
//    }
    public function createAction($request){
        $movie = new Movie();
        $movie->setMovieName($request['movieName']);
        $movie->setReleaseYear($request['releaseYear']);
        $movie->setDescription($request['desc']);
        $movie->setPosterPath($request['poster']);
        $this->movieHelper->insert($movie);
    }
//    public function updateAction($request, $post){
//        if (isset($request['update'])) {
//            $id = $_GET['update'];
//            $fileName = basename($_FILES["poster"]["name"]);
//            $fileType = pathinfo($_FILES["poster"]["name"], PATHINFO_EXTENSION);
//            $targetFilePath = "uploads/" . $fileName;
//            //Allow certain file format
//            $allowTypes = array('jpg', 'png', 'jpeg');
//            if (in_array($fileType, $allowTypes)) {
//                //Upload file to server
//                if (move_uploaded_file($_FILES["file"]["name"], $targetFilePath)) {
//                    //Create movie object
//                    $movie = new Movie();
//                    $movie->setId($id);
//                    $movie->setMovieName($post['movieName']);
//                    $movie->setReleaseYear($post['releaseYear']);
//                    $movie->setDescription($post['description']);
//                    $movie->setPosterPath($fileName);
//                    $this->movieHelper->update($movie);
//                }
//            }
//        }
//    }
    public function updateAction($request,$id){
        $movie = new Movie();
        $movie->setId($id);
        $movie->setMovieName($request['movieName']);
        $movie->setReleaseYear($request['releaseYear']);
        $movie->setDescription($request['desc']);
        $movie->setPosterPath($request['poster']);
        $this->movieHelper->update($movie);
    }
    public function delete($id){
        $this->movieHelper->delete($id);
    }
    public function readByCondition($condition){
         $this->movieHelper->fetchByYearOrName($condition); //
    }
    public function readAll(){
          $this->movieHelper->fetchAll();
    }

    public function read($request){
        $res = $this->movieHelper->fetch($request);
        echo json_encode($res);
    }
}