<?php

$studentId = $_POST["id"];

$conn = mysqli_connect("localhost", "root", "","test") or die("Connection Failed!!!!");

$sql = "DELETE FROM students WHERE id={$studentId}";

// $results = mysqli_query($conn, $sql) or die("SQL Query Failed!!!!!!");

 if (mysqli_query($conn, $sql)){
    echo 1;
 }else{
   echo  0;
 }