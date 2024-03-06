<?php 

include ('header.php'); 

if(!isset($_GET['pid']))
{
    echo "<script>window.location.href = 'index.php';  </script>";
}

$pid=$_GET['pid'];

$sql_product="select * from products where product_id={$pid} and is_deleted=0";
$result_product=mysqli_query($con, $sql_product);
if(mysqli_num_rows($result_product)>0)
{
    $row_product=mysqli_fetch_assoc($result_product);

    $sql_specification="select * from specifications where product_id={$pid} and is_deleted=0";
    $result_specification=mysqli_query($con, $sql_specification);
    if(mysqli_num_rows($result_specification)>0)
    {
        $row_specification=mysqli_fetch_assoc($result_specification);
    }
    
    $sql_sub_cat="select * from sub_category where sub_category_id={$row_product['sub_category_id']} and is_deleted=0";
    $result_sub_cat=mysqli_query($con, $sql_sub_cat);
    if(mysqli_num_rows($result_sub_cat)>0)
    {
        $row_sub_cat=mysqli_fetch_assoc($result_sub_cat);
    }
    
}

?>
        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Product Details</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Product Details</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Product Details Area -->
        <section class="product-details-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-12">
                                <div class="product-details-image">
                                    <img src="images/products/<?= $row_product['product_image'] ?>" alt="">
                                </div>
                            </div>
        
                            <div class="col-lg-6 col-md-12">
                                <div class="product-details-desc">
                                    <h3><?= ucwords(strtolower($row_product['product_name'])) ?></h3>
                                    <div class="price">
                                        <span class="new-price">$ <?= ucwords(strtolower(number_format($row_product['product_price']))) ?></span>
                                    </div>
                                    <!-- <div class="product-review">
                                        <div class="rating">
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                            <i class='bx bxs-star'></i>
                                        </div>
                                        <a href="#" class="rating-count">3 reviews</a>
                                    </div> -->
                                    <p class="pb-2"><?= ucwords(strtolower($row_product['product_desc'])) ?></p>

                                    <table class="table table-striped">
                                    <tbody>
                                        <?php
                                            foreach ($result_specification as $key => $value) {
                                                echo '
                                                <tr>
                                                    <td>'.$value['name'].'</td>
                                                    <td>'.$value['value'].'</td>
                                                </tr>
                                                ';
                                            }
                                        ?>
                                            
                                        </tbody>
                                    </table>
                                    
                                    <div class="product-add-to-cart">
                                        <div class="input-counter">
                                            <span class="minus-btn">
                                                <i class='bx bx-minus'></i>
                                            </span>
                                            <input type="text" min="1" value="1" id="quantity-field">
                                            <span class="plus-btn">
                                                <i class='bx bx-plus'></i>
                                            </span>
                                        </div>
                                        <button class="default-btn add-cart-quantity-btn" data-product-id="<?= $row_product['product_id'] ?>">
                                            <i class='bx bx-cart'></i>
                                            Add to cart
                                            <span></span>
                                        </button>
                                    </div>
        
                                    <div class="buy-checkbox-btn">
                                        <div class="item">
                                            <a href="checkout.php?pid=<?= $pid ?>" class="btn btn-light buy-now-btn" data-product-id="<?= $pid ?>"><i class='bx bxs-store' ></i> Buy it now!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="tab products-details-tab">
                            <div class="row">
                                <div class="col-lg-12 col-md-12">
                                    <ul class="tabs">
                                        <li>
                                            <a href="#">
                                                <div class="dot"></div> 
                                                Description
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <div class="dot"></div> 
                                                Reviews
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="tab_content">
                                        <div class="tabs_item">
                                            <div class="products-details-tab-content">
                                                <p><?= ucwords(strtolower($row_product['product_desc'])) ?></p>
                                            </div>
                                        </div>

                                        <div class="tabs_item">
                                            <div class="products-details-tab-content">
                                                <div class="product-review-form">
                                                    <h3>Customer Reviews</h3>
                                                    <div class="review-title">
                                                        <div class="rating">
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                            <i class='bx bxs-star'></i>
                                                        </div>
                                                        <p>Based on 3 reviews</p>
                                                        <a href="#" class="default-btn">
                                                            Write a Review
                                                        </a>
                                                    </div>
                                                    <div class="review-comments">
                                                        <div class="review-item">
                                                            <div class="rating">
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                            </div>
                                                            <h3>Good</h3>
                                                            <span><strong>Admin</strong> on <strong>Sep 21, 2020</strong></span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                                            <a href="#" class="review-report-link">Report as Inappropriate</a>
                                                        </div>
                                                        <div class="review-item">
                                                            <div class="rating">
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                            </div>
                                                            <h3>Good</h3>
                                                            <span><strong>Admin</strong> on <strong>Sep 21, 2020</strong></span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                                            <a href="#" class="review-report-link">Report as Inappropriate</a>
                                                        </div>
                                                        <div class="review-item">
                                                            <div class="rating">
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                                <i class='bx bxs-star'></i>
                                                            </div>
                                                            <h3>Good</h3>
                                                            <span><strong>Admin</strong> on <strong>Sep 21, 2020</strong></span>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation.</p>
                                                            <a href="#" class="review-report-link">Report as Inappropriate</a>
                                                        </div>
                                                    </div>
                                                    <div class="review-form">
                                                        <h3>Write a Review</h3>
                                                        <form>
                                                            <div class="row">
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="text" id="name" name="name" placeholder="Enter your name" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <input type="email" id="email" name="email" placeholder="Enter your email" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="text" id="review-title" name="review-title" placeholder="Enter your review a title" class="form-control">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <textarea name="review-body" id="review-body" cols="30" rows="7" placeholder="Write your comments here" class="form-control"></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-12 col-md-12">
                                                                    <button type="submit" class="default-btn">
                                                                        Submit Review
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </section>
        <!-- End Product Details Area -->

        <!-- Start Featured Products Area -->
        <section class="featured-products-area bg-fafafa ptb-70">
    <div class="container">
        <div class="section-title">
            <h2>Related Products</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua quis ipsum suspendisse</p>
        </div>

        <div class="top-products-slider owl-carousel owl-theme">
