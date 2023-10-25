<?php
session_start();

// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "testdata");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Capture user input


// Query the database to get the user's record
// $sql = "SELECT id, username, password FROM leap WHERE username = '$username'";
// $result = mysqli_query($conn, $sql);

// if (mysqli_num_rows($result) == 1) {
//     // User found in the database
//     $row = mysqli_fetch_assoc($result);
//     $hashedPassword = $row['password'];

//     if (password_verify($password, $hashedPassword)) {
//         // Password matches; login successful
//         $_SESSION['user_id'] = $row['id'];
//         $_SESSION['username'] = $row['username'];
//         header("Location: Page/Home.php"); // Redirect to the dashboard or user's profile page
//         exit();
//     } else {
//         // Password does not match
//         echo "Invalid password.";
//     }
$usernameError = ' ';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['button'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $getadmin = "Admin";
        $getuser="User";
       
        $sql = "SELECT id, username, password, status FROM status WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 1) {
                // User found in the database
                $row = mysqli_fetch_assoc($result);
                $user =$row['username'];
                $hashedPassword = $row['password'];
                $status = $row['status'];
                // $image=$row['image'];
                if($username == $user  && $password == $hashedPassword && $getadmin == $status){
                  $_SESSION['logged_in'] = true;
                  $_SESSION['USER']=$username;
                  $_SESSION['PASSWORD']=$password;
                  // $_SESSION['IMAGE']=$image;
                  header("Location: Page/Admin/Dashboard.php");
                  exit();
              }elseif(($username == $user  && $password == $hashedPassword && $getuser == $status)){
                $_SESSION['logged_in'] = true;
                $_SESSION['USER']=$username;
                $_SESSION['PASSWORD']=$password;
                header("Location: Page/Users/Dashboard.php");
                exit();
                   
              }
                else{
                
                  $usernameError = 'Invalid   password';
                  // header("Location: Login.php");
                 
              }
    }
  }
}
    //Ber jg kom oy vea Error nv ler screen yk if ($username)ey del nv krom ng 
    //tv dak knong if (mysqli)... krom $hashedpassword ...
    //vea chob jenh Error hz ,kron tah vea min jenh error ,tor tea yg vaii name trov tea password min trov ban vea jenh mor oy kernh !!
    

// } else {
//     // User not found in the database
//     echo "User not found.";
// }

// Close the database connection
// mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- <link rel="stylesheet" type="text/css" href="CSs/style.css"> -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<!-- <form autocomplete='off' class='form' action="" method="POST">
  <div class='control'>
    <h1>
      LOGIN
    </h1>
  </div>
  <div class='control block-cube block-input'>
    <input name='username' placeholder='Username' type='text' required>
    <div class='bg-top'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg-right'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg'>
      <div class='bg-inner'></div>
    </div>
  </div>
  <div class='control block-cube block-input'>
    <input name='password' placeholder='Password' type='password' required>
    <div class='bg-top'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg-right'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg'>
      <div class='bg-inner'></div>
    </div>
  </div>
  <button class='btn block-cube block-cube-hover' type='button'>
    <div class='bg-top'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg-right'>
      <div class='bg-inner'></div>
    </div>
    <div class='bg'>
      <div class='bg-inner'></div>
    </div>
    <div class='text'>
      <input type="submit" name="button" id="button" value="LOGIN">
    </div>
  </button>
  <a href="Rigister.php">RIGISTER</a>
  </form>
  <div class='credits'>
    <a href='https://codepen.io/marko-zub/' target='_blank'>
      My other codepens
    </a>
  </div> -->


  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4">
                <h2 class="text-center">Login Form</h2>
                <form action="" method="POST">
                <span class="error-message" style="color: red;"><?php echo $usernameError; ?></span>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <a href="FogetPassword.php">Forgot Password</a><br><br>
                    <input type="submit" class="btn btn-primary" name="button" value="Login">
                    <a href="http://localhost/Project_School/BackEnd/RigisterUser.php" class="btn btn-danger">Rigister</a>
                </form>
            </div>
        </div>
    </div>




</body>
</html>