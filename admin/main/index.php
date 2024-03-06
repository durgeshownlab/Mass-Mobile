<?php

include("header.php");

// for 1 months 
$sql_op="select * from orders where delivery_status='order placed' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_op=mysqli_query($conn, $sql_op);

$sql_oc="select * from orders where delivery_status='order confirmed' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_oc=mysqli_query($conn, $sql_oc);

$sql_s="select * from orders where delivery_status='shipped' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_s=mysqli_query($conn, $sql_s);

$sql_ofd="select * from orders where delivery_status='out for delivery' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_ofd=mysqli_query($conn, $sql_ofd);

$sql_d="select * from orders where delivery_status='delivered' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_d=mysqli_query($conn, $sql_d);

$sql_c="select * from orders where delivery_status='canceled' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH)";
$result_c=mysqli_query($conn, $sql_c);

// for 1 year 
$sql_opy="select * from orders where delivery_status='order placed' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_opy=mysqli_query($conn, $sql_opy);

$sql_ocy="select * from orders where delivery_status='order confirmed' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_ocy=mysqli_query($conn, $sql_ocy);

$sql_sy="select * from orders where delivery_status='shipped' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_sy=mysqli_query($conn, $sql_sy);

$sql_ofdy="select * from orders where delivery_status='out for delivery' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_ofdy=mysqli_query($conn, $sql_ofdy);

$sql_dy="select * from orders where delivery_status='delivered' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_dy=mysqli_query($conn, $sql_dy);

$sql_cy="select * from orders where delivery_status='canceled' and is_deleted=0 and order_date >= DATE_SUB(NOW(), INTERVAL 1 YEAR)";
$result_cy=mysqli_query($conn, $sql_cy);


?>


<!-- sidebar -->
<div class="nk-sidebar">
    <div class="nk-nav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label">Main</li>
            <li><a href="index.php"><i class=" mdi mdi-view-dashboard"></i> <span class="nav-text">Dashboard</span></a>
            </li>

            <li class="nav-label">Controls</li>
            
            <li>
                <a href="#" id="orders-tab"><i class="mdi mdi-cart"></i> <span class="nav-text">Orders</span></a>
            </li>

            <li>
                <a href="#" id="out-of-stock-tab"><i class="fa-solid fa-battery-empty"></i> <span class="nav-text">Out of Stock</span> <span class="badge badge-danger nav-badge out-of-stock-notification-count"></span></a>
            </li>
            
            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-clapperboard"></i> <span class="nav-text">Banner</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-banner-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-banner-tab" data-toggle="modal" data-target="#ModalCenter">Add Banner</a>
                    </li>
                    
                </ul>
            </li>

            

            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-product-hunt"></i> <span class="nav-text">Products</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-product-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-product-tab" data-toggle="modal" data-target="#ModalCenter">Add Product</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-folder-open"></i> <span class="nav-text">Category</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-category-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-category-tab" data-toggle="modal" data-target="#ModalCenter">Add Category</a>
                        
                    </li>
                    
                </ul>
            </li>

            <li>
                <a class="has-arrow" href="#" aria-expanded="false"><i class="fa fa-folder-tree"></i> <span class="nav-text">Sub Category</span> <span class="badge badge-danger nav-badge"></span></a>
                <ul aria-expanded="false">
                    <li>
                        <a href="#" id="view-sub-category-tab">View</a>
                    </li>
                    <li>
                        <a href="#" id="add-sub-category-tab" data-toggle="modal" data-target="#ModalCenter">Add Sub Category</a>
                    </li>
                </ul>
            </li>

        </ul>
    </div>
    <!-- #/ nk nav scroll -->
</div>
<!-- #/ sidebar -->
<!-- content body -->
<div class="content-body">
    <div class="fluid-container px-2 py-2">
        <div class="row page-titles">
            
            <div class="col p-0">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                    </li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="orders">
                    <div class="card-body">
                        <h4>Orders <span class="pull-right"><i class="ion-android-cart f-s-30 text-primary"></i></span></h4>
                        <h6 class="m-t-20 f-s-14 orders-count"></h6>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="products">
                    <div class="card-body">
                        <h4>Products <span class="pull-right"><i class="fa fa-product-hunt f-s-30 text-success"></i></span></h4>
                        <h6 class="m-t-20 f-s-14 products-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="category">
                    <div class="card-body">
                        <h4>Category <span class="pull-right"><i class="fa fa-folder f-s-30 text-dark"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 category-count"></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="sub-category">
                    <div class="card-body">
                        <h4>Sub Category <span class="pull-right"><i class="fa fa-folder-tree f-s-30 text-danger"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 sub-category-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="banners">
                    <div class="card-body">
                        <h4>Banners<span class="pull-right"><i class="fa-solid fa-clapperboard f-s-30 text-warning"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 banner-count"></h6>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card dashboard-card" data-label="out-of-stock">
                    <div class="card-body">
                        <h4>Out Of Stock<span class="pull-right"><i class="fa-solid fa-battery-empty f-s-30 text-warning"></i></span>
                        </h4>
                        <h6 class="m-t-20 f-s-14 out-of-stock-count"></h6>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <h4 class="card-title pl-3 pt-3">Last 1 Month</h4>
                    <?php 
                if(mysqli_num_rows($result_op)==0 && mysqli_num_rows($result_oc)==0 && mysqli_num_rows($result_s)==0 && mysqli_num_rows($result_ofd)==0 && mysqli_num_rows($result_d)==0 && mysqli_num_rows($result_c)==0)
                { 
                    echo '
                    <div class="card-body">
                    Data Doesn\'t Exist 
                    </div> ';
                }
                else
                {
                    echo '
                    <div class="card-body" id="delivery-pie-chart-for-1-month">
                        
                    </div>';
                }
            ?>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card">
                    <h4 class="card-title pl-3 pt-3">Last 1 Year</h4>
                    <?php 
                if(mysqli_num_rows($result_opy)==0 && mysqli_num_rows($result_ocy)==0 && mysqli_num_rows($result_sy)==0 && mysqli_num_rows($result_ofdy)==0 && mysqli_num_rows($result_dy)==0 && mysqli_num_rows($result_cy)==0)
                { 
                    echo '
                    <div class="card-body">
                        Data Doesn\'t Exist 
                    </div> ';
                }
                else
                {
                    echo '
                    <div class="card-body" id="delivery-pie-chart-for-1-year">
                        
                    </div>';
                }
            ?>
                    
                </div>
            </div>
            
        </div>
        
        
    </div>
    <!-- #/ container -->
</div>
<!-- #/ content body -->


<?php include("footer.php"); ?>