<?php 
session_start()
?>
<!DOCTYPE html>
<html>
<head>
    <title>Home Page</title>
    <link rel="stylesheet" type="text/css" href="views/hello.css">
</head>
<body>
    <div class="bod">
        <div class="welcome">
            <img src="https://storage.googleapis.com/comsoft-public/nda-logo.png" alt="ndaLogo" class="welcome-img">
            <h2>Nigerian Defense Academy</h2>
            <h3>Registration Page</h3>
        </div>
        <div class="signup">
            <form action="/register" method="post">
                <div class="inputs-container">    
                    <img src="https://storage.googleapis.com/comsoft-public/nda-logo.png" alt="ndaLogo" class="register-img">
                    <h2>Register an account </h2>
                    <h3><a href="/login">already have an account ? Login here!</a></h3>
                    <label for="name" class="edge" >Surname</label>
                    <input type="text" id="name" placeholder="Surname" name="name">
                    <label for="othernames" class="extra">Other Names</label>
                    <input type="text" id="othernames" placeholder="Other Names" name="othernames">
                    <div class="error">
                        <?php if (!empty($_SESSION['emailError'])) { echo $_SESSION['emailError']; } ?>
                    </div>
                    <div class="double">
                        <div class="grid">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" placeholder="applicant@email.com" name="email" class="small-input">
                        </div>
                        <div class="grid">
                            <label for="confirm-email">Confirm Email Address</label> 
                            <input type="email" id="confirm-email" placeholder="applicant@email.com" name="confirm-email" class="small-input">
                        </div>
                    </div>
                    <label for="number"  class="extra" id="phone">Phone Number</label>
                    <input type="text" id="number" placeholder="0810000000" name="number">
                        <p>
                            <?php if (!empty($_SESSION['passwordError'])) { echo $_SESSION['passwordError']; } ?>
                        </p>
                    <div class="double">
                        <div class="grid">
                            <label for="password">Password </label>
                            <input type="password" id="password" placeholder="password" name="password" class="small-input">
                        </div>
                        <div class="grid">
                            <label for="confirm-password">Confirm Password</label>
                            <input type="password" id="confirm-password" placeholder="password" name="confirm-password" class="small-input">
                        </div>
                    </div>
                    <div class="field-error"><?php if (!empty($_SESSION['fieldError'])) { echo $_SESSION['fieldError']; }  ?></div>
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
<?php 
unset($_SESSION['fieldError']);
unset($_SESSION['passwordError']);
unset($_SESSION['emailError']);
?>