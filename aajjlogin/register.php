<!DOCTYPE html>
<html>
<head>
	<style>
		.error {color : #FF0000;}
	</style>
</head>
<body>

	<?php
	$nameErr = $emailErr = $passwordErr = "";
	$name = $email = $password = $hash = "";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		if(empty($_POST["name"])){
			$nameErr = "Name is requied";
		}else{
			$name = test_input($_POST["name"]);
			if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
            $nameErr = "Only letters and white space allowed";
            }
		}
		if (empty($_POST["email"])) {
			$emailErr = "Email is requied";
		}else{
			$email = test_input($_POST["email"]);
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
            }
		}
		if (empty($_POST["password"])) {
			$passwordErr  = "Password is requied";
		}else{
			$password = test_input($_POST["password"]);
			$hash = password_hash($password, PASSWORD_BCRYPT);
		}
	}

	function test_input($data1){
		$data1 = trim($data1);
		$data1 = stripcslashes($data1);
		$data1 = htmlspecialchars($data1);
		return $data1;
	}

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
          <a class="nav-link active" aria-current="page" href="register.php">Register</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Login</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="logout.php">Logout</a>
        </li>

      </ul>
    </div>
  </div>
 </nav>

 <div class="container mt-4">
 <h4>Please Register Here:</h4>
 <hr>

 <p><span class="error">* required field</span></p>


   <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> class="row g-3"> 

   <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Name</label>
    <input type="text" class="form-control" name = "name" id="inputText">
    <span class="error">* <?php echo $nameErr;?></span>
   </div>
    <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" name = "email" id="inputText">
    <span class ="error">* <?php echo $emailErr;?></span>
   </div>
   <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Password</label>
    <input type="password" class="form-control" name = "password" id="inputPassword4">
    <span class="error">* <?php echo $passwordErr;?></span>
    </div>
    <div class="col-12">
     <div class="form-check">
       <input class="form-check-input" type="checkbox" id="gridCheck">
       <label class="form-check-label" for="gridCheck">
       Check me out
       </label>
       </div>
       <br>
       </div>
       <div class="col-12">
       <button type="submit" class="btn btn-primary">Sign Up</button>
       </div>
      </form>
      <br>

      <?php
	//db
    echo "<h2>Your Input:</h2>";
    echo $name;
    echo "<br>";
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
<?php 

require_once("db.php"); 


$sql =  "INSERT INTO AajjUser(name, email, password)
VALUES('$name','$email','$hash')";

if ($conn->query($sql) === TRUE) {
  echo "New Record Created Successfully";
}else
{
  echo "Error: " . $sql . "<br>" . $conn->error;
}

?>