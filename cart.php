<?php 

include('header.php'); 

if(!isset($_SESSION['user_id']) || !isset($_SESSION['user_type']) || !isset($_SESSION['email']))
{
    echo "<script>window.location.href = 'login.php';  </script>";
}

?>
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg2">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Cart</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Cart</li>
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


$sql = "SELECT * FROM cart where user_id = {$_SESSION['user_id']} and is_deleted=0";
$result = mysqli_query($con, $sql);

$total_price=0;

if(mysqli_num_rows($result)>0)
{

    echo '
    
    <table class="table table-bordered">
        <thead>
            <tr>
                <th scope="col">Product</th>
                <th scope="col">Name</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Total</th>
            </tr>
        </thead>
        <tbody>


    ';


	while($cart=mysqli_fetch_assoc($result))
    {

        $total_price += $cart['total_price'];

        $sql = "SELECT * FROM products where product_id = {$cart['product_id']} and is_deleted=0";
        $result_for_product = mysqli_query($con, $sql);

        if(mysqli_num_rows($result_for_product)==1)
        {
            $product=mysqli_fetch_assoc($result_for_product);
            echo '
            <tr>
                <td class="product-thumbnail">
                    <a href="shop-details.php?pid='.$product['product_id'].'">
                        <img src="images/products/'.$product['product_image'].'" alt="item">
                    </a>
                </td>
                <td class="product-name">
                    <a href="shop-details.php?pid='.$product['product_id'].'">'.ucwords(strtolower($product['product_name'])).'</a>
                </td>
                <td class="product-price">
                    <span class="unit-amount">$ '.number_format($product['product_price']).'</span>
                </td>
                <td class="product-quantity">
                    <div class="input-counter">
                        <span class="cart-quantity-minus minus-btn" data-product-id="'.$product['product_id'].'">
                            <i class="bx bx-minus"></i>
                        </span>
                        <input type="text" value="'.$cart['quantity'].'" min="1">
                        <span class="cart-quantity-plus plus-btn" data-product-id="'.$product['product_id'].'">
                            <i class="bx bx-plus"></i>
                        </span>
                    </div>
                </td>
                <td class="product-subtotal">
                    <span class="subtotal-amount">$'.number_format($cart['total_price']).'</span>
                    <a href="#" class="remove delete-cart-item-btn" data-product-id="'.$product['product_id'].'">
                        <i class="bx bx-trash"></i>
                    </a>
                </td>
            </tr>
            ';
        }
        else
        {
            exit;
        }
        
    }

    echo '
            </tbody>
        </table>
    ';
}
else
{
    // exit;
    echo 'Your Cart is Empty!';
}

?>
                                        
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

                            <div class="cart-totals">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li>Subtotal 
                                        <span>$<?= number_format($total_price) ?></span>
                                    </li>
                                    <li>Shipping 
                                        <span>$ 0</span>
                                    </li>
                                    <li>Total 
                                        <span><b>$ <?= number_format($total_price) ?></b></span>
                                    </li>
                                </ul>
                                <?php

                                if(mysqli_num_rows($result)>0)
                                {
                                    echo '
                                    <a href="cartCheckout.php" class="default-btn">
                                        Proceed to Checkout
                                    </a>';

                                }

                                ?>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
		<!-- End Cart Area -->
        
        <?php include('footer.php'); ?>
