<?php
    include('database.php');

    $sql="SELECT id,name FROM student ORDER BY name ASC";
    $res=mysqli_query($con,$sql);
?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Fetch JSON Data</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </head>
    <body>
        <br/><br/>
        <div class="container">
            <h2 align="center">Fetch JSON Data with Ajax</h2>
            <div class="row">
                <div class="col-md-12">
                    <br/>
                    <div class="row">
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <select name="student_list" id="student_list" class="form-control" onchange="getData(this.options[this.selectedIndex].value)">
                                <option value="">Select Student</option>
                                <?php while($row=mysqli_fetch_assoc($res)){?>
                                    <option value="<?php echo $row['id']?>"><?php echo $row['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="table-responsive" id="student_details" style="display:none">
                       <table class="table table-bordered">
                           <tr>
                               <td width="10%" align="right"><b>Name: </b></td>
                               <td width="90%"><span id="student_name"></span></td>
                           </tr>
                           <tr>
                               <td width="10%" align="right"><b>City: </b></td>
                               <td width="90%"><span id="student_city"></span></td>
                           </tr>
                           <tr>
                               <td width="10%" align="right"><b>Email: </b></td>
                               <td width="90%"><span id="student_email"></span></td>
                           </tr>
                       </table> 
                    </div>
                </div>
            </div>
        </div>
        
        <script>
            function getData(id){
                
                if(id==''){
                    jQuery('#student_details').hide();
                }else{
                    jQuery.ajax({
                        url:'get_data.php',
                        type:'post',
                        data:'id='+id,
                        success:function(result){
                            var data=jQuery.parseJSON(result);
                            jQuery('#student_details').show();
                            jQuery('#student_name').html(data.name);
                            jQuery('#student_city').html(data.city);
                            jQuery('#student_email').html(data.email);
                        }
                    });
                }
            }
        </script>
        
    </body>
</html>