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
        return DatabaseConnector::runQuery($query);
    }

    public function fetchByYearOrName( $search)
    {
        $sql = "SELECT * FROM  $this->tableName WHERE  CAST(:releaseYear as CHAR) like $search or :movieName like $search";
        $query = $this->dbconnection->prepare($sql);
        $moveNameFromTable = "$this->tableName.movie_name";
        $releaseYearFromTable = "$this->tableName.release_year";
        $query->bindParam(':movieName', $moveNameFromTable, PDO::PARAM_STR);
        $query->bindParam(':releaseYear', $releaseYearFromTable, PDO::PARAM_STR);
        return DatabaseConnector::runQuery($query);
    }

    public function update(Movie $movie)
    {
        $sql = 'UPDATE $this->tableName SET movieName=:movieName,releaseYear=:releaseYear,description=:description,poster_fileName=:poster_fileName  WHERE id=:id';
        $query = $this->dbconnection->prepare($sql);
        $movieId = $movie->getId();
        $movieName = $movie->getMovieName();
        $releaseYear = $movie->getReleaseYear();
        $description = $movie->getDescription();
        $postersFileName = $movie->getPosterPath();
        $query->bindParam(':id', $movieId, PDO::PARAM_STR);
        $query->bindParam(':movieName', $movieName, PDO::PARAM_STR);
        $query->bindParam(':releaseYear', $releaseYear, PDO::PARAM_INT);
        $query->bindParam(':description', $description, PDO::PARAM_STR);
        $query->bindParam('::poster_fileName', $postersFileName, PDO::PARAM_STR);
        DatabaseConnector::exeQuery($query);
    }

    public function delete($id)
    {
        $sql = 'DELETE FROM $this->tableName WHERE id=:id';
        $query = $this->dbconnection->prepare($sql);
        $query->bindParam(':id', $id, PDO::PARAM_STR);
        DatabaseConnector::exeQuery($query);
    }
}