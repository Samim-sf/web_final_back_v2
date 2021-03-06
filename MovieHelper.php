<?php

use DatabaseConnector as dbconnector;

include_once "./DatabaseConnector.php";
include_once "Movie.php";

class MovieHelper
{
    private $dbconnection;
    private $tableName = "movie";

    public function __construct()
    {
        $this->dbconnection = DatabaseConnector::getInstance();;
    }

    public function insert(Movie $movie)
    {
        $sql = "INSERT INTO $this->tableName (movie_name,release_year,description,poster_fileName) VALUES(:movieName,:releaseYear,:description,:postersFileName)";
        $query = $this->dbconnection->prepare($sql);
        $movieName = $movie->getMovieName();
        $releaseYear = $movie->getReleaseYear();
        $description = $movie->getDescription();
        $postersFileName = $movie->getPosterPath();
        $query->bindParam(':movieName', $movieName, PDO::PARAM_STR);
        $query->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':postersFileName', $postersFileName, PDO::PARAM_STR);
        DatabaseConnector::exeQuery($query);
    }

    public function fetchAll()
    {
        $sql = "SELECT * FROM $this->tableName";
        $query = $this->dbconnection->prepare($sql);
        $allData = DatabaseConnector::runQuery($query);
        $movieArray = array();
        if ($query->rowCount() > 0) {
            foreach ($allData as $data) {
                $movie = new Movie();
                $movie->setId($data->id);
                $movie->setMovieName($data->movie_name);
                $movie->setReleaseYear($data->release_year);
                $movie->setDescription($data->description);
                $movie->setPosterPath($data->poster_fileName);
                array_push($movieArray, $movie);
            }
        }

        if (count($movieArray) == 0) {
            echo json_encode(array("message" => "nothing to show"));
        } else {
            echo json_encode($movieArray);
        }
    }

    public function fetchByYearOrName($search)
    {
        $sql = "SELECT * FROM  $this->tableName WHERE CAST(release_year as CHAR) like '$search' OR  movie_name like '$search'";
        $query = $this->dbconnection->prepare($sql);
        $allData = DatabaseConnector::runQuery($query);
        $movieArray = array();
        if ($query->rowCount() > 0) {
            foreach ($allData as $data) {
                $movie = new Movie();
                $movie->setId($data->id);
                $movie->setMovieName($data->movie_name);
                $movie->setReleaseYear($data->release_year);
                $movie->setDescription($data->description);
                $movie->setPosterPath($data->poster_fileName);
                array_push($movieArray, $movie);
            }
        }

        if (count($movieArray) == 0) {
            echo json_encode(array("message" => "nothing to show"));
        } else {
            echo json_encode($movieArray);
        }
    }

    public function update(Movie $movie)
    {
        $sql = "UPDATE movie SET movie_name=:movieName,release_year=:releaseYear,description=:description,poster_fileName=:poster_fileName  WHERE id =:id";
        $query = $this->dbconnection->prepare($sql);
        $movieId = intval($movie->getId());
        $movieName = $movie->getMovieName();
        $releaseYear = intval($movie->getReleaseYear());
        $description = $movie->getDescription();
        $postersFileName = $movie->getPosterPath();
        $query->bindParam(':id', $movieId, PDO::PARAM_INT);
        $query->bindParam(':movieName', $movieName, PDO::PARAM_STR);
        $query->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam(':poster_fileName', $postersFileName, PDO::PARAM_STR);
        DatabaseConnector::exeQuery($query);
    }

    public function delete($id)
    {
        $sql = "DELETE FROM $this->tableName WHERE id=:id";
        $query = $this->dbconnection->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_INT);
        DatabaseConnector::exeQuery($query);
    }

    public function fetch($id)
    {
        $sql = "SELECT * FROM $this->tableName WHERE id=:id";
        $query = $this->dbconnection->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        return DatabaseConnector::runQuery($query);
    }
}