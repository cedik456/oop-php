<?php
namespace Auth;

class AuthSystem {
    private $users = []; // Array to hold users
    private $storagePath; // Path to the users JSON file

    public function __construct($storagePath) {
        $this->storagePath = $storagePath;

        // Check if the file exists and is not empty
        if (file_exists($storagePath) && filesize($storagePath) > 0) {
            // Load existing users from the JSON file
            $fileContents = file_get_contents($storagePath);
            $decodedUsers = json_decode($fileContents, true);

            // Ensure the JSON decoded correctly
            if ($decodedUsers !== null) {
                $this->users = $decodedUsers;
            } else {
                echo "Error decoding JSON from file.";
            }
        } else {
            // Initialize the users array if the file doesn't exist or is empty
            $this->users = [];
        }
    }

    public function register($username, $password) {
        // Check if the username already exists
        foreach ($this->users as $user) {
            if ($user['username'] === $username) {
                return "Error: Username already exists.";
            }
        }

        // Register the new user
        $newUser = [
            'username' => $username,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
        ];
        $this->users[] = $newUser;

        // Save the users array to the JSON file
        if (file_put_contents($this->storagePath, json_encode($this->users, JSON_PRETTY_PRINT))) {
            return "User '$username' registered successfully!";
        } else {
            return "Error: Could not save user data.";
        }
    }

    public function login($username, $password) {
        // Check if the username exists and the password matches
        foreach ($this->users as $user) {
            if ($user['username'] === $username && password_verify($password, $user['password'])) {
                return "Login successful! Welcome, $username.";
            }
        }
        return "Error: Invalid username or password.";
    }
}
?>
