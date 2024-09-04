<section class="Home-Screen-Bg MainSection-TopSpacing">
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 Div-Order-md-2">
                <div class="account-login">
                    <h1><?php echo trans('share_your_address_details_in_a_second'); ?></h1>
                    <h2><?php echo trans('login_account'); ?></h2>
                    <form action="<?php echo base_url('user/login'); ?>" method="POST" class="ajax_form mb-4"
                          onsubmit="return false;">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="<?php echo trans('email_address'); ?> *"
                                   aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="<?php echo trans('password'); ?> *">
                            <div class="text-end mt-1"><a href="javascript:void(0)" class="forget-password" data-bs-toggle="modal" data-bs-target="#ForgetPasswordModal"><?php echo trans('forget_password'); ?></a></div>
                        </div>
                        <button type="submit" class="btn btn-primary signin-button"><?php echo trans('sign_in'); ?></button>
                    </form>
                    <?php
                    $social_logins = social_logins();
                    if ($social_logins) { ?>
                        <h2><?php echo trans('or_sign_in_with'); ?></h2>
                        <ul class="SignIn-With-buttons SignIn-With-buttons-Mobile">
                            <?php foreach ($social_logins as $social_login) { ?>
                                <li>
                                    <a href="<?php echo base_url('social_auth?provider=' . $social_login); ?>">
                                        <img src="<?php echo base_url('assets/frontend/images/' . strtolower($social_login) . '.svg'); ?>"
                                             alt=""> <?php echo $social_login; ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <!--<li><a href="#"><img src="<?php /*echo base_url('assets/frontend/images/apple.png'); */?>"
                                                 alt=""> Apple</a></li>-->
                        </ul>
                    <?php } ?>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                <div id="myCarousel" class="carousel slide pinsaa-slider" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1"
                                aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2"
                                aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="img-fluid" src="<?php echo base_url('assets/frontend/images/slide1.png'); ?>"
                                 alt="">
                            <div class="container">
                                <div class="carousel-caption">
                                    <p style="font-size: 16px;"><?php echo trans('slide_text_1'); ?></p>
                                    <!--<p><?php /*echo trans('slide_text_1'); */?></p>-->
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="<?php echo base_url('assets/frontend/images/slide1.png'); ?>"
                                 alt="">
                            <div class="container">
                                <div class="carousel-caption">
                                    <p style="font-size: 16px;"><?php echo trans('slide_text_2'); ?></p>
                                    <!--<p><?php /*echo trans('slide_text_2'); */?></p>-->
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img class="img-fluid" src="<?php echo base_url('assets/frontend/images/slide1.png'); ?>"
                                 alt="">
                            <div class="container">
                                <div class="carousel-caption">
                                    <p style="font-size: 16px;"><?php echo trans('slide_text_3'); ?></p>
                                    <!--<p><?php /*echo trans('slide_text_3'); */?></p>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
