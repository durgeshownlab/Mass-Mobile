<?php

include("_auth.php");

$category_id=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category_id']));
$category_name=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category_name']));
$existing_category_image=htmlspecialchars(mysqli_real_escape_string($conn, $_POST['existing_category_image']));


//file handling 

if(isset($_FILES['category_image']) && $_FILES['category_image']['error'] === UPLOAD_ERR_OK)
{
    // echo"<script>console.log(".implode(" ",$file).")</script>";
    $file = $_FILES['category_image'];

    $file_name = $file['name'];
    $file_tmp_name = $file['tmp_name'];
    $file_error = $file['error'];
    
    if ($file_error === UPLOAD_ERR_OK) 
    {
        // Validate file type and size
        $allowed_extensions = array(
            'jpg',
            'jpeg',
            'png',
            'gif',
            'bmp',
            'tiff',
            'tif',
            'webp',
            'svg',
            'ico',
            'psd',
            'eps',
            'ai'
        );
        $max_file_size = 5 * 1024 * 1024; // 5MB
    
        $file_info = pathinfo($file_name);
        $file_extension = strtolower($file_info['extension']);
    
        if (!in_array($file_extension, $allowed_extensions)) {
            echo 'Invalid file format';
            exit;
        }
    
        if ($file['size'] > $max_file_size) {
            echo 'File size exceeds the maximum limit of 10MB.';
            exit;
        }
    
        // Generate a unique filename
        $new_file_name = uniqid('', true) . '.' . $file_extension;
    
        // Specify the directory to which the file should be moved
        $upload_directory = '../../../images/category/';
    
        // Move the file to the upload directory
        $destination = $upload_directory . $new_file_name;
        if (move_uploaded_file($file_tmp_name, $destination)) 
        {
            // updating value in table if file is selected

            $sql="update category set name='{$category_name}', image='{$new_file_name}' where id={$category_id} and is_deleted=0";
            
            $result=mysqli_query($conn, $sql);
            
            if($result)
            {
                if (file_exists($existing_category_image)) {
                    if (unlink($existing_category_image)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                        echo 1;
                    } else {
                        // File deletion failed
                        // echo 'Failed to delete the file.';
                    }
                } else {
                    // File does not exist
                    // echo 'File not found.';
                }
            }
            else
            {
                if (file_exists($destination)) {
                    if (unlink($destination)) {
                        // File deletion successful
                        // echo 'File deleted successfully.';
                    } else {
                        // File deletion failed
                        // echo 'Failed to delete the file.';
                    }
                } else {
                    // File does not exist
                    // echo 'File not found.';
                }
                echo 0;
            }
            
        } 
        else 
        {
            echo 'Failed to move the uploaded file.';
            exit;
        }
    } 
    else 
    {
        echo 'File upload failed';
        exit;
    }    
}
else
{
    // updating value in table if file is selected

    $sql="update category set name='{$category_name}' where id={$category_id} and is_deleted=0";
    
    $result=mysqli_query($conn, $sql);
    
    // $product_id=mysqli_insert_id($conn);
    
    if($result)
    {
        echo 1;
    }
    else
    {
        echo 0;
    }

}



// echo ($product_name." ".$product_price." ".$product_category." ".$file['name']." ".$destination);

?>