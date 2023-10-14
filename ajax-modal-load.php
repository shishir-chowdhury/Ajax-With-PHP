<?php

echo $id = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed!!!!!!!!");

$sql = "SELECT * FROM students  WHERE id ={$id}";
$results = mysqli_query($conn, $sql) or die("SQL Query Failed!!!!!!!!!!!");


    $output ="";
    if(mysqli_num_rows($results)> 0 ){
        while($row = mysqli_fetch_assoc($results)){
            $output .="<tr class='modal-row'>
                    <form id='edit-form'>
                       <td>First Name:</td>
                       <td><input type='text' id='edit-id' hidden value='{$row["id"]}'><input type='text' id='edit-fname' value='{$row["first_name"]}'></td>
                       <td>Last Name:</td>
                       <td><input type='text' value='{$row["last_name"]}' id='edit-lname'></td>
                       <td><input type='submit' id='edit-submit' value='save'></td>
                    </form>
                </tr>";
        }
        mysqli_close($conn);
        echo $output;
        
    } else {
        
    }