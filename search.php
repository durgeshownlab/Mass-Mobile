<?php 

include('header.php'); 

if(!isset($_GET['search']))
{
    exit;
}

$search=$_GET['search'];


?>

        <!-- Start Page Banner -->
        <div class="page-banner-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Searched Products</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Searched Products</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

<?php
 
$sql_product1="select * from products where product_name like '%{$search}%' and is_deleted=0 order by rand()";
$result_product1=mysqli_query($con, $sql_product1);

?>

         <!-- Start Top Products Area -->
         <section class="top-products-area pt-100 pb-100">
            <div class="container">
                <div class="E-Shop Baba-grid-sorting row align-items-center">
                    <div class="section-title">
            <h2>Products Searched By You</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua quis ipsum suspendisse</p>
        </div>
        <div class="col-lg-6 col-md-6 result-count pb-50">
                        <p>We found <span class="count"><?= mysqli_num_rows($result_product1) ?></span> Sub Categories available for you</p>
                    </div>
    
                </div>
                
                <div class="row">


                <?php

if(mysqli_num_rows($result_product1)>0)
{
    while($row_product1=mysqli_fetch_assoc($result_product1))
    {
        echo '
        <div class="col-lg-3 col-md-6">
            <div class="top-products-item">
                <div class="products-image">
                    <a href="shop-details.php?pid='.$row_product1['product_id'].'"><img src="images/products/'.$row_product1['product_image'].'" alt="image"></a>

                    <ul class="products-action">
                        <li>
                            <a href="cart.php" class="add-cart-btn" data-tooltip="tooltip" data-placement="top" title="Add to Cart" data-product-id="'.$row_product1['product_id'].'">
                                <i class="flaticon-shopping-cart"></i>
                            </a>
                        </li>
                        <li>
                            <a href="wish-list.php" class="add-wishlist-btn" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist" data-product-id="'.$row_product1['product_id'].'">
                                <i class="flaticon-heart"></i>
                            </a>
                        </li>
                    </ul>

                </div>

                <div class="products-content">
                    <h3>
                        <a href="shop-details.php?pid='.$row_product1['product_id'].'">'.$row_product1['product_name'].'</a>
                    </h3>
                    <div class="price">
                        <span class="new-price">$'. number_format($row_product1['product_price']) .'</span>
                        <span class="old-price">$'. number_format($row_product1['base_price']) .'</span>
                    </div>
                </div>
            </div>
        </div>
        ';

    }
}
else
{
    echo 'Product Not Found!';
}

?>

                    <!-- <div class="col-lg-3 col-md-6">
                        <div class="top-products-item">
                            <div class="products-image">
                                <a href="shop-details.php"><img src="images/sub-category/baritone.jpg" alt="image"></a>
                            </div>

                            <div class="products-content">
                                <h3>
                                    <a href="shop-details.php">Cucumber</a>
                                </h3>
                                <div class="price">
                                    <span class="new-price">$38.00</span>
                                    <span class="old-price">$125.00</span>
                                </div>
                            </div>
                        </div>
                    </div> -->

                    
                </div>
            </div>
        </section>
        <!-- End Top Products Area -->
        
        <?php include('footer.php'); ?>
