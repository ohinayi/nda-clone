<?php

namespace Dell\NdaPortal;

use Dell\NdaPortal\View;
use PDO;

class Register
{
    private string $name;
    private string $otherNames;
    private string $email;
    private string $confirmEmail;
    private string $phoneNumber;
    private string $password;
    private string $confirmPassword;

    public function resolve()
    {
        return (new View("hello"))->resolve();
    }

    public function poo()
    {
        session_start();


        if (!isset($_SESSION['emailError'])) {
            $_SESSION['emailError'] = '';
        }
        if (!isset($_SESSION['passwordError'])) {
            $_SESSION['passwordError'] = '';
        }
        if (!isset($_SESSION['fieldError'])) {
            $_SESSION['fieldError'] = '';
        }

        $this->name = $_POST["name"];
        $this->otherNames = $_POST["othernames"];
        $this->email = $_POST["email"];
        $this->confirmEmail = $_POST["confirm-email"];
        $this->phoneNumber = $_POST["number"];
        $this->password = $_POST["password"];
        $this->confirmPassword = $_POST["confirm-password"];
        $currentDate = date('Y-m-d H:i:s');

        if ($this->email !== $this->confirmEmail) {
            $_SESSION['emailError'] = 'The email addresses do not match';
        }
        if ($this->password !== $this->confirmPassword) {
            $_SESSION['passwordError'] = 'The passwords do not match';
        }
        if (!$this->password || !$this->name ||!$this->confirmPassword ||!$this->confirmEmail || !$this->email || !$this->phoneNumber || !$this->otherNames ) {
            $_SESSION['fieldError'] = 'All fields are required';
        }else{
            $pdo  = new PDO('mysql:host=localhost;port=3306;dbname=nda', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            $statement = $pdo->prepare("SELECT COUNT(*) FROM signin_students WHERE email = :email");
            $statement->bindParam(':email', $this->email);
            $statement->execute();
            $count = $statement->fetchColumn();
    
            if ($count > 0) {
                $_SESSION['emailError'] = 'This email is already registered';
            }
        }

    
        if (!empty($_SESSION['emailError']) || !empty($_SESSION['passwordError']) || !empty($_SESSION['fieldError'])) {
           
            header("Location: /");
            exit();
        } else {
            
            $pdo  = new PDO('mysql:host=localhost;port=3306;dbname=nda', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $statement = $pdo->prepare("INSERT INTO signin_students (name, othernames, number, email, password, create_date) VALUES (:name, :othernames, :number, :email, :password, :create_date)");
            $password = password_hash($this->password,PASSWORD_BCRYPT);
            $statement->bindParam(':name', $this->name);
            $statement->bindParam(':othernames', $this->otherNames);
            $statement->bindParam(':number', $this->phoneNumber);
            $statement->bindParam(':email', $this->email);
            $statement->bindParam(':password', $password);
            $statement->bindParam(':create_date', $currentDate);

            $statement->execute();
            echo "Uploaded successfully cadet.";
        }

        
        unset($_SESSION['emailError']);
        unset($_SESSION['fieldError']);
        unset($_SESSION['passwordError']);
    }
}
