<?php   

    include("_auth.php");

    $banner_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['banner_id']));

    $sql="update banners set is_deleted=1 where banner_id={$banner_id}";
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