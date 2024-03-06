<?php 

include('header.php'); 

$shownProduct=array(0);

?>

<!-- Start Main Slider Area -->
<div class="main-slider-area">
    <div class="home-slides owl-carousel owl-theme">

<?php

$sql_banner="select * from banners where is_deleted=0";
$result_banner=mysqli_query($con, $sql_banner);

if(mysqli_num_rows($result_banner)>0)
{
    while($row_banner=mysqli_fetch_assoc($result_banner))
    {
        // <b>'.ucwords(strtolower($row_sub_cat1['name'])).'</b>
        echo '
        <div class="main-slider-item main-slider-two">
            <div class="main-slider-image-wrap">
                <a href="#">
                    <img src="images/banner/'.$row_banner['banner_image'].'" alt="image">
                </a>
            </div>
        </div>
        ';

    }
}

?>

        <!-- <div class="main-slider-item main-slider-two">
            <div class="main-slider-image-wrap">
                <a href="#">
                    <img src="assets/img/main-slider/banner1.jpg" alt="image">
                </a>
            </div>
        </div> -->

    </div>

</div>
<!-- End Main Slider Area -->

<!-- Start Most Viewed clothes Products Area -->
<section class="featured-products-area pt-70">
    <div class="container">
        <div class="section-title">
            <h2>Shop by Category</h2>
            <p>Harmonize Your Sound: Discover Brass, Silver, and Wooden Instruments!</p>
        </div>

        <div class="featured-products-slider owl-carousel owl-theme">
<?php

$sql_sub_cat1="select * from sub_category where is_deleted=0 order by rand() limit 10";
$result_sub_cat1=mysqli_query($con, $sql_sub_cat1);

if(mysqli_num_rows($result_sub_cat1)>0)
{
    while($row_sub_cat1=mysqli_fetch_assoc($result_sub_cat1))
    {
        // <b>'.ucwords(strtolower($row_sub_cat1['name'])).'</b>
        echo '
            <div class="featured-products-item">
                <div class="products-image">
                    <a href="all-products.php?sub_cat_id='.$row_sub_cat1['sub_category_id'].'"><img src="images/sub-category/'.$row_sub_cat1['sub_category_image'].'" alt="image"></a>
                </div>
                <div class="products-content" style="margin-top: 10px;">
                    <h3>
                        <a href="all-products.php?sub_cat_id='.$row_sub_cat1['sub_category_id'].'">'.$row_sub_cat1['name'].'</a>
                    </h3>
                </div>
            </div>
        ';

    }
}

?>


        </div>
    </div>
</section>




<section>
    <div class="container">
        <img src="./assets/img/page-banner/banner12.jpg" alt="banner image">
    </div>
</section>

<!-- Start Department Area -->
<section class="department-area pb-70">
    <div class="container">

        <div class="row">

<?php
 
$sql_cat="select * from category where is_deleted=0";
$result_cat=mysqli_query($con, $sql_cat);

if(mysqli_num_rows($result_cat)>0)
{
    while($row_cat=mysqli_fetch_assoc($result_cat))
    {
        echo '
        <div class="col-lg-3 col-md-6">
            <div class="">
                <div class="department-image">
                    <a href="sub-cat.php?cat_id='.$row_cat['id'].'">
                        <img src="images/category/'.$row_cat['image'].'" alt="image">
                    </a>
                </div>
            </div>
        </div>
        ';

    }
}

?>
             <!-- <div class="content pt-3 pb-5">
                <h5 class="text-center">
                    <a href="shop-details.php?pid='.$row_cat['id'].'">'.$row_cat['name'].'</a>
                </h5>
            </div> -->

            <!-- <div class="col-lg-3 col-md-6">
                <div class="">
                    <div class="department-image">
                        <a href="#">
                            <img src="assets/img/other-products/3VALVE-EUPHONIUM.jpg" alt="image">
                        </a>

                        <div class="content">
                            <h5 class="text-center">
                                <a href="#">Fresh Milk</a>
                            </h5>
                        </div>
                    </div>
                </div>
            </div> -->

            
        </div>
    </div>
</section>
<!-- End Department Area -->


<!-- Start Featured Products Area -->
<section class="featured-products-area pb-70">
    <div class="container">
        <div class="section-title">
            <h2>Featured Products</h2>
            <p>Elevating Melodies with Brass, Silver, and Wooden Wonders!</p>
        </div>

        <div class="row">

<?php
 
$sql_product1="select * from products where product_id not in (".implode(', ', $shownProduct).") and is_deleted=0 order by rand() limit 4";
$result_product1=mysqli_query($con, $sql_product1);

