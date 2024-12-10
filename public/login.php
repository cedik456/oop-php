<?php
require_once '../src/Auth/AuthSystem.php'; // Include the AuthSystem class

use Auth\AuthSystem;

// Initialize AuthSystem with the users.json file path
$auth = new AuthSystem('../storage/users.json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Attempt login and display the result
    $result = $auth->login($username, $password);
    echo $result;
}
