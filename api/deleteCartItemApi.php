<?php 

session_start();
include("../config/config.php");

try
{

    $product_id=$_POST['product_id'];

    $sql="delete from cart where user_id={$_SESSION['user_id']} and product_id={$product_id}";
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
catch(Exception $e)
{
    echo'<script>console.log("'.$e.'");</script>';
}
finally
{
    mysqli_close($con);
}

?>