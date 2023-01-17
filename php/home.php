<?php 
    session_start();

    require 'connect.php';

    $email = $_SESSION['email'];
    $qry = "SELECT * FROM users WHERE email = '$email' AND voted = 0";
    $userResult = mysqli_query($con, $qry);

    // if the user already voted
    if (mysqli_num_rows($userResult) == 0) {
        header("Location: votedHome.php");
    }

    if (isset($_POST['vote'])) {
        $presName = $_POST['president'];
        $viceName = $_POST['vicePresident'];

        $_SESSION['presName'] = $presName;
        $_SESSION['viceName'] = $viceName;

        if (mysqli_num_rows($userResult) != 0) {
            $query = "UPDATE users SET voted = 1 WHERE email = '$email'";
            mysqli_query($con, $query);

            // increment the votersNum in pres and vice databases
            $query2 = "UPDATE prescandidates SET votesNum = votesNum + 1 WHERE fullName = '$presName'";
            mysqli_query($con, $query2);
            $query3 = "UPDATE vicecandidates SET votesNum = votesNum + 1 WHERE fullName = '$viceName'";
            mysqli_query($con, $query3);

            // take president id from the database 
            $presIDquery = "SELECT ID FROM prescandidates WHERE fullName = '$presName'";
            $viceIDquery = "SELECT ID FROM vicecandidates WHERE fullName = '$viceName'";
            $userIDquery = "SELECT ID FROM users WHERE email = '$email'";
            
            $presIDresult = mysqli_fetch_assoc(mysqli_query($con, $presIDquery));
            $presID = $presIDresult['ID'];
            $viceIDresult = mysqli_fetch_assoc(mysqli_query($con, $viceIDquery));
            $viceID = $viceIDresult['ID'];
            $userIDresult = mysqli_fetch_assoc(mysqli_query($con, $userIDquery));
            $userID = $userIDresult['ID'];
            
            // inserting the ids in the vote relation database 
            $query4 = "INSERT INTO `vote`(`userID`, `presID`, `viceID`) VALUES ('$userID','$presID','$viceID')";
            mysqli_query($con, $query4);

            header("Location: votedHome.php");
        }
        else {
            header("Location: votedHome.php");
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/home.css">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;300;400&display=swap" rel="stylesheet"> 
    <title>Home</title>
</head>
<body>
    
        <nav class="navBar">
            <img src="../imgs/political2.png" alt="" id="logo">
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
                            <a href="#">Home</a>
                        </div>
                    </li>
                    <li>
                        <div class="element">
                            <img src="../imgs/profile.svg" alt="">
                            <a href="profile.php">Profile</a>                          
                        </div>
                    </li>
                </ul>
                
            </aside>
        </section>

        <section class="main">
            <div class="mainHead">
                <div class="voters">
                    <h1>Voters</h1>
                    <hr>
                    <div class="votersBody">
                        <img src="../imgs/users.png" alt="">
                        <h1>
                            <?php 
                                $qry = "SELECT * FROM users";
                                $result = mysqli_query($con, $qry);
                                echo mysqli_num_rows($result);
                            ?>
                        </h1>
                    </div>
                </div>
                
                <div class="voters" id="voted">
                    <h1>Voted</h1>
                    <hr>
                    <div class="votersBody">
                        <img src="../imgs/user3.png" alt="" class="votedImg">
                        <h1>
                            <?php 
                                $qry = "SELECT * FROM users WHERE voted = 1";
                                $result = mysqli_query($con, $qry);
                                echo mysqli_num_rows($result);
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        

            <div class="mainBody">
                    <h1>Students Council Elections</h1>
                    <hr>

                    <form action="home.php" method="POST">
                    <h1 class="headers">President</h1>

                    <div class="presCandidates">
                        <div class="candContainer">
                            <img src="../imgs/Candidates/Eric.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Eric Charles</span>
                                <input type="radio" name="president" value="Eric Charles">
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Angela.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Angela Wood</span>
                                <input type="radio" name="president" value="Angela Wood">
                            </div>
                        </div>
                        </div>

                    <hr> 

                    <h1 class="headers">Vice President</h1>
                    <div class="viceCandidates">

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Jessica.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Jessica Ramirez</span>
                                <input type="radio" name="vicePresident" value="Jessica Ramirez">
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Adam.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Adam Baker</span>
                                <input type="radio" name="vicePresident" value="Adam Baker">
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Brandon.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span class="name">Brandon Washington</span>
                                <input type="radio" name="vicePresident" value="Brandon Washington">
                            </div>
                        </div>
                    </div>


                    <div class="voteContainer">
                        <input type="submit" value="Vote!" class="vote" name="vote">
                    </div>
                    
                    </form>

            </div>
        </section>
    </section>

</body>
</html>