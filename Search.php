<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARCHIE: Researcher</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {
            $('tr').click(function () {
                var docID = $(this).find('td:first').html();
                //alert(docID);
               /* var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("imageIsHere").innerHTML = this.responseText;
                    }
                };
                xmlhttp.open("GET", "DocGetter.php?docID=" + docID, true);
                xmlhttp.send();*/
               document.getElementById("iframe1").src="DocGetter.php?docID="+docID;
            });
        });
    </script>


</head>
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
$SearchBy=$_POST['mySelect'];
$text=$_POST['searchByText'];


if($SearchBy=='Key Word'){
    $sql="SELECT * FROM keywords, mainartifact, category, catalog WHERE mainartifact.id=category.Document_ID AND category.category_id=catalog.Category_ID AND keywords.Document_id=mainartifact.id AND keyword='$text'";
    $result = mysqli_query($conn, $sql);

}
if($SearchBy=='Name'){
    $sql="SELECT * FROM mainartifact, category, catalog WHERE mainartifact.id=category.Document_ID AND category.category_id=catalog.Category_ID AND mainartifact.name='$text'";
    $result = mysqli_query($conn, $sql);

}
if($SearchBy=='Author'){
    $sql="SELECT * FROM mainartifact, category, catalog WHERE mainartifact.id=category.Document_ID AND category.category_id=catalog.Category_ID AND mainartifact.author='$text'";
    $result = mysqli_query($conn, $sql);

}

if($SearchBy=='Category'){
    $sql1="SELECT Category_ID FROM catalog WHERE category_name='$text'";


    $sql="SELECT * FROM (SELECT Category_ID FROM catalog WHERE category_name='$text') AS combined, mainartifact, category, catalog WHERE (combined.Category_ID=catalog.Category_ID OR combined.Category_ID = catalog.parent_id) AND mainartifact.id=category.Document_ID AND category.category_id=catalog.Category_ID";
    $result = mysqli_query($conn, $sql);

}

echo "<form class='dark-matter'>";
echo "<table>";
echo "<tr><td> <span>ID:   </span> </td><td> <span>Name:   </span> </td> <td><span>Category:   </span></td>";
echo "<td> <span>Date:   </span> </td><td> <span>Artifact Author:   </span> </td></tr>";

while($row = mysqli_fetch_array($result)){   //Creates a loop to loop through result

    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['name'] . "</td> <td>" . $row['category_name'] ."</td><td>" . $row['date'] ."</td><td>" . $row['Author'] ."</td></tr>";
}


echo "</table>"; //Close the table in HTML

echo '<br>';
echo '<div id="imageIsHere"> </div>';
echo '<iframe src="" id="iframe1"></iframe>';

echo "</form>";
?>



