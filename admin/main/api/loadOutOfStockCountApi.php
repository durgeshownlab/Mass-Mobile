<?php

include("_auth.php");

$sql="select * from products where quantity<3 and is_deleted=0";
$result=mysqli_query($conn, $sql);

echo mysqli_num_rows($result);

?>