<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyMoney Bank</title>
    <link rel="icon" href="images/Profile/mini logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="Styles.css">
    <link rel="stylesheet" href="StylesTheme.css">
</head>

<body>
    <nav class="navBar">
        <a href="Home.php"><img src="images/svgviewer-output (1) (1).svg" id="logo" alt=""></a>

        <div class="navItems">
            <a href="#home">Home</a>
            <a href="#about">About</a>
            <a href="#contact">Contact</a>
            <a href="#">Blog</a>
            <i id="theme">Dark Mode</i>
        </div>

        <?php
            if (isset($_SESSION["usersUid"])) {
                echo "<a href='Profile.php'><button>Profile</button></a>";
            }
            else{
                echo "<a href='Registration.php'><button>Get Started</button></a>";
            } 
        ?>
    </nav>

    <header class="headerSection" id="home">
        <div class="headerText">
            <h1>Next Generation of Getting EasyMoney</h1>
            <p>Take your financial life online. Your EasyMoney bank account<br>
                will be one of the safest for spending, stealing, <br>
                investing and much more.
            </p>

            <?php
            if (isset($_SESSION["usersUid"])) {
                echo "<a href='Profile.php'><button>Profile</button></a>";
            } else {
                echo "<a href='Registration.php'><button>Get Started</button></a>";
            }
            ?>
        </div>

        <div class="headerImage">
            <img src="images/svgviewer-output.svg" id="headerImg" alt="">
        </div>
    </header>

    <div class="container" id="about">
        <section class="whyUs">
            <h1>Why choose EasyMoney Bank?</h1>
            <p>Legends say that EasyMoney EasyMoney Al-Tahina tastes like honey.<br>
                EasyMoney EasyMoney life tastes like honey.
            </p>
        </section>

        <section class="featuresSection">
            <div class="featureItem">
                <img src="/images/online.svg" alt="">
                <h1>Online Banking</h1>
                <p>
                    Our modern web and mobile<br>
                    applications allow you to keep<br>
                    track of your finances whereever<br>
                    you are in the world.
                </p>
            </div>

            <div class="featureItem">
                <img src="/images/Simple Budgeting.svg" alt="">
                <h1>Simple Budgeting</h1>
                <p>
                    See exactly where your money<br>
                    goes every month. Recieve<br>
                    notifications when you're getting<br>
                    stolen by one of our clients.
                </p>
            </div>

            <div class="featureItem">
                <img src="/images/Onboarding.svg" alt="">
                <h1>Fast Onboarding</h1>
                <p>
                    We don't do branches. Open your<br>
                    account online and start taking<br>
                    control of your finances<br>
                    right away.
                </p>
            </div>

            <div class="featureItem">
                <img src="/images/api.svg" alt="">
                <h1>Easy Starting</h1>
                <p>
                    Manage your savings, investments,<br>
                    salary, and much more from one<br>
                    account. Tracking your money<br>
                    has become easier.
                </p>
            </div>
        </section>
    </div>

    <footer class="footer" id="contact">
        <div class="footerContainer">
            <div class="socialContainer">
                <a href="https://www.facebook.com" target="_blank"><img src="/images/facebook.svg" alt=""></a>
                <a href="https://www.instagram.com" target="_blank"><img src="/images/instagrame.svg" alt=""></a>
                <a href="https://www.twitter.com" target="_blank"><img src="/images/twitter.svg" alt=""></a>
                <a href="https://www.youtube.com" target="_blank"><img src="/images/youtube.svg" alt=""></a>
            </div>

            <div class="menu">
                <a href="#about">About us</a>
                <a href="#">Contact us</a>
                <a href="#">Blog</a>
            </div>

            <div class="menu">
                <a href="#">Carriers</a>
                <a href="#">Support</a>
                <a href="#">Privacy Policy</a>
            </div>

            <?php
            if (isset($_SESSION["usersUid"])) {
                echo "<a href='Profile.php'><button>Profile</button></a>";
            } else {
                echo "<a href='Registration.php'><button>Get Started</button></a>";
            }
            ?>
        </div>
    </footer>

    <script src="Index.js"></script>
</body>

</html>