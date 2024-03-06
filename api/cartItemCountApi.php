<?php

    session_start();
    include("../config/config.php");
    
    if(!isset($_SESSION['user_id']))
    {
        exit;
    }
    else
    {
        $sql="select * from cart where user_id={$_SESSION['user_id']} and is_deleted=0";
        $result=mysqli_query($con, $sql);
        
        echo (mysqli_num_rows($result));
    }

?>