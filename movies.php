<?php

include_once 'db.php';

class Movies extends DB {
    
   /**
    * It connects to the database, then it queries the database for all the movies.
    * 
    * @return The query is being returned.
    */
    function getMovies(){
        $query = $this->connect()->query('SELECT * FROM movies');

        return $query;
    }


    /**
     * It takes an id, and returns a query object.
     * 
     * @param id The id of the movie you want to get.
     * 
     * @return The query is being returned.
     */
    function getMovie($id){
        $query = $this->connect()->prepare("SELECT * FROM movies WHERE id= :id ");
        $query->execute(['id' => $id]);
        return $query;
    }


    /**
     * It takes a movie object, connects to the database, prepares a query, executes the query, and
     * returns the query.
     * 
     * @param movie array(2) { ["title"]=&gt; string(4) "test" ["img"]=&gt; string(4) "test" }
     * 
     * @return The query object.
     */
    function newMovie($movie){
        $query = $this->connect()->prepare("INSERT INTO movies (title, img) values (:title, :img)");
        $query->execute(['title' => $movie['title'], 'img' => $movie['img'] ]);
        return $query;
    }
}