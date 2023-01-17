<?php 
    session_start();
    require "connect.php";

    if (!isset($_SESSION['presName']) && !isset($_SESSION['viceName'])) {
        header("Location: newProfile.php");
    }
    // select the id from vote database
    $email = $_SESSION['email'];
    $userIDquery1 = "SELECT * FROM users WHERE email = '$email'";
    $userIDresult = mysqli_fetch_assoc(mysqli_query($con, $userIDquery1));
    $userID = $userIDresult['ID'];
    $userName = $userIDresult['fullName'];

    $viceIDquery = "SELECT * FROM vote WHERE userID = '$userID'";
    $viceIDresult = mysqli_fetch_assoc(mysqli_query($con, $viceIDquery));
    $viceID = $viceIDresult['viceID'];
    $presIDquery = "SELECT * FROM vote WHERE userID = '$userID'";
    $presIDresult = mysqli_fetch_assoc(mysqli_query($con, $presIDquery));
    $presID = $presIDresult['presID'];
    
    $presNameQuery = "SELECT fullName FROM presCandidates WHERE ID = '$presID'";
    $presNameResult = mysqli_fetch_assoc(mysqli_query($con, $presNameQuery));
    $presName = $presNameResult['fullName'];

    $viceNameQuery = "SELECT fullName FROM viceCandidates WHERE ID = '$viceID'";
    $viceNameResult = mysqli_fetch_assoc(mysqli_query($con, $viceNameQuery));
    $viceName = $viceNameResult['fullName'];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <title>
        <?php echo "$userName"?>
    </title>
</head>

<body>

    <nav class="navBar">
        <img src="../imgs/political2.png" alt="">
        <div class="logoutDiv">
            <h4> <a href="logout.php" class="Button">Logout</a> </h4>
            <img src="../imgs/systemlogout_103399.png" alt="">  
        </div>
    </nav>

    <section class="content">
        <section class="menu">
            <aside>
    
                <ul>
                    <li>
                        <div class="element">
                            <img src="../imgs/home.svg" alt="">
                            <a href="home.php">Home</a>
                        </div>
                    </li>
                    <li>
                        <div class="element">
                            <img src="../imgs/profile.svg" alt="">
                            <a href="#">Profile</a>                        
                        </div>
                    </li>
                </ul>
                
            </aside>
        </section>

        <section class="main">
            <div class="mainHead">
                <div class="voters">
                    <h1>Name: </h1>
                    <hr>
                    <div class="votersBody">
                        <h3>
                            <?php 
                                echo "$userName";
                            ?>
                        </h2>
                    </div>
                </div>
                <div class="voters"  id="voted">
                    <h1>Email: </h1>
                    <hr>
                    <div class="votersBody">
                        <h3>
                            <?php 
                                echo "$email";
                            ?>
                        </h3>
                    </div>
                </div>
            </div>

            <div class="mainBody">
                <h3>Voted to: </h3>
                <h1 class="headers">President</h1>
                <div class="presCandidates">
                    <div class="candContainer">
                        <div class="cand">
                            <h4>
                                <?php 
                                    echo "$presName";
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
                
                <hr> 

                <h1 class="headers">Vice President</h1>
                <div class="viceCandidates">
                    <div class="candContainer">
                        <div class="cand">
                            <h4>
                                <?php 
                                    echo "$viceName";
                                ?>
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </section>

</body>
</html>