<?php

class Message {
    
    private $url;
    

    public function __construct($url) {
        $this->url = $url;
    }
    
    
    public function setMessage($msg, $type, $redirect = "index.php") {

        session_start(); // Inicia a sessão, caso não esteja iniciada
        $_SESSION["msg"] = $msg;
        $_SESSION["type"] = $type;
    
        if ($redirect !== "back") {
            header("Location: " . $this->url . $redirect);
        } else {
            $previousUrl = $_SERVER["HTTP_REFERER"] ?? $this->url . "index.php"; // Redireciona para a página inicial se HTTP_REFERER não estiver disponível
            header("Location: " . $previousUrl);
        }
        exit(); // Garante que o redirecionamento é realizado
    }

    public function getMessage() {

        if(!empty($_SESSION['msg'])) {
            return [
                "msg" => $_SESSION["msg"],
                "type" => $_SESSION["type"],
            ];

        }
        else {
            return false;
        }

    }

    public function clearMessage() {
        
        $_SESSION["msg"] = "";
        $_SESSION["type"] = "";
    }
    
}