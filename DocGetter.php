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
$docID = $_REQUEST["docID"];

//get docs from db
$sqlimage = "SELECT * FROM document where `id` =".$docID;
$imageresult = mysqli_query($conn, $sqlimage);

while($row = mysqli_fetch_array($imageresult)) {
//display images
    echo '<br>';
    //*********FIX PATH
    $page=$row['page'];
    echo '<img id="imageHere" height="300" width="300" src= "/getImage.php?id='.$docID.'&page='.$page.'">';
}
