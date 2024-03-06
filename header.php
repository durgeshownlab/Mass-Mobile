<?php

    session_start();
    include('config/config.php');

    if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type']=='admin' )
    {
        header('Location: admin/main/');
    }

?>

<!doctype html>
<html lang="zxx">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- Bootstrap CSS --> 
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <!-- Animate CSS --> 
        <link rel="stylesheet" href="assets/css/animate.min.css">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="assets/css/meanmenu.css">
        <!-- Boxicons CSS -->
        <link rel="stylesheet" href="assets/css/boxicons.min.css">
        <!-- Flaticon CSS -->
        <link rel="stylesheet" href="assets/css/flaticon.css">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="assets/css/nice-select.min.css">
        <!-- Owl Carousel CSS -->
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <!-- Owl Carousel Default CSS -->
        <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
        <!-- Odometer CSS -->
        <link rel="stylesheet" href="assets/css/odometer.min.css">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="assets/css/magnific-popup.min.css">
        <!-- Style CSS -->
        <link rel="stylesheet" href="assets/css/style.css">
        <!-- Responsive CSS -->
		<link rel="stylesheet" href="assets/css/responsive.css">

        <!-- success page CSS -->
		<link rel="stylesheet" href="assets/css/success.css">

        <!-- font awesome cdn link -->
        <script src="https://kit.fontawesome.com/ca7271c9b6.js" crossorigin="anonymous"></script>

		
		<title>Tapti Store</title>

        <link rel="icon" type="image/png" href="assets/img/favicon.png">
    </head>

    <body>
        
        <!-- Start Preloader Area -->
        <div class="preloader">
            <div class="preloader">
                <span></span>
                <span></span>
            </div>
        </div>
        <!-- End Preloader Area -->

        <!-- Start Top Header Area -->
        <div class="top-header-area">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-10">
                        <ul class="top-header-information d-sm-none d-lg-block">
                            <li>
                                Tapti Store Pannel
                            </li>
                            <li>
                                <i class='bx bxs-truck'></i>
                                Free Fast Delivery
                            </li>
                            <li>
                                <i class='bx bx-badge-check'></i>
                                Best Price Everyday
                            </li>
                            <li>
                                <i class='bx bxs-map'></i>
                                Uttam Nagar New Delhi -110059
                            </li>
                            <li>
                                <i class='bx bx-envelope'></i>
                                <a href="mailto:taptimusicals@gmail.com">taptimusicals@gmail.com</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-lg-2">
                        <ul class="top-header-social">
                            <li>
                                <a href="#" target="_blank">
                                    <i class='bx bxl-facebook'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class='bx bxl-twitter'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class='bx bxl-pinterest-alt'></i>
                                </a>
                            </li>
                            <li>
                                <a href="#" target="_blank">
                                    <i class='bx bxl-linkedin'></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Header Area -->

        <!-- Start Navbar Area -->
        <div class="navbar-area">
            <div class="main-responsive-nav">
                <div class="container">
                    <div class="main-responsive-menu">
                        <div class="logo">
                            <a href="index.php">
                                <img src="assets/img/logo.png" alt="image">
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div id="hide">
            <div class="main-navbar">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">
                        <a class="navbar-brand" href="index.php">
                            <img src="assets/img/logo.png" alt="image" width="160">
                        </a>

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav d-lg-none">
                                <li class="nav-item">
                                    <a href="index.php" class="nav-link active">
                                        Home 
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Account 
                                        <i class='bx bx-chevron-down'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <?php
                                            if(isset($_SESSION['user_id']) && isset($_SESSION['email']))
                                            {
                                                echo '
                                                <li class="nav-item">
                                                    <a href="wishlist.php" class="nav-link">
                                                        <i class="bx bx-heart px-2" style="font-size: 25px;"></i>
                                                        Wishlist
                                                    </a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a href="cart.php" class="nav-link">
                                                        <i class="bx bx-cart px-2" style="font-size: 25px;"></i>
                                                        Cart
                                                    </a>
                                                </li>
                                                
                                                <li class="nav-item">
                                                    <a href="myOrders.php" class="nav-link">
                                                        <i class="bx bx-store px-2" style="font-size: 25px;"></i>
                                                        My Orders
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="myProfile.php" class="nav-link">
                                                        <i class="bx bx-user px-2" style="font-size: 25px;"></i>
                                                        My Profile
                                                    </a>
                                                </li>

                                                <li class="nav-item">
                                                    <a href="logout.php" class="nav-link">
                                                        <i class="bx bx-exit px-2" style="font-size: 25px;"></i>
                                                        Logout
                                                    </a>
                                                </li>
                                                ';

                                            }
                                            else
                                            {
                                                echo '
                                                <li class="nav-item">
                                                    <a href="login.php" class="nav-link">
                                                        Login
                                                    </a>
                                                </li>
        
                                                <li class="nav-item">
                                                    <a href="register.php" class="nav-link">
                                                        Register
                                                    </a>
                                                </li>';
                                            }
                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a href="about.php" class="nav-link">
                                        About Us 
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link">
                                        Contact Us 
                                    </a>
                                </li>

                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Pages 
                                        <i class='bx bx-chevron-down'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="about.php" class="nav-link">
                                                About
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="team.php" class="nav-link">
                                                Team
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="pricing.php" class="nav-link">
                                                Pricing
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Gallery 
                                                <i class='bx bx-chevron-down'></i>
                                            </a>
        
                                            <ul class="dropdown-menu">
                                                <li class="nav-item">
                                                    <a href="gallery.php" class="nav-link">
                                                        Gallery
                                                    </a>
                                                </li>
        
                                                <li class="nav-item">
                                                    <a href="gallery-details.php" class="nav-link">
                                                        Gallery Details
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>

                                        <li class="nav-item">
                                            <a href="faq.php" class="nav-link">
                                                FAQ
                                            </a>
                                        </li>

                                        
                                    
                                        <li class="nav-item">
                                            <a href="error-404.php" class="nav-link">
                                                Error Page
                                            </a>
                                        </li>
                                
                                        <li class="nav-item">
                                            <a href="terms-of-service.php" class="nav-link">
                                                Terms of Service
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="privacy-policy.php" class="nav-link">
                                                Privacy Policy
                                            </a>
                                        </li>
                                    </ul>
                                </li> -->

                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Services 
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Shop 
                                        <i class='bx bx-chevron-down'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li class="nav-item">
                                            <a href="shop-1.php" class="nav-link">
                                                Shop List One
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="shop-2.php" class="nav-link">
                                                Shop List Two
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="cart.php" class="nav-link">
                                                Cart
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="checkout.php" class="nav-link">
                                                Checkout
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="shop-details.php" class="nav-link">
                                                Shop Details
                                            </a>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item">
                                    <a href="blog.php" class="nav-link">
                                        Blog 
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link">
                                        Contact
                                    </a>
                                </li> -->
                            </ul>

                            <div class="others-options d-flex align-items-center">
                                
                                <div class="option-item">
                                    <form class="search-box" id="search-form-id">
                                        <input type="text" class="form-control" id="search-input" name="search-input" placeholder="What can we help you find?">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>
                                    <div class="option-item">
                                        <div class="languages-list">
                                            <!-- <select>
                                                <option value="1">Eng</option>
                                                <option value="2">Ger</option>
                                                <option value="3">Span</option>
                                            </select> -->
                                        </div>
                                    </div>
    
                                    <div class="option-item">
                                        <div class="cart-btn">
                                            <a href="cart.php">
                                                <i class='flaticon-shopping-cart'></i>
                                                <span class="cart-item-count">0</span>
                                            </a>
                                        </div>
                                    </div>
    
                                    <div class="option-item">
                                        <div class="burger-menu">
                                            <span></span>
                                            <span></span>
                                            <span></span>
                                        </div>
                                    </div>

                            </div>
                        </div>
                    </nav>
                </div>
            </div>

            <div class="others-option-for-responsive">
                <div class="container">
                    <div class="dot-menu">
                        <div class="inner">
                            <div class="circle circle-one"></div>
                            <div class="circle circle-two"></div>
                            <div class="circle circle-three"></div>
                        </div>
                    </div>
                    
                    <div class="container">
                        <div class="option-inner">
                            <div class="others-options d-flex align-items-center">
                                <!-- <div class="option-item">
                                    <div class="languages-list">
                                        <select>
                                            <option value="1">Eng</option>
                                            <option value="2">Ger</option>
                                            <option value="3">Span</option>
                                        </select>
                                    </div>
                                </div> -->

                                <div class="option-item">
                                    <div class="cart-btn">
                                        <a href="cart.php">
                                            <i class='flaticon-shopping-cart'></i>
                                            <span class="cart-item-count">0</span>
                                        </a>
                                    </div>
                                </div>

                                <div class="option-item">
                                    <form class="search-box" id="search-form-id-mobile">
                                        <input type="text" class="form-control" id="search-input-mobile" name="search-input-mobile" placeholder="Search">
                                        <button type="submit"><i class="flaticon-search"></i></button>
                                    </form>
                                </div>

                                <div class="option-item">
                                    <div class="burger-menu">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>

            <div class="main-navbar d-sm-none d-lg-block">
                <div class="container">
                    <nav class="navbar navbar-expand-md navbar-light">

                        <div class="collapse navbar-collapse mean-menu" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a href="#" class="nav-link" style="background-color: #283796; padding:10px 24px; margin-top:15px; color:#fff;">
                                        All Categories &nbsp; 
                                        <i class='bx bx-menu'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        
                                        <?php
                                            $sql="select * from category where is_deleted=0";
                                            $result=mysqli_query($con, $sql);
                                            if(mysqli_num_rows($result)>0)
                                            {
                                                while($row=mysqli_fetch_assoc($result))
                                                {
                                                    echo '
                                                    <li class="nav-item">
                                                        <a href="sub-cat.php?cat_id='.$row['id'].'" class="nav-link">
                                                            '.ucwords(strtolower($row['name'])).'
                                                        </a>
                                                    </li>
                                                    ';
                                                }
                                            }
                                        ?>

                                        <!-- <li class="nav-item">
                                            <a href="#" class="nav-link">
                                                Kid's Fashion
                                            </a>
                                        </li> -->

                                    </ul>
                                </li>

                                <?php
                                    $sql_cat="select * from category where is_deleted=0 limit 3";
                                    $result_cat=mysqli_query($con, $sql_cat);
                                    if(mysqli_num_rows($result_cat)>0)
                                    {
                                        while($row_cat=mysqli_fetch_assoc($result_cat))
                                        {
                                            echo '
                                            <li class="nav-item">
                                                <a href="sub-cat.php?cat_id='.$row_cat['id'].'" class="nav-link">
                                                    '.ucwords(strtolower($row_cat['name'])).'
                                                    <i class="bx bx-chevron-down"></i>
                                                </a>
                                                ';
                                            
                                                $sql_sub_cat="select * from sub_category where category_id={$row_cat['id']} and is_deleted=0";
                                                $result_sub_cat=mysqli_query($con, $sql_sub_cat);
                                                if(mysqli_num_rows($result_sub_cat)>0)
                                                {
                                                    echo '<ul class="dropdown-menu">';
                                                    while($row_sub_cat=mysqli_fetch_assoc($result_sub_cat))
                                                    {
                                                        echo '
                                                        <li class="nav-item">
                                                            <a href="all-products.php?sub_cat_id='.$row_sub_cat['sub_category_id'].'" class="nav-link">
                                                                '.ucwords(strtolower($row_sub_cat['name'])).'
                                                                ';

                                                            $sql_product="select * from products where sub_category_id={$row_sub_cat['sub_category_id']} and is_deleted=0";
                                                            $result_product=mysqli_query($con, $sql_product);
                                                            if(mysqli_num_rows($result_product)>0)
                                                            {
                                                                echo '
                                                                    <i class="bx bx-chevron-right"></i>
                                                                </a>
                                                                <ul class="dropdown-menu">';
                                                                while($row_product=mysqli_fetch_assoc($result_product))
                                                                {
                                                                    echo '
                                                                    <li class="nav-item">
                                                                        <a href="shop-details.php?pid='.$row_product['product_id'].'" class="nav-link">
                                                                            '.ucwords(strtolower($row_product['product_name'])).'
                                                                        </a>';
                                                                     
                                                                    echo '
                                                                    </li>
                                                                    ';
                                                                }

                                                                echo '</ul>';
                                                            }
                                                            else
                                                            {
                                                                echo '</a>';
                                                            }

                                                        echo '
                                                        </li>
                                                        ';
                                                    }

                                                    echo '</ul>';
                                                }

                                            echo '   
                                            </li>
                                            ';
                                        }
                                    }
                                ?>

                                <!-- <li class="nav-item">
                                    <a href="#" class="nav-link">
                                        Kids's Fashion 
                                    </a>
                                </li> -->
                                

                                <li class="nav-item">
                                    <a href="about.php" class="nav-link">
                                        About Us 
                                    </a>
                                </li>

                                <li class="nav-item">
                                    <a href="contact.php" class="nav-link">
                                        Contact Us
                                    </a>
                                </li>
                        <?php
                            if(isset($_SESSION['user_id']) && isset($_SESSION['email']))
                            {
                                $first_name=explode(' ',$_SESSION['name']);
                                echo '
                                <li class="nav-item">
                                    <a href="#" class="nav-link d-flex align-items-center">
                                        <i class="bx bx-user-circle px-2" style="font-size: 25px;"></i>
                                        '. ucwords(strtolower($first_name[0])).' 
                                        <i class="bx bx-chevron-down px-2"></i>
                                    </a>

                                    <ul class="dropdown-menu" style="width:150px;">
                                        
                                               
                                        <li class="nav-item">
                                        <a href="wishlist.php" class="nav-link">
                                            <i class="bx bx-heart px-2" style="font-size: 25px;"></i>
                                            Wishlist
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a href="cart.php" class="nav-link">
                                                <i class="bx bx-cart px-2" style="font-size: 25px;"></i>
                                                Cart
                                            </a>
                                        </li>
                                        
                                        <li class="nav-item">
                                            <a href="myOrders.php" class="nav-link">
                                                <i class="bx bx-store px-2" style="font-size: 25px;"></i>
                                                My Orders
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="myProfile.php" class="nav-link">
                                                <i class="bx bx-user px-2" style="font-size: 25px;"></i>
                                                My Profile
                                            </a>
                                        </li>

                                        <li class="nav-item">
                                            <a href="logout.php" class="nav-link">
                                                <i class="bx bx-exit px-2" style="font-size: 25px;"></i>
                                                Logout
                                            </a>
                                        </li>
                                    </ul>
                                </li>';

                            }
                            else
                            {
                                echo '
                                <li class="nav-item">
                                    <a href="login.php" class="nav-link" style="background-color: #283796; padding:9px 15px; margin-top:15px; color:#fff; display: flex; justify-content: space-around; align-items: center; border-radius: 5px;">
                                        <i class="bx bx-user-circle pr-2" style="font-size: 25px;"></i>
                                        Login
                                    </a>
                                </li>';
                            }
                            ?>
                                    
                                
                            </ul>

                        </div>
                    </nav>
                </div>
            </div>
        </div>
        <!-- End Navbar Area -->

        <!-- Sidebar Modal -->
        <div class="sidebar-modal">
            <div class="sidebar-modal-inner">
                <div class="sidebar-about-area">
                    <div class="title">
                        <h2>About Us</h2>
                        <p>We believe brand interaction is key in communication. Real innovations and a positive customer experience are the heart of successful communication.</p>
                    </div>
                </div>

                <div class="sidebar-instagram-feed">
                    <h2>Product you must Watch</h2>
                    <ul>
                    <?php
 
 $sql_product1="select * from products where is_deleted=0 order by rand() limit 4";
 $result_product1=mysqli_query($con, $sql_product1);
 
 if(mysqli_num_rows($result_product1)>0)
 {
     while($row_product1=mysqli_fetch_assoc($result_product1))
     {
         echo '
            <li>
                <a href="shop-details.php?pid='.$row_product1['product_id'].'">
                    <img src="images/products/'.$row_product1['product_image'].'" alt="trumpet" title="trumpet">
                </a>
            </li>';
 
     }
 }
 
 ?>
                        
                    </ul>
                </div>

                <div class="sidebar-contact-area">
                    <div class="contact-info">
                        <div class="contact-info-content">
                            <h2>
                                <a href="tel:+0881306298615">
                                    +91-9718417680
                                </a>
                                <span>OR</span>
                                <a href="mailto:E-Shop Baba@gmail.com">
                                    taptimusicals@gmail.com
                                </a>
                            </h2>
    
                            <ul class="social">
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-facebook'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-twitter'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-instagram'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-linkedin'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-pinterest-alt'></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" target="_blank">
                                        <i class='bx bxl-youtube'></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <span class="close-btn sidebar-modal-close-btn">
                    <i class="flaticon-cancel"></i>
                </span>
            </div>
        </div>
        <!-- End Sidebar Modal -->