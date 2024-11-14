<?php


require_once("./globals.php");
require_once("./db.php");
require_once("./models/Message.php");
require_once("./dao/userDAO.php");

$flasshMessage = [];

$msg = new Message($BASE_URL);
$flasshMessage = $msg->getMessage();



if(!empty($_SESSION["msg"])){
  $msg->clearMessage();
}

$userDAO = new UserDAO($conn, $BASE_URL);



$token = $_SESSION["token"];


$userData = $userDAO->findByToken($token);



?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> MovieStar </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.3/css/bootstrap.css" integrity="sha512-VcyUgkobcyhqQl74HS1TcTMnLEfdfX6BbjhH8ZBjFU9YTwHwtoRtWSGzhpDVEJqtMlvLM2z3JIixUOu63PNCYQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="style.css">

</head>

<header>
        <nav id="main-navbar" class="navbar-expand-lg">
            <a href="<?=$BASE_URL?>">
                <div>
                    <a href="./index.php">
                    <img src="./img/movie.logo.webp" id="logo" alt="movieLogo">
                    </a>

                </div>
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" 
            data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-bars ">

                </i>

            </button>

    <!-- Formulario de Busca  -->

        <form action="search_process.php" method="get" id="search-form" class="form-inline my-2 my-lg-0">
            <input type="text" id="search" name="search" class="form-control mr-sm-2" type="search"
                placeholder="Search..."
                aria-label="Search"
            >
            <button type="submit" class="btn my-2 my-sm-0" class="btn-header">
                <i class="fas fa-search"></i>
            </button>

        </form>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
               <?php if($userData):?>
                <p> ta logado </p>
                <li class="nav-item">
                    <a href="newMovie.php" method="GET" class="nav-link"> 
                        <i class="far fa-plus-square"></i>
                        incluir filmes
                    </a>
                       
                </li> 
                <li class="nav-item">
                    <a href="<?= $BASE_URL?>editProfile.php" class="nav-link bold"> <?= $userData["name"] ?> </a>
                </li> 
                <li class="nav-item">
                    <a href="<?= $BASE_URL?>dashboard.php" class="nav-link"> filmes </a>
                </li> 

                <li class="nav-item">
                    <a href="<?= $BASE_URL?>logout.php" class="nav-link"> sair </a>
                </li> 
                
                <?php else: ?>
                
                <li class="nav-item">
                    <a href="<?= $BASE_URL?>auth.php" class="nav-link"> Entrar/Cadastrar  </a>
                </li> 
                <?php endif;?>

            </ul>
        </div>

    </nav>
    
</header>

<?php if(!empty($flasshMessage["msg"])): ?>

    <div class="msg-container">
    
        <p class="msg <?= $flasshMessage["type"]?>"> <?= $flasshMessage["msg"] ?> </p>
    </div>

<?php endif; ?>


