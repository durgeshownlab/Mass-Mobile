<?php include('header.php'); ?>

        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>My Orders</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>My Orders</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Cart Area -->
		<section class="cart-area ptb-100">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <form>
                            <div class="cart-table table-responsive">
                                


                                    <?php

$sql = "SELECT * FROM orders where user_id = {$_SESSION['user_id']} and is_deleted=0 order by order_date desc";
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {

    echo '
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product</th>
                <th>Order Id</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
    ';


    while ($order = mysqli_fetch_assoc($result)) {

        $sql = "SELECT * FROM products where product_id = {$order['product_id']} and is_deleted=0";
        $result_for_product = mysqli_query($con, $sql);

        if (mysqli_num_rows($result_for_product) == 1) {
            $product = mysqli_fetch_assoc($result_for_product);
            echo '
            <tr>
                <td class="d-flex align-items-center">
                    <div class="thumb_cart">
                        <img src="images/products/' . $product['product_image'] . '" data-src="images/products/' . $product['product_image'] . '" class="lazy loaded" alt="Image" data-was-processed="true" style="width: 50px; height: auto;">
                    </div>
                    <span class="item_cart pl-2"><a href="shop-details.php?pid='.$product['product_id'].'">' . ucwords($product['product_name']) . '</a></span>
                </td>
                <td>
                    <strong>' . $order['order_id'] . '</strong>
                </td>
                <td>
                    <strong><b>PKR</b> ' . number_format($order['price_single_unit']) . '</strong>
                </td>
                <td>
                    <div class="product-quantity-container">
                        <strong>' . $order['quantity'] . '</strong>
                    </div>
                </td>
                <td>
                    <strong>$' . number_format($order['total_price']) . '</strong>
                </td>
                <td>
                    <span style="';

                if($order['order_status']=='canceled')
                {
                    echo "color: red;";
                }
                else if($order['order_status']=='pending')
                {
                    echo "color: #ffa000;";
                }
                else if($order['order_status']=='delivered')
                {
                    echo "color: green;";
                }
                echo '                    
                    "> ' . $order['order_status'] . '</span>
                </td>
                <td class="options">
                    <a href="orderDetails.php?Oid='.$order['order_id'].'" class="view-order-btn text-light py-1 px-2 rounded" data-product-id="' . $product['product_id'] . '" style="background-color: #283796;" >View</a>
                </td>
            </tr>
            ';
        } 
        else {
            // exit;
        }
    }
} 
else {
    // exit;
    echo 'You have not ordered any product yet';
}

?>



</tbody>
                                        
                                    </tbody>
                                </table>
                            </div>
                            <div class="cart-buttons">
                                <div class="row align-items-center">
                                    <div class="col-lg-7 col-sm-7 col-md-7">
                                        <a href="index.php" class="default-btn">
                                            Back to Shop
                                        </a>
                                    </div>
                                </div>
                            </div>

                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
		<!-- End Cart Area -->
        
        <?php include('footer.php'); ?>
