<?php

require_once("./templates/header.php");
require_once("./dao/userDAO.php");
require_once("./dao/movieDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);
$userData = $userDAO->verifyToken(true);


// pegando o id do link
$id = $_GET['id'];



$movieDAO = new MovieDAO($conn, $BASE_URL);

$movies = $movieDAO->findById($id);


$trailer_url = $movies['trailer'];

// Verifica se a URL contém "watch?v="
if (strpos($trailer_url, "watch?v=") !== false) {
    // Substitui "watch?v=" por "embed/"
    $trailer_url = str_replace("watch?v=", "embed/", $trailer_url);
}

// Remove parâmetros adicionais após o video_id (se existirem)
$trailer_url = strtok($trailer_url, '&');


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body id="main-container" class="container-fluid">
    <div class="row">
        <div class="offset-md-2 col-md-6 movie-container">
            <h1> <?= $movies['title'] ?> </h1>
            <p class="movie-details">
               
            </p>
            <iframe src="<?= $trailer_url ?>" height="300" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

            <p> <?= $movies['description']?>  </p>
        </div>
        <div class="col-md-4">

            <div>
                <img src="<?= $movies["image"] ?>" class="movie-image-container img" alt=""> 
            </div>
            <div class="offset-md-1 col-md-10"  id="reviews-container" >
            <span> Duração  <?= $movies['length'] ?> </span>
                
                <span> category </span>
                <span class="pipe"> </span>
                <span> <i class="fas fa-star"></i> 9 </span>
                <h3 id="reviews-title"> Avaliações:  </h3> 

                <!-- Enviar os comentários: -->


                <div class="col-md-12" id="review-form-container">
                    <h4> Envie sua avaliação: </h4>
                    <p class="page-description"> Preencha o formulário com a nota e comentário sobre o filme </p>

                    <form action="review_process.php" method="POST">
                        <input type="hidden" name="type" value="create">
                        <input type="hidden" name="movie_id" value="<?= $id ?>">
                        <div class="form-group">
                            <label for="rating"> Nota do Filme </label>
                            <select name="rating" id="rating" class="form-control">
                                <option value=""> Selecione </option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="review"> Seu comentário: </label>
                            <textarea name="review" id="review" rows="3" cols="40" class="form-control"
                            placeholder="O que você achou do filme?"    
                            > 
                        </textarea>
                        </div>

                        <button type="submit" id="card-btn"> Enviar comentário </button>

                    </form>

                </div>

                <!-- Comentários -->

                <div class="col-md-12 review">
                    <div class="row">
                        <div class="col-md-1">
                            <img src="" alt="">
                            <div class="col-md-9 author-details-container"> 
                                <h4 class="author-name"> 
                                    <a href="#"> Giovanni Claus </a>
                                </h4>
                                <p> <i class="fas fa-star"></i> 9 </p>
                            </div>

                            <div class="col-md-12">
                                <p class="comment-title"> Comentários: </p>
                                <p> Este é o comentário do seu usuário </p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>