<?php

require_once("templates/header.php");
require_once("dao/userDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);


$userData = $userDAO->verifyToken(true);


if($userData["image"] == "") {
    $userData["image"] = "user-default.jpeg";
}


?>


        <div id="main-container" class="container-fluid">

            <div class="col-md-12">
                <form action="<?= $BASE_URL ?>users_process.php" method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="type" value="update">
                        <div class="row" id="responsive">
                            <div class="col-md-4">
                                <h1> <?=  $userData["name"]  ?>  </h1>
                                <p class="page-description"> Altere seus dados no formulário abaixo </p>
                                
                                <div class="form-group">
                                    <label for="name"> name </label>
                                
                                <input class="form-control" type="text" name="name" value="<?=  
                                $userData["name"]  ?>" 
                                placeholder="Digite seu nome"
                                >


                                </div>

                                <div class="form-group">
                                    <label for="lastname"> lastname </label>
                                
                                <input class="form-control" type="text" name="lastname" value="<?=  
                                $userData["lastname"]  ?>" 
                                placeholder="Digite seu sobrenome"
                                >


                                </div>


                                <div class="form-group">
                                    <label for="email"> email </label>
                                
                                <input class="form-control disabled" type="text" name="email" value="<?=  
                                $userData["email"]  ?>" 
                                placeholder="Digite seu email"
                                readonly
                                >


                                </div>

                                <button class="btn">
                                    Alterar
                                </button>

                                
                            </div>
                            <div class="col-md-4">
                                <div class="profile-image-container" style="background-image: url(<?= $BASE_URL ?>/ img/users/<?= $userData["image"] ?>)">
                                <div class="form-group">
                                    <label for="name"> imagem </label>
                                
                                <input  type="file" name="image" value="<?=  
                                $userData["image"]  ?>" 
                                placeholder="Digite seu nome"
                                >


                                </div>

                                </div>

                                <div class="form-group">
                                <label for="name"> bio </label>           
                                <textarea name="bio" class="form-control" rows="5" placeholder="Conte um pouco sobre você" value="<?=   $userData["bio"] ?>"></textarea>


                                </div>

                                </div>



                            </div>
                        </div>
                </form>
            </div>

        </div>


<?php

require_once("templates/footer.php");


?>