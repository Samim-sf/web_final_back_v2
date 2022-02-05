<?php

class Movie
{
    private int $id;
    private string $movieName;
    private int $releaseYear;
    private string $description;
    private string $posterPath;

    public function __construct()
    {
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMovieName(): string
    {
        return $this->movieName;
    }

    /**
     * @param string $movieName
     */
    public function setMovieName(string $movieName): void
    {
        $this->movieName = $movieName;
    }

    /**
     * @return int
     */
    public function getReleaseYear(): int
    {
        return $this->releaseYear;
    }

    /**
     * @param int $releaseYear
     */
    public function setReleaseYear(int $releaseYear): void
    {
        $this->releaseYear = $releaseYear;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getPosterPath(): string
    {
        return $this->posterPath;
    }

    /**
     * @param string $posterPath
     */
    public function setPosterPath(string $posterPath): void
    {
        $this->posterPath = $posterPath;
    }



}