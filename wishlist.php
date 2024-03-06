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
                            <h2>Wish List</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Wish-List</li>
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
// $sql="select * from wishlists where user_id={$_SESSION['user_id']} and is_deleted=0";
$sql="select * from wishlists where user_id={$_SESSION['user_id']} and is_deleted=0";
$result=mysqli_query($con, $sql);
if(mysqli_num_rows($result)>0)
{
    echo '
    
    <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Product</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Unit Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
    
    ';
    while($row=mysqli_fetch_assoc($result))
    {
        $sql_for_product="select * from products where product_id={$row['product_id']} and is_deleted=0";
        $result_for_product=mysqli_query($con, $sql_for_product);
        if(mysqli_num_rows($result_for_product)>0)
        {
            $row_for_product=mysqli_fetch_assoc($result_for_product);

            echo '
            <tr>
                <td class="product-thumbnail">
                    <a href="shop-details.php?pid='.$row_for_product['product_id'].'">
                        <img src="images/products/'.$row_for_product['product_image'].'" alt="item" width="130">
                    </a>
                </td>
                <td class="product-name">
                    <a href="shop-details.php?pid='.$row_for_product['product_id'].'">'.ucwords(strtolower($row_for_product['product_name'])).'</a>
                </td>
                <td class="product-price">
                    <span class="unit-amount">$'.number_format($row_for_product['product_price']).'</span>
                </td>
                <td class="product-subtotal">
                    <a href="#" class="wishlist-page-remove-wishlist-btn" data-product-id="'.$row_for_product['product_id'].'">
                        <i class="bx bx-trash"></i>
                    </a>
                </td>
            </tr>
            ';
        }
        
    }
}
else
{
    echo 'Wishlist is Empty';
}
?>
                                        <!-- <tr>
                                            <td class="product-thumbnail">
                                                <a href="#">
                                                    <img src="assets/img/recomn-by-baba/cucumber.jpg" alt="item" width="130">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="shop-details.html">Darling Oranges</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="unit-amount">$455.00</span>
                                            </td>
                                            <td class="product-subtotal">
                                                <a href="#" class="remove">
                                                    <i class='bx bx-trash'></i>
                                                </a>
                                            </td>
                                        </tr> -->
                                        
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
