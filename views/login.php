<?php 
 session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <link rel="stylesheet" type="text/css" href="views/hello.css">
</head>
<body>
    <div class="bod">
        <div class="welcome">
            <img src="https://storage.googleapis.com/comsoft-public/nda-logo.png" alt="ndaLogo">
            <h2>Nigerian Defense Academy</h2>
            <h3>Registration Page</h3>
        </div>
        <div class="signup">
            <form action="/logine" method="post">
                <div class="inputs-container">    
                    <img src="https://storage.googleapis.com/comsoft-public/nda-logo.png" alt="ndaLogo" class="login-img">
                    <h2> Sign into your account </h2>
                    <h3><a href="/register">You dont have an account? Register here!</a></h3>
                    <p class="err"><?php if (!empty($_SESSION['errors']['incorrectError'])) { echo $_SESSION['errors']['incorrectError']; } ?></p>
                    <label for="name" class="email">Email Address</label>
                    <input type="text" id="email" placeholder="Surname" name="email">
                    <label for="password" class="pass">Password</label>
                    <input type="password" id="password" placeholder="password" name="password" class="pad">
                    <button type="submit">Submit</button>
                    <?php if (!empty($_SESSION['errors']['fieldError'])) { echo $_SESSION['errors']['fieldError']; } ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>

<?php
        unset($_SESSION['errors']);
?>