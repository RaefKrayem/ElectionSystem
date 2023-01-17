<?php 
  require 'php/connect.php';
  require 'php/functions.php';

  if(isset($_POST['email']) && isset($_POST['password'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $result = mysqli_query($con, $query);

    if(mysqli_num_rows($result) > 0) {

      $row = mysqli_fetch_assoc($result);

      $_SESSION['email'] = $email;
      $_SESSION['password'] = $password;

      header("location:php/home.php");
      exit;

    } else {
      $_SESSION['errprompt'] = "Wrong email or password.";
    }

  }

  if(!isset($_SESSION['email'], $_SESSION['password'])) { 

?>






<!------------------------------------------------------------------
------------------------ html code ---------------------------------
------------------------------------------------------------------->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Login</title>
</head>
<body>
    
    <section class="mainContent">
        <div class="logoContainer">
            <img src="imgs/political2.png" alt="" class="logo">
        </div>

        <section class="loginContainer">

        <?php 
            if(isset($_SESSION['prompt'])) {
            showPrompt();
            }

            if(isset($_SESSION['errprompt'])) {
            showError();
            }
        ?>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="loginForm">
            <div class="container">
                <label for="email">Email address</label>
                <input type="email" id="email" name="email" required>
            </div>
            <br>
            <div class="container">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <br>
                <input type="submit" value="Login" id="loginButton" required>
            <br>
        </form>

        </section>

        <section class="signupContainer">
            <span>Don't have an account?</span>
            <a href="php/signup.php">SignUp</a>
        </section>
        

    </section>

</body>
</html>




<?php

  } else {
    header("location:php/home.php");
    exit;
  }

  unset($_SESSION['prompt']);
  unset($_SESSION['errprompt']);
?>