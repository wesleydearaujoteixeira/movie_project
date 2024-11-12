<?php

require_once("globals.php");
require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("models/Message.php");

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


if (isset($_FILES['image'])) {
    // Informações do arquivo
    $fileName = $_FILES['image']['name'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Diretório de upload
    $uploadDir = "uploads/";

    // Extensões permitidas
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'avi', 'webp'];

    // Verifica se a extensão do arquivo é permitida
    if (in_array($fileExtension, $allowedExtensions)) {
        // Define um nome único para o arquivo
        $uniqueFileName = uniqid('', true) . "." . $fileExtension;
        $filePathToSave = $uploadDir . $uniqueFileName;

        // Move o arquivo para o diretório de upload
        if (move_uploaded_file($fileTmpName, $filePathToSave)) {
            // Caminho do arquivo salvo no banco de dados
            // Atualiza o banco com o caminho do arquivo
            $userDAO->update($user["id"], $name, $lastname, $email, $bio, $filePathToSave);
            echo "Arquivo enviado e caminho salvo no banco de dados!";
        } else {
            echo "Erro ao mover o arquivo!";
        }
    } else {
        echo "Tipo de arquivo não permitido!";
    }
} else {
    echo "Nenhum arquivo enviado ou erro no envio!";
}





}else if($type === "changePassword") {

    // atualizar senha

}



?>