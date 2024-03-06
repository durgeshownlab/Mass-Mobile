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

        <!-- Start Register Area -->
        <section class="register-area ptb-100">
            <div class="container">
                <div class="register-form">
                    <h2>Register</h2>
                   
                    <form id="sign-up-form">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" class="form-control" placeholder="Name" id="name" name="name">
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Email" id="email" name="email">
                        </div>

                        <div class="form-group">
                            <label>Contact</label>
                            <input type="tel" class="form-control" placeholder="Contact No." id="mobile" name="mobile" minlength="10" maxlength="10">
                        </div>

                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
                        </div>

                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="password" class="form-control" placeholder="Confirm Password" id="confirm-password" name="confirm-password">
                        </div>

                        
                        <button type="submit" class="default-btn" id="sign-up-btn" name="sign-up-btn">Register</button>
                    </form>
                    <div class="col-lg-12 col-md-12 col-sm-12 mt-5 text-right">
                        <a href="login.php" class="lost-your-password pt-2">Already have an account? <span style="color: #283796;">Log in</span></a>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Register Area -->
        
        <?php include('footer.php'); ?>
