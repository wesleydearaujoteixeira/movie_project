<?php

require_once("./globals.php");
require_once("./db.php");
require_once("./models/User.php");
require_once("./dao/UserDAO.php");
require_once("./models/Message.php");


$msg = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);

$type = filter_input(INPUT_POST, "type");

if ($type === "register") {
    
    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");
    $confirmpassword = filter_input(INPUT_POST, "confirmpassword");


 

    if($name && $lastname && $email && $password) {
        if($password === $confirmpassword) {
            
            if($userDAO->findByEmail($email) === false){

                echo "Nenhum dado foi encontrado";

                $user = new User();

                var_dump($user);

                $userToken = $user->generateToken();
                $finalToken = $user->generatePassword($password);

                $user->name = $name;
                $user->lastname = $lastname;
                $user->email = $email;
                $user->password = $finalToken;
                $user->token = $userToken;


                $auth  = true;

                $userDAO->create($user, $auth);

            }else{
                $msg->setMessage("Usuário já cadastrado no sistema, utilize novos dados", "error", "back");

            }



        }else {
            $msg->setMessage("Senhas não conferem.", "error", "back");

        }

    }else {
        $msg->setMessage("Todos os campos devem ser preenchidos.", "error", "back");
    }



} else if ($type === "login") {
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

   
    $user = $userDAO->authenticateUser($email, $password);





    if($user){

        $msg->setMessage(" Usuário logado! ", "sucess", "editProfile.php");

        
    }else {
        $msg->setMessage(" Email e/ou senha inválidos.", "error", "back");
    }

}else {
    $msg->setMessage("informações inválidas.", "error", "index.php");
}



?>