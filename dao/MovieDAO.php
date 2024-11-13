<?php


require_once("models/Movie.php");
require_once("models/Message.php");


class MovieDAO implements MovieDAOinterface {


    private $conn;
    private $url;
    private $message;


    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }


    public function buildMovie($data){

    }


    public function findAll(){



    }


    public function getLatestMovies(){
        // Realiza a consulta, sem necessidade de chamar execute() depois
        $stmt = $this->conn->query("SELECT * FROM movies ORDER BY id DESC LIMIT 5");
    
        // Tenta buscar todos os resultados em um array
        $movies = $stmt->fetchAll();
    
        // Se houver filmes, processa e retorna o array de filmes
        if ($movies) {
            $movieList = [];
            foreach ($movies as $row) {
                $movieList[] = $row;  // Processa cada linha com buildMovie()
            }
            return $movieList;
        } else {
            return false;  // Retorna false caso não haja filmes
        }
    }
    


    public function getMoviesByCategory($category){

    }

    
    public function getMovieByUserId($id){

    }
    public function findById($id) {

    }
    public function findByTitle($title){

    }
    public function create($title, $description, $image, $trailer, $category, $length, $users_id, $redirect = true){

        $stmt = $this->conn->prepare("INSERT INTO movies (title, description, image, trailer, category, length, users_id) VALUES (:title, :description, :image, :trailer, :category, :length, :users_id)");
    
        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":trailer", $trailer);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":users_id", $users_id);
    
        $stmt->execute();

        if($redirect) {
            $this->message->setMessage("Filme cadastrado com sucesso!", "sucess", "dashboard.php");

        }




    }
    public function update($title, $description, $image, $trailer, $category, $length, $users_id){

    }
    public function destroy($users_id){

    }
}



?>