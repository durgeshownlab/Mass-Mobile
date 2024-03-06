
<?php 

session_start();
include("../config/config.php");

try
{
    $email=strtolower($_POST['email']);
    $password=$_POST['password'];

    
    $sql="select user_id, name, email, mobile, user_type from users where email='".$email."' and password='".$password."' and is_deleted=0";
    $result=mysqli_query($con, $sql);

    if(mysqli_num_rows($result)==1)
    {
        $row=mysqli_fetch_assoc($result);

        $_SESSION['user_id']=$row['user_id'];
        $_SESSION['name']=$row['name'];
        $_SESSION['email']=$row['email'];
        $_SESSION['mobile']=$row['mobile'];
        $_SESSION['user_type']=$row['user_type'];

        if($row['user_type']=='admin')
        {
            echo 1;
        }
        else if($row['user_type']=='customer')
        {
            echo 2;
        }
    }
    else
    { 
        echo 0;
    }
}
catch(Exception $e)
{
    echo $e;
}
finally
{
    mysqli_close($con);
}

?>