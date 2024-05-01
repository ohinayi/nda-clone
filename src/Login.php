<?php

namespace Dell\NdaPortal;

use PDO;

class Login
{

    private string $email;
    private string $password;

    public function loginPage()
    {
        return (new View("login"))->resolve();
    }

    public function verify()
    {
        session_start();
        unset($_SESSION['errors']);
        if (!isset($_SESSION['incorrectError'])) {
            $_SESSION['errors']['incorrectError'] = '';
        }
        if (!isset($_SESSION['fieldError'])) {
            $_SESSION['errors']['fieldError'] = '';
        }

        $this->email = $_POST['email'];
        $this->password = $_POST['password'];

        if (!$this->email || !$this->password) {
            $_SESSION['errors']['fieldError'] = 'All fields are essential';
        } else {
            $pdo  = new PDO('mysql:host=localhost;port=3306;dbname=nda', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $pdo->prepare("SELECT COUNT(*) FROM signin_students WHERE email = :email");
            $statement->bindParam(':email', $this->email);
            $statement->execute();
            $count = $statement->fetchColumn();

            if (!$count > 0) {
                $_SESSION['errors']['incorrectError'] = 'Username/Password combination is incorrect';
            } else {
                $statement = $pdo->prepare("SELECT password FROM signin_students WHERE email = :email");
                $statement->bindParam(':email', $this->email);
                $statement->execute();
                $password = $statement->fetchColumn();
                if (!password_verify($this->password, $password)) {
                    $_SESSION['errors']['incorrectError'] = 'Password combination is incorrect';
                }
            }
        }

        if (!empty($_SESSION['errors']['incorrectError']) || !empty($_SESSION['errors']['fieldError'])) {
            header("Location: /login");
            exit();
        } else {
            return (new View("new"))->resolve();
        }
    }
}
