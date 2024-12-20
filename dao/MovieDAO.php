<?php


require_once("./models/Movie.php");
require_once("./models/Message.php");


class MovieDAO implements MovieDAOinterface {


    private $conn;
    private $url;
    private $message;


    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
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

        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE category = :category ORDER BY id DESC LIMIT 3");

        $stmt->bindParam(":category", $category);
        $stmt->execute();


        if ($stmt->rowCount() > 0) {
            $movies = $stmt->fetchAll();
            $movieList = [];
            foreach ($movies as $row) {
                $movieList[] = $row;

            }

            return $movieList;
        }else {
            return false;
        } 
    }

    
    public function getMovieByUserId($users_id){

        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :users_id ORDER BY id DESC");

        $stmt->bindParam(":users_id", $users_id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $movies = $stmt->fetchAll();
            $movieList = [];
            foreach ($movies as $row) {
                $movieList[] = $row;
            }
            return $movieList;
        } else {
            return false;
        }



    }

    
    public function findById($id) {

        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $movie = $stmt->fetch();
            return $movie;
        } else {
            return false;
        }

    }


    public function findByTitle($title){


        $stmt = $this->conn->prepare("SELECT * FROM movies WHERE title LIKE :title");

        $title = "%" . $title . "%";  // Adiciona os caracteres `%` ao redor do título para corresponder a qualquer posição
        $stmt->bindParam(":title", $title);
        $stmt->execute();
        
        if ($stmt->rowCount() > 0) {
            $movies = $stmt->fetchAll();
            $movieList = [];
            foreach ($movies as $row) {
                $movieList[] = $row;
            }
            return $movieList;
        } else {
            return false;
        }

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
    
    public function update($title, $description, $image, $trailer, $category, $length, $id, $redirect = true){

        
        $stmt = $this->conn->prepare("UPDATE movies SET
        title = :title,
        description = :description,
        image = :image,
        trailer = :trailer,
        category = :category,
        length = :length
        WHERE id = :id");


        $stmt->bindParam(":title", $title);
        $stmt->bindParam(":description", $description);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":trailer", $trailer);
        $stmt->bindParam(":category", $category);
        $stmt->bindParam(":length", $length);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if($redirect) {
            $this->message->setMessage("Filme atualizado com sucesso!", "sucess", "dashboard.php");
        }




    }


    public function destroy($id){

        $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :id");
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        $this->message->setMessage("Filme excluído com sucesso!", "sucess", "dashboard.php");

    }
}



?>