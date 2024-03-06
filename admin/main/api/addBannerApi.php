<?php

include("_auth.php");


if(!isset($_POST['banner_name']) || empty($_POST['banner_name']))
{
    echo 0;
    exit;
}
else if(!isset($_FILES['banner_image']))
{
    echo 0;
    exit;
}


$banner_name= htmlspecialchars(mysqli_real_escape_string($conn, $_POST['banner_name']));

//file handling 
$banner_image = $_FILES['banner_image'];

$file_name = $banner_image['name'];
$file_tmp_name = $banner_image['tmp_name'];
$file_error = $banner_image['error'];

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

    if ($banner_image['size'] > $max_file_size) {
        echo 'File size exceeds the maximum limit of 5MB.';
        exit;
    }

    // Generate a unique filename
    $new_file_name = uniqid('', true) . '.' . $file_extension;

    // Specify the directory to which the file should be moved
    $upload_directory = '../../../images/banner/';

    // Move the file to the upload directory
    $destination = $upload_directory . $new_file_name;
    if (move_uploaded_file($file_tmp_name, $destination)) 
    {
        // inserting value in table
        $sql="insert into banners (banner_name, banner_image) values ('{$banner_name}', '{$new_file_name}')";

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