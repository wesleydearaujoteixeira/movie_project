<?php

$movie_id = $_POST['movie_id'];

require_once("./globals.php");
require_once("./db.php");
require_once("./models/User.php");
require_once("./dao/MovieDAO.php");

$message = new Message($BASE_URL);
$movieDAO = new MovieDAO($conn, $BASE_URL);

if ($movie_id) {
    // Call destroy without assigning it to a variable
    $movieDAO->destroy($movie_id);
} else {
    // Show error message if movie ID is missing
    $message->setMessage("Impossível remover esse filme", "error", "dashboard.php");
}

?>
