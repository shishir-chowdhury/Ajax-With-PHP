<?php

$search_value = $_POST["search"];

$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed!!!!!!!");

$sql = "SELECT * FROM students WHERE first_name LIKE '%{$search_value}%' OR last_name LIKE '%{$search_value}%'";

$result = mysqli_query($conn, $sql) or die("SQL Query Failed!!!!!!!!");

$output ="";

if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="100%" callspecing="0"     cellpadding="10px">
              <tr class="table-head">
                    <th width="250px">Id</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Options</th>
              </tr>';

              while($row = mysqli_fetch_assoc($result)){
                $output .= "<tr class='table-middle'><td align='center'>{$row['id']}</td><td align='center'>{$row['first_name']}</td><td align='center'>{$row['last_name']}</td><td><button class='view-btn' data-id='{$row["id"]}'>View</button><button class='edit-btn' data-id='{$row["id"]}'>Edit</button><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
              }

              $output .="</table>";
              mysqli_close($conn);
              echo $output;
} else {
    echo "<h2>No Record Found!!!!!!!</h2>";
}