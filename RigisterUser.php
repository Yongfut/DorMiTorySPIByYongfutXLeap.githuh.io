<?php
session_start();

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
//     if (isset($_POST['button'])) {
//             header("Location: Login.php");
            
//             exit();
//         }else{
//             echo " ERROR";
            
//         }
//     }
 // Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "testdata");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
// $usernameError = '';
// if (substr($phone, 0, 1) === '8') {
//     $usernameError = 'Username cannot start with 8';
// } else {
//     // You can add validation and database storage logic here
//     // For a basic example, we'll just display the input values

//     echo "<h2>Registration Successful!</h2>";
//     echo "<p>Username: $username</p>";
//     echo "<p>Email: $email</p>";
// }
// Capture data from the form
$error =' ';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
        if (isset($_POST['button'])) {
          
        //   if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        //     $uploadDir = 'images/'; // Directory where you want to save the images
        //     $uploadedFile = $uploadDir . $_FILES['image']['name'];
        
        //     if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadedFile)) {
        //         $_SESSION['image_path'] = $uploadedFile;
        //     }
        // }

            $name = $_POST['username'];
            $email =$_POST['email'];
            $password =$_POST['password'];
            $phone =$_POST['phone'];
            $status="User";
          

            //Image 
            $img_name=$_FILES['image']['name'];
            $img_size=$_FILES['image']['size'];
            $tmp_name=$_FILES['image']['tmp_name'];
            $error=$_FILES['image']['error'];
           


            //Compare phone have up 8 and not big 10 
            if(strlen($phone) <9 || strlen($phone) >10 ) {
                $error ='Phone Incorrent !!';
            }elseif(strlen($password) <8 ){
                $error ='Wrong Input || Password have length 8 up';
            }else{

             //INSERT DATABASE 
             if($error===0){

              if($img_size>1250000){

                $em ="Your File Is large";
                header("Location: RigisterUser.php?error=$em");

              }else{
                $img_ex=pathinfo($img_name,PATHINFO_EXTENSION);
                $img_ex_lc=strtolower($img_ex);
                $allowed_exs = array("jpg","jpeg","png");

                if(in_array($img_ex_lc,$allowed_exs)){

                 $new_img_name =uniqid('IMG-',true).'.'.$img_ex_lc;
                 $img_upload_path='Page/Admin/ListUsers/upload/'.$new_img_name;
                 move_uploaded_file($tmp_name,$img_upload_path);
                 //INSERT DATABASE hz hz jg bach INSERT tt te

                }else{
                $em ="Your can`t upload this type";
                header("Location: RigisterUser.php?error=$em");
                }
              }
            }else{
              $em ="unkown Error Occurred !!";
              header("Location: RigisterUser.php?error=$em");
            }
            //End Images     
                $sql = "INSERT INTO status (username , password , email , phone , image ,status) VALUES ('$name', '$password', '$email' , '$phone', '$new_img_name ','$status')";
                if (mysqli_query($conn, $sql)) {
                 // echo "Data inserted successfully.";
                  header("Location: Login.php");
                  } else {
                 echo "Error: " . $sql .   "<br>" . mysqli_error($conn);
                   }
                      mysqli_close($conn);

            }
            // SQL query to insert data into the database   
   

// Close the database connection
mysqli_close($conn);
                
                
           
        }
    }





?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- <link rel="stylesheet" type="text/css" href="CSs/style.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
<!-- <form autocomplete='off' class='form' action="connectData.php" method="POST">
  <div class='control'>
    <h1>
      RIGISTER
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
  <div class='control block-cube block-input'>
    <input name='email' placeholder='Email' type='email' required>
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
  <a href="Login.php">LOGIN</a>
  </form>
  <div class='credits'>
    <a href='https://codepen.io/marko-zub/' target='_blank'>
      My other codepens
    </a>
  </div> -->
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4">
                <h2 class="text-center">Register Form</h2>
                <form action="" method="POST" enctype="multipart/form-data">
                <span class="error-message" style="color: red;"><?php echo $error; ?></span>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your Number Phone" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" name="image" id="image" >
                    </div>
                    
                    <input type="submit" class="btn btn-primary" name="button" value="RIGISTER">
                <a href="Login.php" class="btn btn-danger"x>Login</a>
                </form>
            </div>
        </div>
    </div>
  


</body>
</html>