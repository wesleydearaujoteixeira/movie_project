<?php

require_once("./globals.php");
require_once("./db.php");
require_once("./models/User.php");
require_once("./dao/UserDAO.php");
require_once("./models/Message.php");

$msg = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);


$type = filter_input(INPUT_POST, "type");


if($type === "update") {

    // atualizando

    $name = filter_input(INPUT_POST, "name");
    $lastname = filter_input(INPUT_POST, "lastname");
    $email = filter_input(INPUT_POST, "email");
    $bio = filter_input(INPUT_POST, "bio");

    $user = $userDAO->verifyToken();


    $uploadDir = "uploads/";

// Verifica se o diretório existe, se não, cria
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}


if(isset($_FILE['image'])) {
    $message->setMessage("Imagem não enviada", "error", "back");

}else {
    echo "imagem enviada";

    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    $uploadDir = "uploads/";

    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'avi', 'webp'];

    if (in_array($fileExtension, $allowedExtensions)) {
        $uniqueFileName = uniqid('', true) . "." . $fileExtension;
        $filePathToSave = $uploadDir . $uniqueFileName;

        if (move_uploaded_file($fileTmpName, $filePathToSave)) {
          
            $echo =  $filePathToSave."<br>";
            echo "<img src=".$filePathToSave." alt=".">";

            $userDAO->update($user["id"], $name, $lastname, $email, $bio, $filePathToSave);


        } else {
            echo "Erro ao mover o arquivo!";
        }
    } else {
        echo "Tipo de arquivo não permitido!";
    }
}

}else if($type === "changePassword") {

    // atualizar senha

}



?>