<?php include('header.php'); ?>

        <!-- Start Page Banner -->
        <div class="page-banner-area item-bg4">
            <div class="d-table">
                <div class="d-table-cell">
                    <div class="container">
                        <div class="page-banner-content">
                            <h2>Contact</h2>
                            <ul>
                                <li>
                                    <a href="index.php">Home</a>
                                </li>
                                <li>Contact</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Banner -->

        <!-- Start Contact Info Area -->
        <section class="contact-info-area pt-100 pb-70">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bx-envelope'></i>
                            </div>

                            <h3>Email Here</h3>
                            <p><a href="mailto:taptimusicals@gmail.com">taptimusicals@gmail.com</a></p>
                            <!-- <p><a href="mailto:support@E-Shop Baba.com">support@E-Shop Baba.com</a></p> -->
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bx-map'></i>
                            </div>

                            <h3>Location Here</h3>
                            <p>333/334, 2nd floor L extension Mohan garden uttam nagar New Delhi -110059</p>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="contact-info-box">
                            <div class="icon">
                                <i class='bx bxs-phone-call'></i>
                            </div>

                            <h3>Call Here</h3>
                            <p><a href="tel:+91-9718417680">+91-9718417680</a></p>
                            <!-- <p><a href="tel:2414524526">+241 452 4526</a></p> -->
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- End Contact Info Area -->

        <!-- Start Map Area -->
        <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.248727165226!2d77.05063007248076!3d28.622306630795453!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d0526ee6eb389%3A0xe7dc5bf61b459659!2sMohan%20Garden%2C%20Nawada%2C%20Delhi%2C%20110059!5e0!3m2!1sen!2sin!4v1694500659228!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        <!-- End Map Area -->
        
        <!-- Start Contact Area -->
        <section class="contact-area ptb-100">
            <div class="container">
                <div class="section-title">
                    <h2>Ready To Get Started?</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua quis ipsum suspendisse</p>
                </div>

                <div class="contact-form">
                    <form id="contactForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>First Name*</label>
                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Last Name*</label>
                                    <input type="text" name="name" id="name" class="form-control" required data-error="Please enter your name">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Your Email*</label>
                                    <input type="email" name="email" id="email" class="form-control" required data-error="Please enter your email">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-6 col-md-6">
                                <div class="form-group">
                                    <label>Your Phone*</label>
                                    <input type="text" name="phone_number" id="phone_number" required data-error="Please enter your number" class="form-control">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Your Subject*</label>
                                    <input type="text" name="msg_subject" id="msg_subject" class="form-control" required data-error="Please enter your subject">
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <div class="form-group">
                                    <label>Your Message*</label>
                                    <textarea name="message" class="form-control" id="message" cols="30" rows="6" required data-error="Write your message"></textarea>
                                    <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="col-lg-12 col-md-12">
                                <button type="submit" class="default-btn">
                                    Send Message
                                </button>

                                <div id="msgSubmit" class="h3 text-center hidden"></div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <!-- End Contact Area -->

        <!-- Start Newsletter Area -->
        <div class="newsletter-area ptb-100">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="newsletter-content">
                            <h2>Subscribe To Our Newsletter</h2>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua quis ipsum suspendisse</p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <form class="newsletter-form">
                            <input type="email" class="input-newsletter" placeholder="Enter Email Address" name="EMAIL" required autocomplete="off">

                            <button type="submit">Subscribe Now</button>
                            
                            <div id="validator-newsletter" class="form-result"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Newsletter Area -->
        
<?php include('footer.php'); ?>
       