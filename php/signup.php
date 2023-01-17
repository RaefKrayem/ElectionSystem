
<?php 

  
    require 'connect.php';
    require 'functions.php';
  
  
    if(isset($_POST['fullName']) && isset($_POST['email']) && isset($_POST['password'])) {

        $fullName = $_POST['fullName'];
        $email = $_POST['email'];
        $password = $_POST['password'];

  
      $query = "SELECT fullName FROM users WHERE fullName = '$fullName'";
      $result = mysqli_query($con,$query);
  
      if(mysqli_num_rows($result) == 0) {
        $query = "SELECT email FROM users WHERE email = '$email'";
        $result = mysqli_query($con,$query);
  
        if(mysqli_num_rows($result) == 0) {
          $query = "INSERT INTO users (fullName, email, password, voted)
          VALUES ('$fullName', '$email', '$password', 0)";

          $_SESSION['email'] = $email;
          $_SESSION['password'] = $password;
  
          if(mysqli_query($con, $query)) {
            $_SESSION['prompt'] = "Account registration done! You can now log in.";
            header("Location:../index.php");
            exit;
          } 
          else {
            die("Error with the query");
          }
  
        } 
        else {
          $_SESSION['errprompt'] = "That email already exists.";
        }

      } 
      else {
        $_SESSION['errprompt'] = "Username already exists.";
      }
  
   } 
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
    <link rel="stylesheet" href="../css/signup.css">
    <title>Signup</title>
</head>
<body>
    
    <section class="mainContent">
        <div class="logoContainer">
            <img src="../imgs/political2.png" alt="" class="logo">
        </div>

        <section class="loginContainer">

        <?php 
            if(isset($_SESSION['errprompt'])) {
            showError();
            }
        ?>


        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" id="loginForm">
            <div class="container">
                <label for="fullName">Full Name</label>
                <input type="fullName" id="fullName" name="fullName" required>
            </div>
            <br>
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

            <input type="submit" value="Signup" id="SignupButton">
            
            <br>
        </form>

        </section>

        <section class="secondContainer">
            <span>Have an account?</span>
            <a href="../index.php">Login</a>
        </section>
        

    </section>

</body>
</html>


<?php
  unset($_SESSION['errprompt']);
?>