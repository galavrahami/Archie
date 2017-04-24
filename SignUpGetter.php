<?php
$servername = "localhost";
$username = "root";
$password = '';
$dbname = "ArchieUpdated";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get values from form
$name=$_POST['name'];
$user_name=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];
$email=$_POST['email'];


// Insert data into mysql
$sql = "INSERT INTO user VALUES ('$name','$user_name','$password','$email','$role')";
$result=mysqli_query($conn, $sql);

// if successfully insert data into database, displays message "Successful". 
if($result){
    echo "<script>
       alert(\"New user added successfully!\");
        window.location.href='WelcomePage.html';
        </script>";
}

else {
    echo "ERROR";
}
?>

<?php
// close connection 
mysqli_close($conn);
?>



