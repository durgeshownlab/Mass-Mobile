<?php 

include('header.php'); 

if(!isset($_GET['sub_cat_id']))
{
    exit;
}

$sub_cat_id=$_GET['sub_cat_id'];

?>

        <!-- Start Page Banner -->
        <div class="page-banner-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>All Products</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>All Products</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->


<?php
 
$sql_product1="select * from products where sub_category_id={$sub_cat_id} and is_deleted=0 order by rand()";
$result_product1=mysqli_query($con, $sql_product1);

?>

         <!-- Start Top Products Area -->
         <section class="top-products-area pt-100 pb-100">
            <div class="container">
                <div class="E-Shop Baba-grid-sorting row align-items-center">
                    <div class="col-lg-6 col-md-6 result-count pb-50">
                        <p>We found <span class="count"><?= mysqli_num_rows($result_product1) ?></span> Products available for you</p>
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

                    <!-- <div class="col-lg-12 col-md-12">
                        <div class="pagination-area">
                            <a href="#" class="prev page-numbers">
                                <i class="flaticon-left-arrow"></i>
                            </a>
                            <a href="#" class="page-numbers">1</a>
                            <span class="page-numbers current" aria-current="page">2</span>
                            <a href="#" class="page-numbers">3</a>
                            <a href="#" class="page-numbers">4</a>
                            <a href="#" class="next page-numbers">
                                <i class="flaticon-right-arrow"></i>
                            </a>
                        </div>
                    </div> -->
                </div>
            </div>
        </section>
        <!-- End Top Products Area -->
        
        <?php include('footer.php'); ?>
