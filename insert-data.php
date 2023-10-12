<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/main.css">
    <title>Insert Data With PHP & Ajax</title>
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
            <td id="input-field">
               <form id="add-form">
                   First Name: <input type="text" id="fname">
                   Last name: <input type="text" id="lname">
                   <input type="submit" id="save-button" value="save">
               </form>
               <div id="error-message"></div>
               <div id="success-message"></div>
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
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
        function loadTable () {
            $.ajax({
                url: "ajax-load.php",
                type: "POST",
                success: function(data){
                    $("#table-data").html(data);
                }
            });
        }
        loadTable();

        $("#save-button").on("click", function(e){
            e.preventDefault();
            const fname = $("#fname").val();
            var lname = $("#lname").val();
            // console.log(fname,lname);
            if (fname =="" || lname ==""){
                $("#error-message").html("All Fileds Are Required!!!!!!!!").slideDown();
                $("#success-message").slideUp();

            }else{
                $.ajax({
                url: "ajax-insert.php",
                type: "POST",
                data: {first_name:fname,last_name:lname},
                success: function(data){
                    if (data == 1){
                        loadTable();
                        $("#add-form").trigger("reset");
                        $("#error-message").slideUp();
                        $("#success-message").html("Data Insert Successfully!!!!!!!!!").slideDown();
                    }else{
                        alert("Can't Save Records!!!")
                    }
                    
                }
            });
            } 
        })
});
</script>
</body>
</html>