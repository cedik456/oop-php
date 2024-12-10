<?php
namespace Auth;

class User {
    private $username;
    private $password;

    public function __construct($username, $password) {
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Securely hash password
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
}
?>
