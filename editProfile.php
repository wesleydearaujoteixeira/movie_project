<?php

require_once("templates/header.php");
require_once("dao/userDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);


$userData = $userDAO->verifyToken(true);


if($userData["image"] == "" || $userData["image"] == null) {
    $userData["image"] = "user-default.jpeg";
}


$image = $userData["image"];
                             
if(!$image || $image == null || $image == "") {
   $image = "img/users/user-default.jpeg";

}


?>

        <main id="profile-container" class="container-fluid">

                        <img class="image" src="<?= $image ?>" alt="logo">
                
    
                    <section>
                        <form action="users_process.php" method="POST" enctype="multipart/form-data" class="form">
                                <input type="hidden" name="type" value="update">
                                <div
                        
                                style="max-width: 600px;" >
                        
                                        <h1> <?=  $userData["name"]  ?>  </h1>
                                        <p class="page-description"> Altere seus dados no formulário abaixo </p>
                        
                                        <div class="form-group" >
                                            <label for="name" > name </label>
                        
                                        <input class="form-control" style="width: " type="text" name="name" value="<?=
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
                        
                                    </div>
                                <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="name"> imagem </label>
                        
                                        <input  type="file" name="image" placeholder="Digite seu nome">
                                        </div>
                                    </div>
                                <div class="form-group">
                                        <label for="name"> bio </label>
                                        <textarea name="bio" class="form-control" style="max-width: 600px;"  placeholder="Conte um pouco sobre você">
                                        </textarea>
                                        <button id="card-btn">
                                            Alterar
                                        </button>
                        
                        </form>
                    </section>
                            
      </main>
               

                         


<?php

require_once("templates/footer.php");


?>