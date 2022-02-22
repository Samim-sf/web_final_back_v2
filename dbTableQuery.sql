CREATE DATABASE IF NOT EXISTS Movie;

CREATE TABLE movie(
                      id INT PRIMARY KEY AUTO_INCREMENT,
                      movie_name VARCHAR(255) NOT NULL  ,
                      release_year INT NOT NULL ,
                      description TEXT NOT NULL ,
                      poster_file_name VARCHAR(255) NOT NULL ,
                      created_date TIMESTAMP NOT NULL DEFAULT  CURRENT_TIMESTAMP
) ENGINE  = InnoDB DEFAULT CHARSET = utf8 COLLATE = utf8_persian_ci;