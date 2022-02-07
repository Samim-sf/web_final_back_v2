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

    public function switcher($uri, $request, $get)
    {
        switch ($uri) {
            case Actions::CREATE:
                $this->createAction($request);
                break;
            case Actions::UPDATE:
                $this->updateAction($request, $get['id']);
                break;
            case Actions::READ:
                $this->read($get['id']);
                break;
            case Actions::READ_ALL:
                $this->readAll();
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

    public function createAction($request)
    {
        $movie = new Movie();
        $movie->setMovieName($request['movieName']);
        $movie->setReleaseYear($request['releaseYear']);
        $movie->setDescription($request['desc']);
        $movie->setPosterPath($request['poster']);
        $this->movieHelper->insert($movie);
        (http_response_code(201));
    }

    public function updateAction($request, $id)
    {
        $movie = new Movie();
        $movie->setId($id);
        $movie->setMovieName($request['movieName']);
        $movie->setReleaseYear($request['releaseYear']);
        $movie->setDescription($request['desc']);
        $movie->setPosterPath($request['poster']);
        $this->movieHelper->update($movie);
        (http_response_code(201));
    }

    public function delete($id)
    {
        $this->movieHelper->delete($id);
        (http_response_code(201));
    }

    public function readByCondition($condition)
    {
        $this->movieHelper->fetchByYearOrName($condition);
    }

    public function readAll()
    {
        $this->movieHelper->fetchAll();
    }

    public function read($request)
    {
        $res = $this->movieHelper->fetch($request);
        echo json_encode($res);
    }
}