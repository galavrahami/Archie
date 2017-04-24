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
$user_name=$_POST['username'];
$password=$_POST['password'];



// Insert data into mysql
$sql = "SELECT user_name, password, role FROM user";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $flag=false;
    while($row = mysqli_fetch_assoc($result)) {
        if($user_name==$row["user_name"] && $password==$row["password"]){
            $flag=true;
            $role=$row["role"];
            if($role=="Researcher"){
                header("Location:Researcher.html");
            }
            if($role=="Archive Employee"){
                header("Location:ArchiveEmployee.html");
            }
            if($role=="Manager"){
                header("Location:Manager.html");
            }
        }
    }
    if(!$flag){
        echo "<script>
        alert(\"User does not exist\");
        window.location.href='WelcomePage.html';
        </script>";
    }
}
else {
    echo "0 results";
}

mysqli_close($conn);
?>



