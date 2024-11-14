<?php

require_once("./templates/header.php");
require_once("./dao/userDAO.php");
require_once("./dao/movieDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);
$userData = $userDAO->verifyToken(true);

$movieDAO = new MovieDAO($conn, $BASE_URL);
$movies = $movieDAO->getMovieByUserId($userData['id']);

?>

<body id="main-container" class="container-fluid">
    <div>
        <h2 class="section-title">Dashboard</h2>
        <p class="section-description">Adicione ou atualize as informações dos filmes que você enviou</p>
    
        <div class="col-md-12" id="add-movie-container">
            <a href="newmovie.php" id="card-btn">
                <i class="fas fa-plus"></i> Adicionar Filmes
            </a>
        </div>
    
        <div class="col-md-12" id="movies-dashboard">
            <?php if (count($movies) > 0): ?>
                <div class="movie-cards">
                    <?php foreach ($movies as $movie): ?>
                        <div class="movie-card">
                            <h3 class="movie-title"><?php echo htmlspecialchars($movie['title']); ?></h3>
                            <p class="movie-rating"><i class="fas fa-star"></i> 9 </p>
                            <div class="movie-actions">
                                <a href="editmovie.php?id=<?php echo $movie['id']; ?>" class="edit-btn">
                                    <i class="far fa-edit"></i> Editar
                                </a>
                                <form action="deletemovie.php" method="post" class="delete-form">
                                    <input type="hidden" name="movie_id" value="<?php echo $movie['id']; ?>">
                                    <button type="submit" class="delete-btn">
                                        <i class="fas fa-times"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <p>Nenhum filme encontrado.</p>
            <?php endif; ?>
        </div>
    </div>
</body>

<?php
require_once("./templates/footer.php");
?>
