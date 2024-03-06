<?php 

include('header.php'); 

if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type']=='admin' && isset($_SESSION['email']))
{
    echo "<script>window.location.href = 'admin/main/index.php';  </script>";
}
else if(isset($_SESSION['user_id']) && isset($_SESSION['user_type']) && $_SESSION['user_type']=='customer' && isset($_SESSION['email']) )
{
    echo "<script>window.location.href = 'index.php';  </script>";
}
?>

        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Login</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Login</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Login Area -->
        <section class="login-area ptb-100">
            <div class="container">
                <div class="login-form">
                    <h2>Login</h2>

                    <form id="login-form">
                        <div class="form-group">
                            <label>Username or email</label>
                            <input type="Email" class="form-control" placeholder="Email" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        </div>

                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="checkme">
                                    <label class="form-check-label" for="checkme">Remember me</label>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password">
                                <a href="#" class="lost-your-password">Lost your password?</a>
                                <a href="register.php" class="lost-your-password pt-2">Don’t have an account? <span style="color: #283796;">Sign up</span></a>
                            </div>
                        </div>

                        <button type="submit" class="default-btn" id="login-btn" name="login-btn">Login</button>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Login Area -->
        
        <?php include('footer.php'); ?>
