<?php

include("header.php");

$data=$_GET['data'];
$product_details=base64_decode($data);
$product_details_json=json_decode($product_details, true);
$total_price=0;
for($i=0; $i<count($product_details_json); $i++)
{
    // echo $product_details_json[$i]['product_id'].' '.$product_details_json[$i]['quantity'].' '.$product_details_json[$i]['price_single_unit'].' '.$product_details_json[$i]['total_price'].' '.$product_details_json[$i]['order_id'].'<br/>';
    $total_price +=$product_details_json[$i]['total_price'];
}
?>


<?php

$html='';

$sql3="select * from orders where order_id='{$product_details_json[0]['custom_order_id']}' and is_deleted=0";
$result3=mysqli_query($con, $sql3);
if(mysqli_num_rows($result3)>0)
{
$row3=mysqli_fetch_assoc($result3);

// $sql="select sum(total_price) from orders where "

$html .='
        
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
                    <p>Order placed for $'.number_format($total_price).'!</p>
                </div>
            </div>
        </div>
        <div class="order-details-container">
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
            
            $sql2="select * from products where product_id={$product_details_json[0]['product_id']} and is_deleted=0";
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

                    <div class="order-id-container">
                        <p>Order id &nbsp;&nbsp;</p> <span> '.$product_details_json[0]['custom_order_id'].'</span>
                    </div>

                    <div class="cart-item-price">
                        $'.number_format($row3['total_price']).'
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="product-details-list-container">';

    for($i=1; $i<count($product_details_json); $i++)
    {
        $sql2="select * from products where product_id='{$product_details_json[$i]['product_id']}' and is_deleted=0";
        $result2=mysqli_query($con, $sql2);
        if(mysqli_num_rows($result2)>0)
        {
            $row2=mysqli_fetch_assoc($result2);
        }

        $sql3="select * from orders where order_id='{$product_details_json[$i]['custom_order_id']}' and is_deleted=0";
        $result3=mysqli_query($con, $sql3);
        if(mysqli_num_rows($result3)>0)
        {
            $row3=mysqli_fetch_assoc($result3);
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

                    <div class="order-id-container">
                        <p>Order id &nbsp;&nbsp;</p> <span> '.$product_details_json[$i]['custom_order_id'].'</span>
                    </div>

                    <div class="cart-item-price">
                        $'.number_format($row3['total_price']).'
                    </div>
                </div>
            </div>';
    }

    $html .='
        
    </div>

</div>
        
        ';
}
echo $html;
?>
        
</div>


<?php include('footer.php') ?>