<?php

$sql_related_product="select products.product_id as product_id, products.product_image as product_image, products.product_name as product_name, products.product_price as product_price, products.base_price as base_price from products join sub_category on products.sub_category_id=sub_category.sub_category_id join category on sub_category.category_id=category.id where sub_category.category_id={$row_sub_cat['category_id']} and sub_category.is_deleted=0 and category.is_deleted=0 and products.is_deleted=0";

$result_related_product=mysqli_query($con, $sql_related_product);

if(mysqli_num_rows($result_related_product)>0)
{
    while($row_related_product=mysqli_fetch_assoc($result_related_product))
    {
        echo '
        <div class="top-products-item">
            <div class="products-image">
                <a href="shop-details.php?pid='.$row_related_product['product_id'].'"><img src="images/products/'.$row_related_product['product_image'].'" alt="image"></a>

                <ul class="products-action">
                    <li>
                        <a href="cart.php" class="add-cart-btn" data-tooltip="tooltip" data-placement="top" title="Add to Cart" data-product-id="'.$row_related_product['product_id'].'">
                            <i class="flaticon-shopping-cart"></i>
                        </a>
                    </li>
                    <li>
                        <a href="wish-list.php" class="add-wishlist-btn" data-tooltip="tooltip" data-placement="top" title="Add to Wishlist" data-product-id="'.$row_related_product['product_id'].'">
                            <i class="flaticon-heart"></i>
                        </a>
                    </li>
                    
                </ul>

            </div>
            <div class="products-content">
                <h3>
                    <a href="shop-details.php?pid='.$row_related_product['product_id'].'">'.$row_related_product['product_name'].'</a>
                </h3>
                <div class="price">
                    <span class="new-price">$'. number_format($row_related_product['product_price']) .'</span>
                    <span class="old-price">$'. number_format($row_related_product['base_price']) .'</span>
                </div>
            </div>

            
        </div>
        ';
    }
    
}
// <div class="products-content">
//                 <h3>
//                 <a href="shop-details.php?pid='.$row_related_product['product_id'].'" class="nav-link">
//                     '.ucwords(strtolower($row_related_product['product_name'])).'
//                 </a>
//                 </h3>
//                 <div class="price">
//                     <span class="new-price"><b>PKR</b> '.ucwords(strtolower(number_format($row_related_product['product_price']))).'</span>
//                 </div>
//             </div>

?>

            <!-- <div class="top-products-item">
                <div class="products-image">
                    <a href="shop-details.php"><img src="assets/img/best-seller-products/cucumber.jpg" alt="image"></a>

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
            </div> -->
            
        </div>
    </div>
</section>
        <!-- End Featured Products Area -->
        
        <?php include ('footer.php'); ?>
