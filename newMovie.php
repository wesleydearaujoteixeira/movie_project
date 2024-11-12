<?php


require_once("templates/header.php");
require_once("dao/userDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);


$userData = $userDAO->verifyToken(true);

?>

<div id="main-container" class="container-fluid">
    <div class="offset-md-4 col-md-4 new-movie-container">
        
    <h1 class="page-title"> Adicionar Filme </h1>
        <p class="page-description"> Compartilhe sua critica e compartilhe com o mundo. </p>
        
        
        <form action="movie_process.php" id="add-movie-form" method="POST" enctype="multipart/form-data" class="form">
            <input type="hidden" name="type" value="create">
            <input type="hidden" name="id" value="<?= $userData["id"] ?>">
            <div class="form-group">
                <label for="title"> Titulo: </label>
                <input type="text" class="form-control" name="title" placeholder="Digite o nome do filme">
            </div>
            <div class="form-group">
                <label for="image"> Imagem: </label>
                <input type="file"  name="image" class="form-control-file" id="image">
            </div>
            
            <div class="form-group">
                <label for="length"> Duração: </label>
                <input type="text" class="form-control" name="duration"  id="image" placeholder="duração do filme">
            </div>

            <div class="form-group">
                <label for="category"> Category: </label>
                <select name="category" id="" class="form-control">
                    <option value="Action">Ação</option>
                    <option value="Comedy">Comédia</option>
                    <option value="Drama">Drama</option>
                    <option value="Horror">Horror</option>
                    <option value="Romance">Romance</option>
                    <option value="Science Fiction">Ciência Ficção</option>
                    <option value="Thriller">Thriller</option>
                </select>
            </div>

            <div class="form-group">
                <label for="thriller"> Thriller: </label>
                <input type="text" class="form-control" name="triller"  id="thriller" placeholder="digite o link do filme">
            </div>

            <div class="form-group">
                <label for="description"> Descrição: </label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" placeholder="Descreva o filme"></textarea>
            </div>

            <button type="submit" id="card-btn">
                salvar
            </button>

        </form>
    </div>
</div>


<?php

require_once("templates/footer.php");


?>