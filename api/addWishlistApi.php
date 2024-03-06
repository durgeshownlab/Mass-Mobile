<?php

    session_start();
    include('../config/config.php');

    if(!isset($_SESSION['user_id']))
    {
        echo 2;
        exit;
    }
    else
    {
        $product_id=$_POST['product_id'];
        $user_id=$_SESSION['user_id'];


        $sql="select * from wishlists where user_id={$user_id} and product_id={$product_id}";

        $result=mysqli_query($con, $sql);

        if(mysqli_num_rows($result)>0)
        {
            $sql="delete from wishlists where user_id={$user_id} and product_id={$product_id}";
            $result=mysqli_query($con, $sql);
            if($result)
            {
                echo 3;
            }
            else
            {
                echo 4;
            }
        }
        else
        {
            $sql="insert into wishlists (user_id, product_id) values ({$user_id}, {$product_id})";
            $result=mysqli_query($con, $sql);
        
            if($result)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }
    
    }



?>