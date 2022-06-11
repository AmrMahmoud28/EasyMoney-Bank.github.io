<?php
    sleep(1);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyMoney Bank</title>
    <link rel="icon" href="images/Profile/mini logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="RegistrationStyles.css">
    <link rel="stylesheet" href="StylesTheme.css">
</head>
<body>
    <nav class="navBar">
        <a href="Home.php"><img src="/images/svgviewer-output (1) (1).svg" id="logo" alt=""></a>

        <div class="navItems">
            <a href="Home.php">Home</a>
            <a href="Home.php#about">About</a>
            <a href="Home.php#contact">Contact</a>
            <a href="#">Blog</a>
            <i id="theme">Dark Mode</i>
        </div>
    </nav>

    <div class="container">
        <div class="formsContainer">
            <div class="signin-signup">
                <form action="includes/signin.inc.php" class="signinForm" method="post">
                    <h2 class="title">Sign in</h2>
                    <div class="inputField">
                        <i class="username"></i>
                        <input type="text" placeholder="Username / Email" name="usernameField" required>
                    </div>

                    <div class="inputField">
                        <i class="password"></i>
                        <input type="password" placeholder="Password" name="passwordField" required>
                    </div>

                    <input type="submit" value="Login" class="submit" name="signinSubmit">

                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "wrongLogin"){
                                echo '<script>alert("Inncorrect login information!")</script>';
                            }
                        }
                    ?>
                </form>

                <form action="includes/signup.inc.php" method="post" class="signupForm">
                    <h2 class="title">Sign up</h2>
                    <div class="inputField">
                        <i class="name"></i>
                        <input type="text" placeholder="Full Name" name="nameField" required>
                    </div>

                    <div class="inputField">
                        <i class="email"></i>
                        <input type="text" placeholder="Email" name="emailField" required>
                    </div>

                    <div class="inputField">
                        <i class="username"></i>
                        <input type="text" placeholder="Username" name="newUsernameField" required>
                    </div>

                    <div class="inputField">
                        <i class="password"></i>
                        <input type="password" placeholder="Password" name="newPasswordField" required>
                    </div>

                    <input type="submit" value="Sign up" class="submit" name="signupSubmit">

                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "invalidUid"){
                                echo '<script>alert("Choose a proper Username!")</script>';
                            }
                            else if($_GET["error"] == "invalidEmail"){
                                echo '<script>alert("Choose a proper Email!")</script>';
                            }
                            else if($_GET["error"] == "usernameTaken"){
                                echo '<script>alert("Username already taken!")</script>';
                            }
                            else if($_GET["error"] == "stmtFailed"){
                                echo '<script>alert("Something went wrong, try again!")</script>';
                            }
                        }
                    ?>
                </form>
            </div>
        </div>

        <div class="panelsContainer">
            <div class="panel leftPanel">
                <div class="content">
                    <h3>New User?</h3>
                    <p>Create an account and start your financial life online.</p>
                    <button class="submit transparent" id="signupBtn">Sign up</button>
                </div>

                <img src="/images/Registration/Sign up.svg" alt="" class="image">
            </div>

            <div class="panel rightPanel">
                <div class="content">
                    <h3>You have an account?</h3>
                    <p>Sign in and continue your financial life online.</p>
                    <button class="submit transparent" id="signinBtn">Sign in</button>
                </div>

                <img src="/images/Registration/sign in.svg" alt="" class="image">
            </div>
        </div>
    </div>
    
    <script src="RegistrationIndex.js"></script>
    <script src="Index.js"></script>
</body>
</html>