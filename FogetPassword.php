<?php
// Establish a database connection
$conn = mysqli_connect("localhost", "root", "", "testdata");

// Check the connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if(isset($_POST['button'])){
    $name = $_POST['username'];
    $phone=$_POST['phone'];
    $report = $_POST['report'];
    if($name == " " && $phone == " " && $report == " "){
        echo "<script> alert('Please Input element !!'); </script>";
    }else{
        $sql = "INSERT INTO forget (username , phone, comment) VALUES ('$name', '$phone', '$report')";
    
        if (mysqli_query($conn, $sql)) {
            // echo "Data inserted successfully.";
            // header("Location: ForgetPassword.php");
            echo "<script> alert('Wait for Admin will call you new password! Thank You !'); </script>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        
        // Close the database connection
        mysqli_close($conn);
    }
    // SQL query to insert data into the database
    
}else{
    echo "<script> alert('Input For forget password !'); </script>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>foget Password</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 border p-4">
                <h2 class="text-center">Fogot Password</h2>
                <form action="" method="POST">
                <!-- <span class="error-message" style="color: red;"></span> -->
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" class="form-control" id="username" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone" required>
                    </div>
                    <div class="form-group">
                        <label for="Phone">Comment</label>
                        <textarea class="form-control" name="report" rows="5" id="report" placeholder="Type your reports to Admin here ..."></textarea>
                    </div>
                   
                    <input type="submit" class="btn btn-primary" name="button" value="Sent">
                    <a class="btn btn-danger" href="Login.php">Login</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>