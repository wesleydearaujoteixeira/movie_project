<?php

require_once("./globals.php");
require_once("./db.php");
require_once("./models/User.php");
require_once("./dao/UserDAO.php");
require_once("./dao/MovieDAO.php");

$message = new Message($BASE_URL);
$userDAO = new UserDAO($conn, $BASE_URL);

$movieDAO = new MovieDAO($conn, $BASE_URL);


$type = $_POST["type"];
$id = $_POST["id"];

if ($id && $type == "create") {

    $name_movie = $_POST["title"];
    $desc = $_POST["desc"];
    $category = $_POST["category"];
    $triller = $_POST["triller"];
    $duration = $_POST["duration"];


    if(!empty($name_movie) && !empty($desc) && !empty($category)) {

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

                    $movieDAO->create($name_movie, $desc, $filePathToSave, $triller, $category, $duration, intval($id));






                } else {
                    echo "Erro ao mover o arquivo!";
                }
            } else {
                echo "Tipo de arquivo não permitido!";
            }






        }

    }
    else {

        $message->setMessage(" Envie pelo menos 3 categorias!", "error", "back");

}



















}


else {
    $message->setMessage(" Dados inválidos!", "error", "back");
}






?>