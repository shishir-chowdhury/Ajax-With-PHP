<?php
$conn = mysqli_connect("localhost","root","","test") or die("Connection Field.");

$sql="SELECT * from students";
$result =mysqli_query($conn, $sql) or die("SQL Query Failed.");

$output="";
if(mysqli_num_rows($result)> 0 ){
    $output = '<table border="1" width="100" cellspacing="0" cellpadding="10px">
    <tr class="table-head">
      <th>ID</th>
      <th>First Name</tk>
      <th>Last Name</th>
      <th>Option</th>
    </tr>';
    
    while($row = mysqli_fetch_assoc($result)){
        // echo '<pre>'; print_r($row); echo '</pre>';
        $output .="<tr class='table-middle'><td>{$row["id"]}</td><td>{$row["first_name"]}</td><td>{$row["last_name"]}</td><td><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
