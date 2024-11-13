<?php

require_once("./models/User.php");
require_once("./models/Message.php");


class UserDAO implements UserDAOinterface {

    private $conn;
    private $url;
    private $message;


    public function __construct(PDO $conn, $url) {
        $this->conn = $conn;
        $this->url = $url;
        $this->message = new Message($url);
    }




    public function builderUser($data) {



        $user = new User();

        $user->id = $data['id'];
        $user->name = $data['name'];
        $user->lastname = $data['lastname'];
        $user->email = $data['email'];
        $user->password = $data['password'];
        $user->image  = "";
        $user->token = $data['token'];
        $user->bio = "";



      
    }

    public function create(User $user, $authUser = false) {
        $stmt = $this->conn->prepare("INSERT INTO users (name, lastname, email, password, image, token, bio) VALUES (:name, :lastname, :email, :password, :image, :token, :bio)");
    
        $stmt->bindParam(":name", $user->name);
        $stmt->bindParam(":lastname", $user->lastname);
        $stmt->bindParam(":email", $user->email);
        $stmt->bindParam(":password", $user->password);
        $stmt->bindParam(":image", $user->image);
        $stmt->bindParam(":token", $user->token);
        $stmt->bindParam(":bio", $user->bio);
    
        $stmt->execute();

    
        // Autenticar o usuário caso o token seja true;

        if($authUser) {
            $this->setTokenToSession($user->token);
        }


    }
    public function update($id, $name, $lastname, $email, $bio, $image = "", $redirect = true) {

        $stmt = $this->conn->prepare("UPDATE users SET
        name = :name,
        lastname = :lastname,
        email = :email,
        bio = :bio,
        image = :image
        WHERE id = :id");


        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":lastname", $lastname);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":bio", $bio);
        $stmt->bindParam(":image", $image);
        $stmt->bindParam(":id", $id);

        $stmt->execute();

        if($redirect) {
            $this->message->setMessage("Perfil atualizado com sucesso!", "sucess", "editProfile.php");
        }



        
    }
        
    public function verifyToken($protected = false) {

        if(!empty($_SESSION["token"])) {

            $token = $_SESSION["token"];
            $user = $this->findByToken($token);
            return $user;
        } else if($protected){
            $this->message->setMessage("Faça a autenticação para acessar essa página!", "error", "index.php");
            return false;

        }


    }
    

    public function setTokenToSession($token, $redirect = true) {

        $_SESSION["token"] = $token;

        if ($redirect) {
            $this->message->setMessage("Seja Bem Vindo! ", "sucess", "editProfile.php");
        }

    }


    public function authenticateUser($email, $password) {

        $user = $this->findByEmail($email);
    
        if ($user) {
            if (password_verify($password, $user["password"])) {
    
                $token =  $user["token"];
                $_SESSION["token"] = $token;
                return true;

            } else {
                $this->message->setMessage("Senha Incorreta!", "error", "back");
                return false;
            }
        } else {
            $this->message->setMessage("Email não encontrado!", "error", "back");
            return false;
        }
    }
    public function findByEmail($email) {

        if ($email !== "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email", $email);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function findById($id) {

    }

    public function findByToken($token) {


        if ($token != "") {
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token", $token);
            $stmt->execute();
    
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch();
                return $data;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }


    public function changePassword(User $user) {

    }

    public function destroyToken () {
       
        $_SESSION["token"] = "";

        $this->message->setMessage("Usuário deslogado", "sucess", "index.php");


    }

}



?>