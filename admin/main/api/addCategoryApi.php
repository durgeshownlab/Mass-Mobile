<?php

include("_auth.php");


if(!isset($_POST['category_name']) || empty($_POST['category_name']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['category_image']))
{
    echo 0;
    exit;
}


$category_name= htmlspecialchars(mysqli_real_escape_string($conn, $_POST['category_name']));

//file handling 
$category_image = $_FILES['category_image'];

$file_name = $category_image['name'];
$file_tmp_name = $category_image['tmp_name'];
$file_error = $category_image['error'];

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

    if ($category_image['size'] > $max_file_size) {
        echo 'File size exceeds the maximum limit of 5MB.';
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
        // inserting value in table
        $sql="insert into category (name, image) values ('{$category_name}', '{$new_file_name}')";

        $result=mysqli_query($conn, $sql);

        if($result)
        {
            echo 1;
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

?>