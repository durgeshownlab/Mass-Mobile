<?php   

    include("_auth.php");

    $image_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['image_id']));

    $sql="select * from product_images where image_id={$image_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);
    }

    $destination = '../../../images/products/'.$row['image_path'];
    
    $sql="delete from product_images where image_id={$image_id} and is_deleted=0";
    $result=mysqli_query($conn, $sql);
    if($result)
    {
        if (file_exists($destination)) {
            if (unlink($destination)) {
                // File deletion successful
                // echo 'File deleted successfully.';
                echo 1;
                exit;
            } 
            else {
                // File deletion failed
                // echo 'Failed to delete the file.';
            }
        } 
        else {
            // File does not exist
            // echo 'File not found.';
        }
        echo 1;
    }
    else
    {
        echo 0;
    }

?>