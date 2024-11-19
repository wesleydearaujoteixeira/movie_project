

<?php

require_once("./templates/header.php");
require_once("./dao/userDAO.php");
require_once("./dao/MovieDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);



$userData = $userDAO->verifyToken(true);

if(isset($_GET['id'])) {
    $idMovie = $_GET['id'];

}

$movieData = $movieDAO->findById($idMovie);

$id = $movieData["id"];


?>

        <main id="profile-container" class="container-fluid">

                    <img class="image-edit" src="<?= $movieData["image"] ?>" alt="logo">            
    
                    <section>
                        <form action="movie_edit_process.php" method="POST" enctype="multipart/form-data" class="form">
                                <input type="hidden" name="type" value="update">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                
                                <div
                        
                                style="max-width: 600px;">
                        
                                <div class="form-group">
                <label for="title"> Titulo: </label>
                <input type="text" class="form-control" name="title" value=" <?= $movieData["title"] ?>"  placeholder="Digite o nome do filme">
            </div>
            <div class="form-group">
                <label for="image"> Imagem: </label>
                <input type="file"  name="image" class="form-control-file" id="image">
            </div>
            
            <div class="form-group">
                <label for="length"> Duração: </label>
                <input type="text" class="form-control" name="duration"  value=" <?= $movieData["length"] ?>" id="image" placeholder="duração do filme">
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
                <input type="text" class="form-control" name="triller" value="<?= $movieData["trailer"]  ?>"  id="thriller" placeholder="digite o link do filme">
            </div>

            <div class="form-group">
                <label for="description"> Descrição: </label>
                <textarea name="desc" id="desc" cols="30" rows="10" class="form-control" placeholder="Descreva o filme">
                    <?= $movieData["description"] ?>
                </textarea>
            </div>

            <button type="submit" id="card-btn">
                salvar
            </button>
                        
                        </form>
                    </section>
                            
      </main>
               

                         


<?php

require_once("./templates/footer.php");


?>