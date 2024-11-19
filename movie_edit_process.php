<?php

require_once("./globals.php");
require_once("./db.php");
require_once("./models/User.php");
require_once("./dao/UserDAO.php");
require_once("./dao/MovieDAO.php");

// Instâncias das classes
$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);

// Dados recebidos do formulário
$id_process = $_POST["id"] ?? null;
$type = $_POST["type"] ?? null;

$title = htmlspecialchars($_POST["title"] ?? "");
$description = htmlspecialchars($_POST["desc"] ?? "");
$trailer = htmlspecialchars($_POST["triller"] ?? "");
$category = htmlspecialchars($_POST["category"] ?? "");
$length = htmlspecialchars($_POST["duration"] ?? "");

// Verificação se é uma atualização
if ($id_process && $type === "update") {

    // Verificar se uma imagem foi enviada
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $message->setMessage("Imagem não enviada ou com erro.", "error", "back");
    } else {
        $fileName = $_FILES['image']['name'];
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        $uploadDir = "uploads/";
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];

        // Verificar a extensão do arquivo
        if (in_array($fileExtension, $allowedExtensions)) {
            $uniqueFileName = uniqid('', true) . "." . $fileExtension;
            $image = $uploadDir . $uniqueFileName;

            // Mover o arquivo para o diretório de upload
            if (move_uploaded_file($fileTmpName, $filePathToSave)) {
                // Atualizar no banco de dados
                $movieDAO->update($title, $description, $image, $trailer, $category, $length, $id_process);

                $message->setMessage("Filme atualizado com sucesso!", "success", "dashboard.php");
            } else {
                $message->setMessage("Erro ao mover o arquivo.", "error", "back");
            }
        } else {
            $message->setMessage(
                "Tipo de arquivo não permitido! Permitidos: " . implode(", ", $allowedExtensions),
                "error",
                "back"
            );
        }
    }
} else {
    $message->setMessage("Requisição inválida.", "error", "dashboard.php");
}

?>
