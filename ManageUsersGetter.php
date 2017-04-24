<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ARCHIE: Researcher</title>
    <link rel="stylesheet" type="text/css" href="mystyle.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <script>
        function deleteFunc(num) {
            //alert("Delete!" + num);
            var myAction= "delete";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("option").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "Delete&Add.php?myAction="+ myAction +"&num="+num, true);
            xmlhttp.send();
        }
        function editFunc(num) {
            //alert("Edit!"+" "+ num);
            var myAction= "edit";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("option").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "Delete&Add.php?myAction="+ myAction + "&num="+num, true);
            xmlhttp.send();
        }

    </script>
</head>
<body>
<form class="dark-matter">
    <h1>Users:</h1>
    </div>
    <table>
        <tr>
            <td><span></span></td>
            <td><span></span></td>
            <td><span>Username:   </span></td>
            <td><span>Password:   </span></td>
            <td><span>Role:   </span></td>
        </tr>
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
        // Insert data into mysql
        $sql = "SELECT user_name, password, role FROM user";
        $result = mysqli_query($conn, $sql);
        $i=1;

        while ($row = mysqli_fetch_array($result)) {   //Creates a loop to loop through results
            echo "<tr><td> <button onclick=\"deleteFunc($i)\" type=\"button\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-remove\"></span></button></td>
                      <td> <button onclick=\"editFunc($i)\" type=\"button\" class=\"btn btn-default btn-sm\"><span class=\"glyphicon glyphicon-edit\"></span></button></td>
                      <td>" . $row['user_name'] . "</td>
                      <td>" . $row['password'] . "</td> 
                      <td>" . $row['role'] . "</td></tr>";
        $i++;
        }

        echo "</table>"; //Close the table in HTML

        echo "<div id=\"option\">"
        ?>

        <br><br><br>
        <a href="Manager.html" data-testid="Manager_link">Home</a><br>
</form>
</body>
</html>
