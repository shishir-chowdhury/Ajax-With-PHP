<?php

$search_value = $_POST["search"];
// Data Showing In One Page
$limit_per_page = 12;
$page ="";

if(isset($_POST["page_no"])){
    $page = $_POST["page_no"];
}else{
    $page = 1;
}

$offset = ($page-1) * $limit_per_page;


$conn = mysqli_connect("localhost", "root", "", "test") or die("Connection Failed!!!!!!!");

$sql = "SELECT * FROM students WHERE first_name LIKE '%{$search_value}%' OR last_name LIKE '%{$search_value}%' LIMIT {$offset},{$limit_per_page}";

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

    // Pagination: Total Number Of Page
    $recoads = mysqli_query($conn, $sql) or die("SQL Query Failed!!!!!!!!");
    if (mysqli_num_rows($result) > 12){
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

    }else{
    $output .="<div id='pagination'>";
    $output .="<a id='1' class='active' href=''>1</a>";
    $output .= "</div>";
    mysqli_close($conn);
    echo $output;
    }
   
} else {
    echo "<h2>No Record Found!!!!!!!</h2>";
}