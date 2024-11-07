<?php


require_once("globals.php");
require_once("db.php");
require_once("models/Message.php");

$flasshMessage = [];

$msg = new Message($BASE_URL);
$flasshMessage = $msg->getMessage();



if(!empty($_SESSION["msg"])){
  $msg->clearMessage();
}




?>

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

        <form action="" method="get" id="search-form" class="form-inline my-2 my-lg-0">
            <input type="text" id="search" name="q" class="form-control mr-sm-2" type="search"
                placeholder="Search..."
                aria-label="Search"
            >
            <button type="submit" class="btn my-2 my-sm-0" class="btn-header">
                <i class="fas fa-search"></i>
            </button>

        </form>

        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="<?= $BASE_URL?>auth.php" class="nav-link"> Entrar/Cadastrar  </a>
                </li> 
            </ul>
        </div>

    </nav>
</header>

<?php if(!empty($flasshMessage["msg"])): ?>

    <div class="msg-container">
    
        <p class="msg <?= $flasshMessage["type"]?>"> <?= $flasshMessage["msg"] ?> </p>
    </div>

<?php endif; ?>


