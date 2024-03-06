<?php

include("header.php");

$order_id=$_GET['orderId'];

?>



<?php

$html='';

$sql3="select * from orders where order_id='{$order_id}' and is_deleted=0";
$result3=mysqli_query($con, $sql3);
if(mysqli_num_rows($result3)>0)
{

$row3=mysqli_fetch_assoc($result3);

$html .='
<section class="product-details-area pt-100 pb-70">
        <!-- middle part  -->
<div class="middle">
    <!-- code for order placed and orderid and transaction -->
    <div class="order-placed-banner-container">
        <div class="order-placed-container">
            <div class="order-placed">
                <div class="order-placed-img">
                    <img src="images/order-placed.png">
                </div>
                <div class="order-placed-msg">
                    <p>Order placed for $'.number_format($row3['total_price']).'!</p>
                </div>
            </div>
        </div>
        <div class="order-details-container">
            <div class="order-id-container">
                <p>Order id &nbsp;&nbsp;</p> <span> '.$row3['order_id'].'</span>
            </div>
            <div class="transaction-id-container">
                ';
                if($row3['transaction_id']!=null)
                {
                    $html .='<p>Transaction id &nbsp;&nbsp;</p> <span> '.$row3['transaction_id'].' </span>';
                }
$html .='
            </div>
        </div>
    </div>

    <!-- code for address and product details  -->
    <div class="address-and-product-container">';
?>
        <?php 
        
        $sql2="select * from address where address_id={$row3['address_id']} and is_deleted=0";
        $result2=mysqli_query($con, $sql2);
        if(mysqli_num_rows($result2)>0)
        {
            $row2=mysqli_fetch_assoc($result2);
        }

        
$html .='
        <div class="delivery-address-container">
            <div class="delivery-address-title">
                <p>Delivery Address</p>
            </div>
            <div class="delivery-person-name">
                <p>'.$row2['name'].'</p>
            </div>
            <div class="delivery-address-details">
                <p>'.$row2['address'].', '.$row2['locality'].'</p>
                <p> '.$row2['city'].', '.$row2['pin_code'].', '.$row2['state'] .'</p>
            </div>
            <div class="delivery-person-number">
                <p>Phone Number &nbsp;&nbsp;</p>
                <span>'.$row2['mobile'].'</span>
            </div>
        </div>

        <div class="product-details-container">';

            
            
            $sql2="select * from products where product_id={$row3['product_id']} and is_deleted=0";
            $result2=mysqli_query($con, $sql2);
            if(mysqli_num_rows($result2)>0)
            {
                $row2=mysqli_fetch_assoc($result2);
            }

            
    $html .='
            <div class="cart-item-details-container">
                <div class="cart-item-image-container">
                    <img src="images/products/'.$row2['product_image'].'" alt="">
                </div>
                <div class="cart-item-details">
                    <div class="name-desc-container">
                        <div class="cart-item-name">
                            '.$row2['product_name'].'
                        </div>
                        <div class="cart-item-desc">
                            '.$row2['product_desc'].'
                        </div>
                    </div>
                    
                    <div class="quantity-container">
                        <p>Quantity: &nbsp;</p>
                        <p>'.$row3['quantity'].'</p>
                    </div>
                    <div class="cart-item-price">
                        $'.number_format($row3['total_price']).'
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</section>        
        ';
}
echo $html;
?>
        
    </div>

<?php include('footer.php') ?>