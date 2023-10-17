<?php
$conn = mysqli_connect("localhost","root","","test") or die("Connection Field.");

// Data Showing In One Page
$limit_per_page = 12;
$page ="";

if(isset($_POST["page_no"])){
    $page = $_POST["page_no"];
}else{
    $page = 1;
}

$offset = ($page-1) * $limit_per_page;

$sql="SELECT * from students LIMIT {$offset},{$limit_per_page}";

$result =mysqli_query($conn, $sql) or die("SQL Query Failed.");

$output="";
if(mysqli_num_rows($result)> 0 ){
    $output = '<table border="1" width="100%" cellspacing="0" cellpadding="10px">
    <tr class="table-head">
      <th>ID</th>
      <th>First Name</tk>
      <th>Last Name</th>
      <th width="30%">Options</th>
    </tr>';
    
    while($row = mysqli_fetch_assoc($result)){
        // echo '<pre>'; print_r($row); echo '</pre>';
        $output .="<tr class='table-middle'><td>{$row["id"]}</td><td>{$row["first_name"]}</td><td>{$row["last_name"]}</td><td><button class='view-btn' data-id='{$row["id"]}'>View</button><button class='edit-btn' data-id='{$row["id"]}'>Edit</button><button class='delete-btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
    }
    $output .= "</table>";

    //Pagination: Total Number Of Page
    $total_data_sql = "SELECT * FROM students";
    $recoads = mysqli_query($conn, $total_data_sql) or die("SQL Query Failed!!!!!!!!");
    $total_records = mysqli_num_rows($recoads);
    $total_pages = ceil($total_records/$limit_per_page);

    $output .="<div id='pagination'>";
    for($i=1; $i <= $total_pages; $i++){
        if($i == $page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .="<a id='{$i}' class='{$class_name}' href=''>{$i}</a>";
    }
    $output .= "</div>";
    mysqli_close($conn);
    echo $output;
} else {
    echo "<h2>No Record Found.</h2>";
}
