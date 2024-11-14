
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MovieStar </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="container-fluid">
      <!-- Cabeçalho da aplicação -->
    
         <?php
         require_once("./templates/header.php");
         require_once("./dao/MovieDAO.php");
         require_once("./dao/UserDAO.php");


        $userDAO = new UserDAO($conn, $BASE_URL);
        $token = $_SESSION["token"];
        $userData = $userDAO->findByToken($token);
        $userData = $userDAO->verifyToken(true);


          $movies = new MovieDAO($conn, $BASE_URL);

          $search = $_GET["search"];

          $movieSearch = $movies->findByTitle($search);


        if ($movieSearch && is_array($movieSearch)) {
            $count = count($movieSearch);
            // Continue processing with $count...
        } else {
            $count = 0;
            echo "No results found or query failed.";
        }
        

          // print_r($newMovies); // Pode ser útil para depuração, mas remova em produção
         ?>
         
         <div >
            <h2 class="section-title"> Resultado </h2>
            <p class="section-description"> encontramos <?= $count ?> resultados para <?= $search ?>  </p>
            <div class="movie-container">
                <?php 
                // Verificando se existem filmes
                if ($movieSearch) {
                    // Percorrendo o array de filmes
                    foreach ($movieSearch as $movie) {
                ?>
                    <div id="#">
                        <div class="card movie-card">
                            <img src="<?= $movie["image"] ?>" class="img" alt="Imagem do filme">
                            <div class="card-body">
                                <p class="card-rating">
                                    <i class="fas fa-star"></i>
                                    <span class="rating"> 9 </span> <!-- Aqui você pode usar a nota do filme, se tiver no seu banco -->
                                </p>
                                <h5 class="card-title"> <?= $movie["title"] ?> </h5> <!-- Corrigido: exibe o título do filme -->
                                <a href="#" class="btn btn-primary rate-btn"> Avaliar </a>
                                <a href="#" class="btn btn-primary" id="card-btn"> Conhecer </a>
                            </div>
                        </div>
                    </div>
                <?php 
                    }
                } else {
                    echo "<p>Nenhum filme encontrado.</p>";  // Caso não haja filmes
                }
                ?>
            </div>
            

        </div>
     
        <?php
         require_once("./templates/footer.php");
         ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/js/bootstrap.js" integrity="sha512-lsA4IzLaXH0A+uH6JQTuz6DbhqxmVygrWv1CpC/s5vGyMqlnP0y+RYt65vKxbaVq+H6OzbbRtxzf+Zbj20alGw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
