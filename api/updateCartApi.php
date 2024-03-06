<?php 

session_start();
include("../config/config.php");

if(isset($_POST['option']) && $_POST['option']=='plus')
{
    $product_id=$_POST['product_id'];
    
    // $sql="update cart set name='{$sub_category_name}' where sub_category_id={$sub_category_id}";
    $sql="select cart.quantity as quantity, products.product_price as product_price from cart join products on cart.product_id=products.product_id where cart.user_id={$_SESSION['user_id']} and cart.product_id={$product_id} and products.is_deleted=0 and cart.is_deleted=0";
    $result=mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result)>0)
    {
        $row=mysqli_fetch_assoc($result);
        $quantity=$row['quantity']+1;
        $total_price=$row['product_price']*$quantity;
    
        $sql1="update cart set quantity={$quantity}, total_price={$total_price}  where user_id={$_SESSION['user_id']} and product_id={$product_id} and is_deleted=0";
        $result1=mysqli_query($con, $sql1);
        if($result1)
        {
            echo 1;
        }
        else
        {
            echo 0;
        }
    
    }
}
else if(isset($_POST['option']) && $_POST['option']=='minus')
{
    $product_id=$_POST['product_id'];


    $sql="select cart.quantity as quantity, products.product_price as product_price from cart join products on cart.product_id=products.product_id where cart.user_id={$_SESSION['user_id']} and cart.product_id={$product_id} and products.is_deleted=0 and cart.is_deleted=0";
    $result=mysqli_query($con, $sql);

    if(mysqli_num_rows($result)>0)
    {

        $row=mysqli_fetch_assoc($result);
        if($row['quantity']<=1)
        {
            echo 0;
            exit;
        }
        else
        {
            $quantity=$row['quantity']-1;
            $total_price=$row['product_price']*$quantity;
        
            $sql1="update cart set quantity={$quantity}, total_price={$total_price}  where user_id={$_SESSION['user_id']} and product_id={$product_id} and is_deleted=0";
            $result1=mysqli_query($con, $sql1);
            if($result1)
            {
                echo 1;
            }
            else
            {
                echo 0;
            }
        }

    }
}

?>