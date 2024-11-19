<?php

class Movie {
    
    public $id;
    public $title;
    public $description;
    public $image;
    public $trailer;
    public $category;
    public $length;
    public $users_id;


}

interface MovieDAOinterface  {

  
    public function getLatestMovies();
    public function getMoviesByCategory($category);
    public function getMovieByUserId($id);
    public function findById($id);
    public function findByTitle($title);
    public function create($title, $description, $image, $trailer, $category, $length, $users_id);
    public function update($title, $description, $image, $trailer, $category, $length, $users_id);
    public function destroy($users_id);


}




?>