<?php
    session_start();

    include("../config/config.php");

    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        // Full Name validation
        if(!isset($_POST["name"]) || empty($_POST["name"])){
            echo 0;
            exit;
        }
        // Email validation
        else if(!isset($_POST["email"]) || empty($_POST["email"])) {
            echo 0;
            exit;
        }
        else if(!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo 0;
            exit;
        }

        // Mobile validation
        else if (!isset($_POST["mobile"]) || empty($_POST["mobile"])) {
            echo 0;
            exit;
        }
        // Password validation
        else if (!isset($_POST["password"]) || empty($_POST["password"])) {
            echo 0;
            exit;
        }
        // Confirm Password validation
        else if (!isset($_POST["confirm_password"]) || empty($_POST["confirm_password"])) {
            echo 0;
            exit;
        } 
        else if ($_POST["password"] != $_POST["confirm_password"]) {
            echo 0;
            exit;
        }
        else
        {
            $name=strtolower($_POST["name"]);
            $email=strtolower($_POST["email"]);
            $mobile=strtolower($_POST["mobile"]);
            $password=$_POST["password"];
            $confirm_password=$_POST["confirm_password"];
            
            $sql="select name from users where email='".$email."' or mobile='".$mobile."'";
            $result=mysqli_query($con, $sql);
            if(mysqli_num_rows($result)<=0)
            {
                $sql = "insert into users (name, email, mobile, password, user_type) values('{$name}', '{$email}', '{$mobile}', '{$password}', 'customer')";
                $result=mysqli_query($con, $sql);
    
                if($result)
                {
                    $query = "SELECT * FROM users WHERE email = '".$email."' and password='".$password."' and is_deleted=0";
                    $result = mysqli_query($con, $query);

                    if(mysqli_num_rows($result)==1)
                    {
                        $row=mysqli_fetch_assoc($result);
                        
                        $_SESSION['user_id']=$row['user_id'];
                        $_SESSION['name']=$row['name'];
                        $_SESSION['email']=$row['email'];
                        $_SESSION['mobile']=$row['mobile'];
                        $_SESSION['user_type']=$row['user_type'];
                        
                    }
                    echo 1;
                }
                else
                {
                    echo 0;
                }
            }
            else
            {
                echo 2;

            }

        }
    }
    

?>
