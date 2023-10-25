<?php
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
$name = $_POST['username'];
$email =$_POST['email'];
$password =$_POST['password'];
$phone =$_POST['phone'];
$image =$_POST['image'];
// SQL query to insert data into the database
$sql = "INSERT INTO status (username , password , email) VALUES ('$name', '$password', '$email')";

if (mysqli_query($conn, $sql)) {
    // echo "Data inserted successfully.";
    header("Location: Login.php");
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close the database connection
mysqli_close($conn);
?>
