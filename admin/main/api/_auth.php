
<?php 
    session_start();
    include("_dbconnect.php");

    mysqli_set_charset($conn, "utf8");

    if (!isset($_SESSION['user_type'])) 
    {
        // header("Location: /tapti-final/");
        echo "<script>window.location.href = '../../../login.php';  </script>";
    }
    else if (isset($_SESSION['user_type'])  && $_SESSION['user_type'] != 'admin') 
    {
        // header("Location: /tapti-final/");
        echo "<script>window.location.href = '../../../';  </script>";

    }

?>