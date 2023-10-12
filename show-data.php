<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/main.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <title>PHP With Ajax</title>
</head>
<body>
    <div class="main-table">
     <table id="table" callspacing="0">
        <tr class="table-row1">
            <td id="header">
             <h1>Ajax Data Load With PHP & jQuery</h1>
            </td>
        </tr>
     </table>
    </div>
    <div class="table-body">
     <table id="table" callspacing="0">
        <tr>
            <td id="table-load">
             <input type="button" id="load-button" value="Load Data">
            </td>
        </tr>
     </table>
     </div>
     <table  id="table-data" border="1" width="100%" cellspacing="0" cellpadding="10px">
        <tr class="table-head">
          <th>ID</th>
          <th>First Name</th>
          <th>Last Name</th>
        </tr>
        
     </table>

<script>
    $(document).ready(function(){
        $("#load-button").on("click", function(e){
        $.ajax({
                url : "ajax-load.php",
                type: "POST",
                success: function(data){
                    $("#table-data").html(data);
            }
        });
    });
});
</script>
</body>
</html>