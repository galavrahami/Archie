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
$docName = $_POST['docName'];
$date = date("Y-m-d");
$empName = $_POST['empName'];
$author = $_POST['author'];
$cat = $_POST['cat'];
$myInputs = $_POST["myInputs"];



// Insert into mainartifact Table
$mainArtifactSql = "INSERT INTO mainartifact(name, date, Updater_Name, Author) VALUES ('$docName','$date','$empName','$author')";
$result = mysqli_query($conn, $mainArtifactSql);
//Get document ID
$newDocID = mysqli_insert_id($conn);

//Insert Category into DB

//Check if category already exists
$check = "SELECT * FROM catalog WHERE category_name='$cat'";
$check_res = mysqli_query($conn, $check);


if (mysqli_num_rows($check_res) == 0) {
// Insert data into catalog table
    $catalogSql = "INSERT INTO catalog(category_name, parent_id) VALUES ('$cat',NULL)";
    $catalogResult = mysqli_query($conn, $catalogSql);
    $catID = mysqli_insert_id($conn);
} else {
    //category already exists
    $getIDSql = "SELECT Category_ID FROM catalog WHERE category_name='$cat'";
    $catalogResult = mysqli_query($conn, $getIDSql);

    while ($row1 = mysqli_fetch_assoc($catalogResult)) {
        $catID = $row1['Category_ID'];
    }
}


//Update category table with doc id and category ID
$addCatSql = "INSERT INTO category(Document_id, Category_id) VALUES ('$newDocID','$catID')";
$addCatResult = mysqli_query($conn, $addCatSql);

//*********Link to username

//Update keywords table in DB
foreach ($myInputs as $eachInput) {
    $keywordSql = "INSERT INTO keywords(Document_id, keyword) VALUES ('$newDocID','$eachInput')";
    $keywordResult = mysqli_query($conn, $keywordSql);
}

//Retrieve files

if (isset($_FILES['pics']['name'])) {

    //Getting the total number of files
    $count = count($_FILES['pics']['name']);
    $Uploaded = false;
    if (!$count) {
        echo "No chosen files";
    } else {

        // Processing each file iteratively
        for ($i = 0; $i < $count; $i++) {

            $file_name = $_FILES['pics']['name'][$i];
            $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

            //Uploading the file
            $tmp = $_FILES['pics']['tmp_name'][$i];
            $target_dir = "/tmp";
            $target_file = $target_dir . basename($file_name);

            if (move_uploaded_file($tmp, $target_file)) {
                echo "File is valid, and was successfully uploaded.";
            } else {
                echo "Possible file upload attack!";
            }
            // Insert path to file
            $docSql = "INSERT INTO document (id, page, Picture_file) VALUES ('$newDocID','$i','$target_file')";
            $docResult = mysqli_query($conn, $docSql);

            // if successfully insert data into database, displays message "Successful".
            if ($docResult) {
                $uploaded = true;
            } else {
                $uploaded = false;
                echo mysqli_error($conn);
            }
        }
    }
}

if ($uploaded) {
    echo "<script>
       alert(\"New document added successfully!\");
        window.location.href='AddDoc.html';
        </script>";
}


//********CODE FOR ONE FILE*******************
// Save file to disk
// Create a unique name for the file
// $file_name = "/Users/galavrahami/PhpstormProjects/ARCHIE/$newDocID";

//if(move_uploaded_file($_FILES["pic"]["tmp_name"], $file_name)){
// echo"File is valid, and was successfully uploaded.";
//}
//else{
//  echo "Possible file upload attack!";
//}

// Insert path to file
//$docSql="INSERT INTO document (id, page, Picture_file) VALUES ('$newDocID','1','$file_name')";
//$docResult=mysqli_query($conn,$docSql);

// if successfully insert data into database, displays message "Successful".
//if($docResult){
//  echo "<script>
//   alert(\"New document added successfully!\");
//  window.location.href='AddDoc.html';
//</script>";
//}

//else {
//echo "ERROR";
//  echo mysqli_error($conn);
//}

// close connection
//mysqli_close($conn);
//***********************************************
?>
