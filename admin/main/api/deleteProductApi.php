<?php   

    include("_auth.php");

    $product_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['product_id']));

    $sql="update products set is_deleted=1 where product_id={$product_id}";
    $result=mysqli_query($conn, $sql);

    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

?>