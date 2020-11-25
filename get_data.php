<?php

    include('database.php');

    $id=$_POST['id'];

    $sql="SELECT * FROM student WHERE id='$id'";
    $res=mysqli_query($con,$sql);
    while($row=mysqli_fetch_assoc($res)){
        $arr=$row;
    }
    
    echo json_encode($arr);
?>