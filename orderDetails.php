<?php include("header.php"); 

if(!isset($_SESSION['user_id']))
{
    echo "<script>window.location.href = 'index.php';  </script>";
}
?>


<?php

$sql = "select * from orders where order_id='{$_GET['Oid']}' and user_id={$_SESSION['user_id']} and is_deleted=0";
$result = mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0)
{
    $row=mysqli_fetch_assoc($result);
}

$sql_for_product="select product_name, product_image, product_desc from products where product_id={$row['product_id']}";
$result_for_product = mysqli_query($con, $sql_for_product);
if(mysqli_num_rows($result_for_product)>0)
{
    $row_for_product=mysqli_fetch_assoc($result_for_product);
}

$sql_for_address="select * from address where address_id={$row['address_id']}";
$result_for_address = mysqli_query($con, $sql_for_address);
if(mysqli_num_rows($result_for_address)>0)
{
    $row_for_address=mysqli_fetch_assoc($result_for_address);
}

?>



<main class="bg_gray">
    <div class="container">

        <div class="col">
            <div class="row">
                <div class="col bg-white m-3 px-5 py-2 d-flex align-items-center justify-content-between">
                    <strong>Order Id &nbsp;</strong>
                    <span> <?= $row['order_id'] ?></span>
                </div>
                <div class="col bg-white m-3 px-5 py-2 d-flex align-items-center justify-content-between">
                    <strong>Transaction Id &nbsp; </strong>
                    <span> 
                        <?php 
                            if($row['transaction_id'])
                            {
                                echo $row['transaction_id'];
                            } 
                        ?>
                    </span>
                </div>
                <div class="col bg-white m-3 px-5 py-2 d-flex align-items-center justify-content-between">
                    <strong>Order Date &nbsp; </strong>
                    <span> <?= $row['order_date'] ?></span>
                </div>
            </div>

            <div class="row px-3">
                <div class="bg-white col-md-4 d-flex justify-content-center align-items-center">
                    <img src="images/products/<?= $row_for_product['product_image'] ?>" class="rounded float-start" alt="..." style="width: auto; height: 200px;">
                </div>  

                <div class="col-md-4 bg-white p-2">
                    <div>
                        <b><?= ucwords($row_for_product['product_name']) ?></b>
                        <p><?= $row_for_product['product_desc'] ?></p>
                    </div>

                    <div>
                        <b>$<?= $row['price_single_unit'] ?></b>
                        <p>Quantity: <?= $row['quantity'] ?></p>
                    </div>

                    <div>
                        <b>Total Price: </b>
                        <p>$<?= number_format($row['total_price']) ?></p>
                    </div>

                    <div>
                        <b>Delivery Status: </b>
                        <span style="
                        <?php 
                            if($row['order_status']=='canceled')
                            {
                                echo ' color: red;';
                            }
                            else if($row['order_status']=='delivered')
                            {
                                echo ' color: green;';
                            }

                        ?>
                        
                        "><?=  $row['order_status'] ?></span>
                    </div>
                </div>  

                <div class="col-md-4 bg-white p-2 mt-md-2">
                    <div>
                        <h5 class="pb-1">Address</h5>
                    </div>

                    <div>
                        <b class="pb-1"><?= $row_for_address['name'] ?></b><br><br>
                    </div>
                    <div>
                        <p><?= $row_for_address['address'] ?></p>
                        <b>Locality:</b>
                        <span><?= $row_for_address['locality'] ?></span><br>

                        <b>City:</b>
                        <span><?= $row_for_address['city'] ?></span><br>

                        <b>State:</b>
                        <span><?= $row_for_address['state'] ?></span><br>

                        <b>Pin Code:</b>
                        <span><?= $row_for_address['pin_code'] ?></span><br>
                    </div><br>

                    <div>
                        <b>Phone Number:</b>
                        <p><?= $row_for_address['mobile'] ?></p>
                    </div>
                </div>  
            </div>

            <div class="row px-3">
                 <div class="col bg-white p-2 my-2">
                    <div class="delivery-status-event-container">
                        <div class="delivery-status-event">
                        <?php 
                        
                            $order_event=json_decode($row['order_event'], true);
        
                            for($i=0; $i<count($order_event); $i++)
                            {
                                if($order_event[$i]['event_name']!='order canceled')
                                {
                                    echo '
                                    <div class="delivery-status-order-confirmed ">
                                        <div class="delivery-status-text">
                                            <span>'.$order_event[$i]['event_name'].'</span>
                                        </div>
                                        <div class="delivery-status-date-time">
                                            <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                                        </div>
                                    </div>';
                                }   
                                else
                                {
                                    echo '
                                    <div class="delivery-status-order-canceled ">
                                        <div class="delivery-status-text">
                                            <span>'.$order_event[$i]['event_name'].'</span>
                                        </div>
                                        <div class="delivery-status-date-time">
                                            <span>'.$order_event[$i]['Date'].' '.$order_event[$i]['Time'].'</span>
                                        </div>
                                    </div>';
                                }
                                
                            }
                        
                        ?>
                            
                        </div>
                    </div>                                                                      
                </div>
            </div>

            <div class="row px-3">
                
            <?php

                if($row['order_status']!='delivered' && $row['order_status']!='canceled')
                {
                    echo '
                    
                        <div class="col bg-white p-2 my-2 d-flex justify-content-end">
                            <button class="btn btn-danger btn-sm cancel-order-btn" data-order-id="'.$_GET['Oid'].'">Cancel Order</button>                                              
                        </div>
                    
                    ';
                }

            ?>

            </div>

        </div>

        

    </div>
</main>
<!--/main-->


<?php include("footer.php"); ?>