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
    </tr>';
    
    while($row = mysqli_fetch_assoc($result)){
        // echo '<pre>'; print_r($row); echo '</pre>';
        $output .="<tr class='table-middle'><td>{$row["id"]}</td><td>{$row["first name"]}</td><td>{$row["last name"]}</td></tr>";
    }
    $output .= "</table>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
