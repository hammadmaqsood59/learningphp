<!DOCTYPE html>
<html>
<head>
  <style>
    .error {color : #FF0000;}
  </style>
  
</head>
<body>

 <!--   -->

<?php

   //  $emailErr = $passwordErr = "";
   //  $email = $password = $hash = "";

   // if ($_SERVER["REQUEST_METHOD"] == "POST") {

   //  if (empty($_POST["email"])) {
   //    $emailErr = "Email is requied";
   //  }else{
   //    $email = test_input($_POST["email"]);
   //    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
   //          $emailErr = "Invalid email format";
   //          }
   //  }
   //  if (empty($_POST["password"])) {
   //    $passwordErr  = "Password is requied";
   //  }else{
   //    $password = test_input($_POST["password"]);
   //    $hash = password_hash($password, PASSWORD_BCRYPT);
   //  }
   //  }

   //  function test_input($data1){
   //  $data1 = trim($data1);
   //  $data1 = stripcslashes($data1);
   //  $data1 = htmlspecialchars($data1);
   //  return $data1;
   //  }

  ?>


</body>
</html>




<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

    <title>PHP Login System</title>
  </head>
  <body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PHP Login System</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
       <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
<h4>Please Login Here:</h4>
<hr>

<!-- <?php print_r($_COOKIE); ?> -->

<p><span class="error">* required field</span></p>

<form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required value="<?php if(isset($_COOKIE['email'])){echo $_COOKIE['email'];};?>">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    <!--  <span class ="error">* <?php echo $emailErr;?></span> -->
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" value="" required>
   <!--  <span class="error">* <?php echo $passwordErr;?></span> -->
  </div>
  <div class="mb-3 form-check">
    <input type="checkbox" name="remember_checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Remember Me</label>
  </div>
  <button type="submit" name="login" class="btn btn-primary">Login</button>
</form>
<br>

<?php

$email = $password = "";
$conn = "";



if (isset($_POST['login'])) {

require_once("db.php");
 
  $email = mysqli_real_escape_string($conn, $_POST['email']);

  // $password = md5($_POST['password']);
  $password = password_hash($_POST['password'], PASSWORD_BCRYPT);



  $sql = "SELECT id,name,email,password FROM aajjuser WHERE email = '$email'";
  
  $result = mysqli_query( $conn, $sql ) or die("Query Failed.");

  if ( mysqli_num_rows( $result ) > 0) {

    while ($row = mysqli_fetch_assoc( $result )) {

      
      if(!empty($row)){
        
        if (password_verify($_POST['password'], $row['password'])) {
              // echo 'Password is valid!';

              session_start();
              $_SESSION["username"] = $row['name'];
              $_SESSION["email"] = $row['email'];

              //check checkbox

              if (!empty ($_POST['remember_checkbox'])) {
                $remember_checkbox = $_POST['remember_checkbox'];

                //set cookies

                setcookie('email', $email, time()+3600*24*7);
                setcookie('password', $password, time()+3600*24*7);
              }else
              {
                //expiry the cookies
                setcookie('email', $email,30);
                setcookie('password', $password,30);
              }
              // redirect to home dashboard
              header('Location: http://localhost/aajjlogin/home.php');
          } else {
              echo 'Invalid password.';
          }
    }
    else{
     header('Location: home.php'); 
    }
    }
  }
  else
  {
    echo '<div class="alert alert-danger">Email and Password are not matched.</div>';
  }
}
//mysqli_close($conn);
?>
<br>

<?php
  //db
    echo "<h2>Your Input:</h2>";
    echo $email;
    echo "<br>";
    echo $password;
    echo "<br>";
    ?>

  
</div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
    -->
  </body>
</html>