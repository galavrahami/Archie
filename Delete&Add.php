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

$num = $_REQUEST['num'];
$myAction = $_REQUEST['myAction'];
//$i=1;
//$flag=true;

$sql = "SELECT * FROM user";
$allUsers = mysqli_query($conn, $sql);

if ($allUsers = mysqli_query($conn, $sql)) {
    // Seek to row num-1
    mysqli_data_seek($allUsers, $num - 1);

    // Fetch row
    $row = mysqli_fetch_row($allUsers);

    $user = $row[1];

    // Free result set
    mysqli_free_result($allUsers);
}

if ($myAction == "delete") {

    $deleteSql = "DELETE FROM user WHERE user.user_name='$user'";
    if ($conn->query($deleteSql) === TRUE) {
        echo '<script type="text/javascript">alert("User ' . $user . ' has been deleted")</script>';
    } else {
        echo "Error deleting record: " . $conn->error;
    }

}