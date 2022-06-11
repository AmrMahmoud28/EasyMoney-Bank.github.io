<?php
    session_start();
    if (!isset($_SESSION["usersUid"])) {
        header("location: ../Registration.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyMoney Bank</title>
    <link rel="icon" href="images/Profile/mini logo.svg" type="image/x-icon">

    <link rel="stylesheet" href="ProfileStyles.css">
    <link rel="stylesheet" href="StylesTheme.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Sharp:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
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

        <div class="profile">
            <div class="info">

                <?php
                    $fullName = $_SESSION["usersFullName"];
                    $name = explode(" ", $fullName);

                    echo "<p>Hey, <b>" . $name[0] . "</b></p>";
                ?>

            </div>

            <?php
                $username = $_SESSION["usersUid"];
                echo "<button class='profileCircle'>" . strtoupper($username[0]) . "<button>"
            ?>

        </div>
    </nav>

    <div class="container">
        <aside>
            <div class="sideBar">
                <a id="dashboardBtn" class="active"><span class="material-symbols-sharp">dashboard</span>
                    <h3>Dashboard</h3>
                </a>

                <a id="historyBtn"><span class="material-symbols-sharp">history</span>
                    <h3>History</h3>
                </a>

                <a id="depositBtn"><span class="material-symbols-sharp">paid</span>
                    <h3>Deposit</h3>
                </a>

                <a id="withdrawBtn"><span class="material-symbols-sharp">payments</span>
                    <h3>Withdraw</h3>
                </a>

                <a href="includes/logout.inc.php"><span class="material-symbols-sharp">logout</span>
                    <h3>Logout</h3>
                </a>
            </div>
        </aside>

        <div id="dashboard">
            <main>

                <?php
                    require_once 'includes/dbh.inc.php';

                    $_SESSION["totalIncome"] = 0;
                    $_SESSION["totalExpenses"] = 0;
                    $currentDate = date("Y-m-d");

                    $sql = "SELECT * FROM transactions WHERE usersUid = ? AND transactionsDate >= '$currentDate';";
                    $stmt = mysqli_stmt_init($conn);

                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("location: ../Profile.php?error=stmtFailed");
                        exit();
                    }

                    mysqli_stmt_bind_param($stmt, "s", $_SESSION["usersUid"]);
                    mysqli_stmt_execute($stmt);

                    $resultData = mysqli_stmt_get_result($stmt);

                    while($row = mysqli_fetch_assoc($resultData)){
                        if($row["transactionsType"] == "Deposit"){
                            $_SESSION["totalIncome"] += $row["transactionsAmount"];
                        }
                        else if($row["transactionsType"] == "Withdraw"){
                            $_SESSION["totalExpenses"] += $row["transactionsAmount"];
                        }
                    }
                    mysqli_stmt_close($stmt);
                ?>

                <h1>Dashboard</h1>

                <div class="insights">
                    <div class="balance">
                        <span class="material-symbols-sharp">account_balance</span>

                        <div class="middle">
                            <h3>Total Balance</h3>

                            <?php
                                echo "<h1>" . "$" . $_SESSION["usersBalance"] . "</h1>";
                            ?>
                        </div>
                    </div>

                    <div class="income">
                        <span class="material-symbols-sharp">stacked_line_chart</span>

                        <div class="middle">
                            <h3>Total Income</h3>

                            <?php
                                echo "<h1>" . "$" . $_SESSION["totalIncome"] . "</h1>";
                            ?>
                        </div>

                        <small class="textMuted">Last 24 Hours</small>
                    </div>

                    <div class="expenses">
                        <span class="material-symbols-sharp">bar_chart</span>

                        <div class="middle">
                            <h3>Total Expenses</h3>

                            <?php
                                echo "<h1>" . "$" . $_SESSION["totalExpenses"] . "</h1>";
                            ?>
                        </div>

                        <small class="textMuted">Last 24 Hours</small>
                    </div>
                </div>

                <div class="recentTransaction">
                    <h2>Recent Transactions</h2>

                    <table>
                        <thead>
                            <tr>
                                <th>Transaction Type</th>
                                <th>Transaction Amount</th>
                                <th>Balance</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                require_once 'includes/dbh.inc.php';

                                $sql = "SELECT * FROM transactions WHERE usersUid = ? ORDER BY transactionsId DESC LIMIT 5;";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("location: ../Profile.php?error=stmtFailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt, "s", $_SESSION["usersUid"]);
                                mysqli_stmt_execute($stmt);

                                $resultData = mysqli_stmt_get_result($stmt);

                                while($row = mysqli_fetch_assoc($resultData)){
                                    $colorType = ($row["transactionsType"] == "Deposit") ? "#42ba96" : "#df4759	";
                                    echo 
                                    "<tr>
                                        <td style= 'color: $colorType'>" . $row["transactionsType"] . "</td>
                                        <td style= 'color: $colorType'>$" . $row["transactionsAmount"] . "</td>
                                        <td style= 'color: $colorType'>$" . $row["usersBalance"] . "</td>
                                        <td style= 'color: $colorType'>" . $row["transactionsDate"] . "</td>
                                    </tr>";
                                }
                                mysqli_stmt_close($stmt);
                            ?>

                        </tbody>
                    </table>
                    <a id="showAll">Show All</a>
                </div>
            </main>
        </div>

        <div id="dashboard1">
            <div class="right">
                <h2>Credit Card</h2>
                <div class="card">
                    <div class="top">
                        <img src="/images/svgviewer-output (1) (1).svg" alt="" class="left">
                        <img src="/images/Profile/Visa_2021.svg" alt="" class="right">
                    </div>

                    <div class="middle">

                        <?php
                            echo "<h2>" . $_SESSION["usersCardNumber"] . "</h2>"
                        ?>

                        <img src="/images/Profile/card chip.png" alt="" class="chip">
                    </div>

                    <div class="bottom">
                        <div class="left">
                            <small>Card Holder</small>

                            <?php
                                echo "<h4>" . $_SESSION["usersFullName"] . "</h4>"
                            ?>

                        </div>

                        <div class="rightInfo">
                            <div class="expiry">
                                <small>Expires End Of</small>

                                <?php
                                    echo "<h4>" . $_SESSION["usersCardExpires"] . "</h4>"
                                ?>
                                
                            </div>

                            <div class="CVV">
                                <small>CVV</small>

                                <?php
                                    echo "<h4>" . $_SESSION["usersCardCVV"] . "</h4>"
                                ?>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="personalInfo">
                    <h2>Personal Information</h2>
                    <div class="info">
                        <div class="row">
                            <a><span class="material-symbols-sharp">person</span>

                                <?php
                                    echo "<p><b>Name : </b>" . $_SESSION["usersFullName"] . "</p>"
                                ?>
                                
                            </a>
                        </div>

                        <div class="row">
                            <a><span class="material-symbols-sharp">account_circle</span>

                                <?php
                                    echo "<p><b>Username : </b>" . $_SESSION["usersUid"] . "</p>"
                                ?>
                                
                            </a>
                        </div>

                        <div class="row">
                            <a><span class="material-symbols-sharp">mail</span>

                                <?php
                                    echo "<p><b>Email : </b>" . $_SESSION["usersEmail"] . "</p>"
                                ?>
                                
                            </a>
                        </div>

                        <div class="row">
                            <a><span class="material-symbols-sharp">credit_card</span>

                                <?php
                                    echo "<p><b>Card Number : </b>" . $_SESSION["usersCardNumber"] . "</p>"
                                ?>
                                
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="history">
            <h1>History</h1>

            <div class="recentTransaction">
                    <table>
                        <thead>
                            <tr>
                                <th>Transaction Type</th>
                                <th>Transaction Amount</th>
                                <th>Balance</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php
                                require_once 'includes/dbh.inc.php';

                                $sql = "SELECT * FROM transactions WHERE usersUid = ? ORDER BY transactionsId DESC LIMIT 20;";
                                $stmt = mysqli_stmt_init($conn);

                                if (!mysqli_stmt_prepare($stmt, $sql)) {
                                    header("location: ../Profile.php?error=stmtFailed");
                                    exit();
                                }

                                mysqli_stmt_bind_param($stmt, "s", $_SESSION["usersUid"]);
                                mysqli_stmt_execute($stmt);

                                $resultData = mysqli_stmt_get_result($stmt);

                                while($row = mysqli_fetch_assoc($resultData)){
                                    $colorType = ($row["transactionsType"] == "Deposit") ? "#42ba96" : "#df4759	";
                                    echo 
                                    "<tr>
                                        <td style= 'color: $colorType'>" . $row["transactionsType"] . "</td>
                                        <td style= 'color: $colorType'>$" . $row["transactionsAmount"] . "</td>
                                        <td style= 'color: $colorType'>$" . $row["usersBalance"] . "</td>
                                        <td style= 'color: $colorType'>" . $row["transactionsDate"] . "</td>
                                    </tr>";
                                }
                                mysqli_stmt_close($stmt);
                            ?>

                        </tbody>
                    </table>
                </div>
        </div>

        <div id="deposit">
            <h1>Deposit</h1>

            <div class="insights">
                <div class="balance">
                    <span class="material-symbols-sharp">account_balance</span>

                    <div class="middle">
                        <h3>Total Balance</h3>

                        <?php
                            echo "<h1>" . "$" . $_SESSION["usersBalance"] . "</h1>";
                        ?>

                    </div>
                </div>

                <div class="income">
                    <span class="material-symbols-sharp">stacked_line_chart</span>

                    <div class="middle">
                        <h3>Total Income</h3>

                        <?php
                            echo "<h1>" . "$" . $_SESSION["totalIncome"] . "</h1>";
                        ?>
                    </div>

                    <small class="textMuted">Last 24 Hours</small>
                </div>
            </div>

            <div class="box">
                <div class="left">
                    <div class="top">
                        <button class="depositAmountBtn">$5</button>
                        <button class="depositAmountBtn">$10</button>
                        <button class="depositAmountBtn">$50</button>
                        <button class="depositAmountBtn">$60</button>
                    </div>

                    <div class="bottom">
                        <button class="depositAmountBtn">$100</button>
                        <button class="depositAmountBtn">$200</button>
                        <button class="depositAmountBtn">$300</button>
                        <button class="depositAmountBtn">$500</button>
                    </div>
                </div>

                <form action="includes/deposit.inc.php" method="post">
                    <div class="right">
                        <h2>Deposit</h2>
                        <div class="inputField">
                            <i></i>
                            <input type="number" step=0.1 placeholder="Deposit Amount" id="depositField" name="depositAmount" required>
                        </div>
                        <input type="submit" value="Deposit" class="depositSubmit" name="depositSubmit">
                    </div>

                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "stmtFailed"){
                                echo '<script>alert("Something went wrong, try again!")</script>';
                            }
                        }
                    ?>
                </form>
            </div>
        </div>

        <div id="withdraw">
            <h1>Withdraw</h1>

            <div class="insights">
                <div class="balance">
                    <span class="material-symbols-sharp">account_balance</span>

                    <div class="middle">
                        <h3>Total Balance</h3>

                        <?php
                            echo "<h1>" . "$" . $_SESSION["usersBalance"] . "</h1>";
                        ?>

                    </div>
                </div>

                <div class="expenses">
                    <span class="material-symbols-sharp">bar_chart</span>

                    <div class="middle">
                        <h3>Total Expenses</h3>
                        <?php
                             echo "<h1>" . "$" . $_SESSION["totalExpenses"] . "</h1>";
                        ?>
                    </div>

                    <small class="textMuted">Last 24 Hours</small>
                </div>
            </div>

            <div class="box">
                <div class="left">
                    <div class="top">
                        <button class="withdrawAmountBtn">$5</button>
                        <button class="withdrawAmountBtn">$10</button>
                        <button class="withdrawAmountBtn">$50</button>
                        <button class="withdrawAmountBtn">$60</button>
                    </div>

                    <div class="bottom">
                        <button class="withdrawAmountBtn">$100</button>
                        <button class="withdrawAmountBtn">$200</button>
                        <button class="withdrawAmountBtn">$300</button>
                        <button class="withdrawAmountBtn">$500</button>
                    </div>
                </div>

                <form action="includes/withdraw.inc.php" method="post">
                    <div class="right">
                        <h2>Withdraw</h2>
                        <div class="inputField">
                            <i></i>
                            <input type="number" step=0.1 placeholder="Withdraw Amount" id="withdrawField" name="withdrawAmount" required>
                        </div>
                        <input type="submit" value="Withdraw" class="withdrawSubmit" name="withdrawSubmit">
                    </div>

                    <?php
                        if(isset($_GET["error"])){
                            if($_GET["error"] == "stmtFailed"){
                                echo '<script>alert("Something went wrong, try again!")</script>';
                            }
                        }
                    ?>
                </form>
            </div>
        </div>
    </div>

    <script src="ProfileIndex.js"></script>
    <script src="Index.js"></script>
</body>

</html>