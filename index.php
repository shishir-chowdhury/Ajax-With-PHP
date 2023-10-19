<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="asset/main.css">
    <title>PHP & Ajax CRUD</title>
</head>
<body>
    <!-- Header -->
    <div class="page-header"> 
            <h1>PHP & Ajax CRUD</h1>
            <div class="search">
                Search:
                <input id="search-input" type="text" autocomplete="off">
            </div>
    </div>

    <!-- Input Field -->
    <div class="table-body">
     <table id="table" cellspacing="0">
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

     <!-- Modal Section -->
    <div id="modal">
        <div id="modal-form">
            <h2 style="text-align:center">Edit Info</h2>
            <table>
                <div id="edit-error-message"></div>
                <div id="edit-success-message"></div>
            </table>
            <div id="close-btn">
                x
            </div>
        </div>
    </div>

    <!-- Dummy Table -->
     <div  id="table-data">
        <tr class="table-head">
        </tr>
    </div>

     <!-- Pagination -->
    <div id="pagination">
    </div>

     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script>
    $(document).ready(function(){
        var page_no = 1;
        // Load The Table Records
        function loadTable (page) {
            $.ajax({
                url: "ajax-load.php",
                type: "POST",
                data: {page_no: page},
                success: function(data){
                    $("#table-data").html(data);
                }
            });
        }
        loadTable();

        // Pagination 
        $(document).on("click", "#pagination a", function(e){
            e.preventDefault();
            var page_id = $(this).attr("id");
             loadTable(page_id);
        });

        //Insert New Records In The Table
        $("#save-button").on("click", function(e){
            e.preventDefault();
            var fname = $("#fname").val();
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
                        $("#success-message").html("Data Insert Successfully!!!!!!!!!").slideDown().fadeOut(3000);
                    }else{
                        alert("Can't Save Records!!!")
                    }
                    
                }
            });
            } 
        });

        // Delete Records From The Table
        $(document).on("click", ".delete-btn", function(){ 
            
            if (confirm("Are You Sure???????")){
                var studentId = $(this).data("id");
                var element = this;
            $.ajax({
                url: "ajax-delete.php",
                type: "POST",
                data: {id : studentId},
                success: function(data){
                    if (data == 1){
                        $(element).closest("tr").fadeOut();
                        $("#error-message").slideUp();
                        $("#success-message").html("Data Successfully Deleted!!!!").slideDown();
                    } else {
                        $("#error-message").html("Can't Delete The Records!!!!!!!!").slideUp();
                        $("#success-message").slideDown();
                    }
                }
            });
            }
        });

        //Show Data In Modal Box
        $(document).on("click", ".edit-btn", function(){
            $("#modal").show();
            var studentId = $(this).data("id");
            $.ajax({
                url: "ajax-modal-load.php",
                type: "POST",
                data: {id:studentId},
                success: function(data){
                    $("#modal-form table").html(data);
                }
            });
        });

        // Update Records From The Table
        $(document).on("click", "#edit-submit", function(){
            var stuId = $("#edit-id").val();
            var stuFname = $("#edit-fname").val();
            var stuLname = $("#edit-lname").val();
            // console.log(stuId, stuFname, stuLname);
                if(stuFname == "" || stuLname == ""){
                    $("#edit-error-message").html("All Fileds Are Required!!!!!!!!").slideDown();
                    $("#edit-success-message").slideUp();
                }else{
                    $.ajax({
                        url: "edit-ajax.php",
                        type: "POST",
                        data: {id:stuId,first_name:stuFname, last_name:stuLname},
                        success: function(data){
                        if (data == 1){
                               $("#edit-form").trigger("reset");
                               $("#modal").fadeOut(3000);
                               loadTable();
                               $("#edit-error-message").slideUp();
                               $("#edit-success-message").html("Records Update Successfully!!!!!").slideDown().fadeOut(3000);
                            
                        }else{
                            $("#error-message").html("Can't Update The Records!!!!!!!!").slideDown();
                            $("#success-message").slideUp();
                        }
                    }
                    });

                }
            })
         //Hide Modal Box
        $("#close-btn").on("click", function(){
            $("#modal").hide();
        });

        //Live Search
        $("#search-input").on("keyup", function(){
            var search_item = $(this).val();
            if (search_item ==""){
                loadTable(page_no);
            }else{
                $.ajax({
                url: "ajax-live-search.php",
                type: "POST",
                data: {search:search_item},
                success: function(data){
                $("#table-data").html(data);
                }
            });
            }
        });

    });
   
</script>
</body>
</html>