if(mysqli_num_rows($result_product1)>0)
{
    while($row_product1=mysqli_fetch_assoc($result_product1))
    {
        array_push($shownProduct, $row_product1['product_id']);
        echo '
        <div class="col-lg-3 col-md-6">
            <div class="featured-products-item">
                <div class="products-image">
                    <a href="shop-details.php?pid='.$row_product1['product_id'].'">
                        <img src="images/products/'.$row_product1['product_image'].'" alt="image">
                    </a>

                    

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

?>


        </div>
    </div>
</section>
<!-- End Featured Products Area -->



<!-- Start Best Sellers Products Area -->
<section class="top-products-area pb-100">
    <div class="container">
        <div class="section-title">
            <h2>Best Sellers Products</h2>
            <p>Sound Craftsmanship: Unveil the Brilliance of Brass, Silver, and Wood!</p>
        </div>

        <div class="top-products-slider owl-carousel owl-theme">

<?php
 
$sql_product1="select * from products where product_id not in (".implode(', ', $shownProduct).") and is_deleted=0 order by rand() limit 4";
$result_product1=mysqli_query($con, $sql_product1);

if(mysqli_num_rows($result_product1)>0)
{
    while($row_product1=mysqli_fetch_assoc($result_product1))
    {
        array_push($shownProduct, $row_product1['product_id']);
        echo '
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
        ';

    }
}

?>

                    <!-- <li>
                        <a href="#" data-tooltip="tooltip" data-placement="top" title="Quick View" data-toggle="modal" data-target="#productsQuickView">
                            <i class="flaticon-search"></i>
                        </a>
                    </li> -->
            <!-- <div class="top-products-item">
                <div class="products-image">
                    <a href="shop-details.php"><img src="assets/img/best-seller-products/folk-pipe.png" alt="image"></a>

                </div>

                <div class="products-content">
                    <h3>
                        <a href="shop-details.php">Folk Pipe</a>
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
<!-- End Best Sellers Products Area -->

<!-- Start Overview Area -->
<section class="overview-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 col-sm-6">
                <div class="overview-content">
                    <h3>Best Offers in This Week </h3>
                    <p>Get Best Offers in This Week on Brass, Silver, and Wooden Instruments This Week!</p>

                    <div class="overview-btn">
                        <a href="index.php" class="default-btn">Discover Now</a>
                    </div>
                </div>
            </div>

            <!-- <div class="col-lg-6 col-sm-6">
                <div class="overview-video">
                    <a href="https://www.youtube.com/watch?v=Jh5oX0VRnzk" class="video-btn popup-youtube">
                        <i class='bx bxl-youtube'></i>
                    </a>
                </div>
            </div> -->
        </div>
    </div>
</section>
<!-- End Overview Area -->

<!-- Start Most Viewed Products Area -->
<section class="top-products-area pb-50 pt-100">
    <div class="container">
        <div class="section-title">
            <h2>Client’s Testimonial</h2>
            <p>Celebrating Success Stories, One Happy Customer at a Time</p>
        </div>

        <div class="top-products-slider owl-carousel owl-theme">
            <div class="top-products-item">
                <div class="card">
                    <div class="layer"></div>
                    <div class="content">
                        <p><span style="color: #283796; font-size: 2.5rem;">❝</span>I've been a loyal customer of Tapti Store for years, and they never disappoint. Their collection of brass instruments, like the euphonium and bugle, is top-notch. <span
                                style="color: #283796; font-size: 2.5rem; position:relative; top: 1.6rem;">❞</span>
                        </p>
                        <div class="image">
                            <img src="assets/img/client/amit.jpg" alt="">

                        </div>
                        <div class="details pt-2">
                            <h2>
                                Amit Saxena<br>
                                <span>Most Purchasing Buyer</span>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="top-products-item">
                <div class="card">
                    <div class="layer"></div>
                    <div class="content">
                        <p><span style="color: #283796; font-size: 2.5rem;">❝</span>As a professional musician, I value quality and precision in my instruments. Tapti Store's silver instruments, such as the mellophone and pocket trumpet, have always...<span
                                style="color: #283796; font-size: 2.5rem; position:relative; top: 1.6rem;">❞</span>
                        </p>
                        <div class="image">
                            <img src="assets/img/client/sumit.jpg" alt="">

                        </div>
                        <div class="details pt-2">
                            <h2>
                                Sumit Batra<br>
                                <span>Most Purchasing Buyer</span>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="top-products-item">
                <div class="card">
                    <div class="layer"></div>
                    <div class="content">
                        <p><span style="color: #283796; font-size: 2.5rem;">❝</span>Tapti Store is a hidden gem in New Delhi for all music enthusiasts. Their diverse range of instruments, from brass to silver to wooden, ensures there's something...<span
                                style="color: #283796; font-size: 2.5rem; position:relative; top: 1.6rem;">❞</span>
                        </p>
                        <div class="image">
                            <img src="assets/img/client/abhishek.jpg" alt="">

                        </div>
                        <div class="details pt-2">
                            <h2>
                                Abhishek Malhotra<br>
                                <span>Most Purchasing Buyer</span>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>

            <div class="top-products-item">
                <div class="card">
                    <div class="layer"></div>
                    <div class="content">
                        <p><span style="color: #283796; font-size: 2.5rem;">❝</span>Tapti Store's wooden instruments are a music lover's paradise. The sitar and clarinet I purchased were not only beautifully crafted but also delivered a rich and authentic sound.<span
                                style="color: #283796; font-size: 2.5rem; position:relative; top: 1.6rem;">❞</span>
                        </p>
                        <div class="image">
                            <img src="assets/img/client/suneha.jpg" alt="">

                        </div>
                        <div class="details pt-2">
                            <h2>
                                Sneha Kushwah<br>
                                <span>Most Purchasing Buyer</span>
                            </h2>
                        </div>
                    </div>
                </div>

            </div>


        </div>
    </div>
</section>
<!-- End Most Viewed Products Area -->


<!-- --------start blog area----------------- -->
<section class="latest-blog-area pt-100 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-title">
                    <h2>Our Blog</h2>
                    <p>There are latest blog posts</p>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-4 slick-slide mob-mb" data-slick-index="0" aria-hidden="false">
                        <div>
                            <div class="blog-post-item" style="width: 100%; display: inline-block;">
                                <figure class="#">
                                    <a href="blog-details.php" tabindex="0">
                                        <img src="./assets/img/blog/Bass-Sarod.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">

                                    <h3 class="blog-title" style="margin-top: 0;">
                                        <a href="blog-details.php"
                                            tabindex="0">Bass Sarod Musical Instruments</a>
                                    </h3>
                                    <p class="blog-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto quisquam soluta unde voluptatum. Sit unde eos, perspiciatis!... </p>
                                    <a href="blog-details.php"
                                        class="read-more" tabindex="0">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 slick-slide mob-mb" data-slick-index="2" aria-hidden="false">
                        <div>
                            <div class="blog-post-item" style="width: 100%; display: inline-block;">
                                <figure class="blog-thumb">
                                    <a href="blog-details.php" tabindex="0">
                                        <img src="./assets/img/blog/flugelhornblue.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <h3 class="blog-title" style="margin-top: 0;">
                                        <a href="blog-details.php"
                                            tabindex="0"> Flugel Horn Musical Instruments</a>
                                    </h3>
                                    <p class="blog-desc">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quidem accusantium blanditiis amet dolor ab quo sequi. Assumenda, corrupti. Quam...</p>
                                    <a href="blog-details.php"
                                        class="read-more" tabindex="0">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 slick-slide mob-mb" data-slick-index="1" aria-hidden="false">
                        <div>
                            <div class="blog-post-item" style="width: 100%; display: inline-block;">
                                <figure class="blog-thumb">
                                    <a href="blog-details.php" tabindex="0">
                                        <img src="./assets/img/blog/cornet-silver.jpg" alt="blog image">
                                    </a>
                                </figure>
                                <div class="blog-content">
                                    <h3 class="blog-title" style="margin-top: 0;">
                                        <a href="blog-details.php"
                                            tabindex="0">Cornet Silver Musical Instruments</a>
                                    </h3>
                                    <p class="blog-desc">Lorem ipsum dolor sit amet consectetur adipisicing elit. Optio harum assumenda accusamus quia doloremque incidunt provident quo, amet suscipit... </p>
                                    <a href="blog-details.php"
                                        class="read-more" tabindex="0">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- --------end blog area----------------- -->

<!-- Start Partner Area -->
<div class="partner-area ptb-70">
    <div class="container">
        <div class="section-title">
            <h2>Recommended By Tapti Store</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua quis ipsum suspendisse</p>
        </div>
        <div class="partner-slider owl-carousel owl-theme">

<?php
 
 $sql_product1="select * from products where product_id in (".implode(', ', $shownProduct).") and is_deleted=0 order by rand() limit 5";
 $result_product1=mysqli_query($con, $sql_product1);
 
 if(mysqli_num_rows($result_product1)>0)
 {
     while($row_product1=mysqli_fetch_assoc($result_product1))
     {
         array_push($shownProduct, $row_product1['product_id']);
         echo '
            <div class="partner-item">
                <a href="shop-details.php?pid='.$row_product1['product_id'].'">
                    <img src="images/products/'.$row_product1['product_image'].'" alt="image" style="border: 2px solid #283796;">
                </a>
                <div class="products-content mt-3">
                    <h6 class="text-center">
                        <a href="shop-details.php?pid='.$row_product1['product_id'].'">'.$row_product1['product_name'].'</a>
                    </h6>
                </div>
            </div>
         ';
 
     }
 }
 
 ?>
            

        </div>
    </div>
</div>
<!-- End Partner Area -->


<!-- Start Newsletter Area -->
<div class="newsletter-area ptb-100">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <div class="newsletter-content">
                    <h2>Subscribe To Our Newsletter</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua quis ipsum suspendisse</p>
                </div>
            </div>

            <div class="col-lg-6">
                <form class="newsletter-form">
                    <input type="email" class="input-newsletter" placeholder="Enter Email Address" name="EMAIL" required
                        autocomplete="off">

                    <button type="submit">Subscribe Now</button>

                    <div id="validator-newsletter" class="form-result"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Newsletter Area -->



<?php include('footer.php'); ?>