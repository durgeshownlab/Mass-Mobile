<?php 

include('header.php'); 

if(!isset($_GET['cat_id']))
{
    exit;
}

$cat_id=$_GET['cat_id'];

?>

        <!-- Start Page Banner -->
        <div class="page-banner-area">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Sub Categories</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Sub Categories</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->
<?php

$sql="select * from sub_category where category_id={$cat_id} and is_deleted=0";
$result=mysqli_query($con, $sql);

?>
        <!-- Start Top Products Area -->
        <section class="top-products-area pt-100 pb-100">
            <div class="container">
                <div class="E-Shop Baba-grid-sorting row align-items-center">
                    <div class="col-lg-6 col-md-6 result-count pb-50">
                        <p>We found <span class="count"><?= mysqli_num_rows($result) ?></span> Sub Categories available for you</p>
                    </div>
                </div>
                
                <div class="row">

                <?php

                    
                    
                    if(mysqli_num_rows($result)>0)
                    {
                        while($row=mysqli_fetch_assoc($result))
                        {
                            echo '
                            <div class="col-lg-3 col-md-6">
                                <div class="top-products-item">
                                    <div class="products-image">
                                        <a href="all-products.php?sub_cat_id='.$row['sub_category_id'].'"><img src="images/sub-category/'.$row['sub_category_image'].'" alt="image"></a>
                                    </div>
                                    <div class="products-content">
                                        <h3>
                                            <a href="all-products.php?sub_cat_id='.$row['sub_category_id'].'">'.$row['name'].'</a>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            ';
                        }
                    }
                    else
                    {
                        echo 'Sub Category Not Found!';
                    }

                ?>


                </div>
            </div>
        </section>
        <!-- End Top Products Area -->
        
        <?php include('footer.php'); ?>
