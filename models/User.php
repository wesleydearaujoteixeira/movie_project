<?php


class User {

    public $id;
    public $name;
    public $lastname;
    public $email;
    public $password;
    public $image;
    public $token;
    public $bio;


    public function generateToken () {
        return $this->token = bin2hex(random_bytes(60));
    }

    public function generatePassword($password) {
       return  $this->password = password_hash($password, PASSWORD_DEFAULT);
    }


}

interface UserDAOinterface {

    public function builderUser($data);
    public function create(User $user, $authUser = false);
    public function update(User $user);
    public function verifyToken($protected = false);
    public function setTokenToSession($token, $redirect = true);
    public function authenticateUser($email, $password);
    public function findByEmail($email);
    public function findById($id);
    public function findByToken($token);
    public function changePassword(User $user);


}





?>