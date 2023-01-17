<?php 
    session_start();

    require 'connect.php';
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
                            <a href="#" class="Links">Home</a>
                        </div>
                    </li>
                    <li>
                        <div class="element">
                            <img src="../imgs/profile.svg" alt="">
                            <a href="profile.php" class="Links">Profile</a>                        
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
                <div class="voters"  id="voted">
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

                    <form action="" method="POST">
                    <h1 class="headers">President</h1>

                    <div class="presCandidates">
                        <div class="candContainer">
                            <img src="../imgs/Candidates/Eric.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Eric Charles</span>
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Angela.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Angela Wood</span>
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
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Adam.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span>Adam Baker</span>
                            </div>
                        </div>

                        <div class="candContainer">
                            <img src="../imgs/Candidates/Brandon.jpg" alt="" class="candProfile">
                            <div class="cand">
                                <span class="name">Brandon Washington</span>
                            </div>
                        </div>
                    </div>


                    <div class="voteContainer">
                        <div class="votedd"> 
                            <span>Voted!</span>
                        </div>
                    </div>
                    
                    </form>

            </div>
        </section>
    </section>




</body>
</html>