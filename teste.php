<?php


require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");

$userDAO = new UserDAO($conn, $BASE_URL);

$email = "paulinhoDaPamonha@gmail.com";

$user = $userDAO->findByEmail($email);


$senha = "paulinho123";

$novaSenha = $user["password"];


echo $senha;
echo "<br>";
echo $novaSenha;

echo "<br>";


if(password_verify($senha, $novaSenha)) {
    echo "Senhas iguais";
} else {
    echo "Senhas diferentes";
}



?>