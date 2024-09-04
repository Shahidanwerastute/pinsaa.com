<header class="position-absolute w-100">
    <div class="container">
        <div class="row d-flex align-items-center">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-3 col-sm-3 col-3">
                <div class="pinsaa-logo">
                    <a href="<?php echo base_url('address/manage'); ?>"><img src="<?php echo base_url('assets/frontend/images/logo.svg'); ?>" alt=""></a>
                </div>
            </div>
           
            <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-9 col-sm-9 col-9">
                <ul class="TopRightNav">
                    <li class="<?php echo ($this->session->userdata('user') ? 'social-signedin' : 'social-home'); ?>">
                        <a href="https://www.instagram.com/pinsaarabia" target="_blank"><img src="<?php echo base_url('assets/frontend/images/instagram.svg')?>" width="28px" height="28px"  alt="">
                            <span class="insta">Instagram<span> </a>
                    </li>
                    <?php if (!$this->session->userdata('user')) { ?>
                        <li><a href="javascript:void(0)" class="sign-up" data-bs-toggle="modal" data-bs-target="#signupModal"><?php echo trans('sign_up'); ?></a></li>
                    <?php } else { ?>
                        <li>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#UpdateProfileModal">
                                <img class="me-1 ar-reverse-img" src="<?php echo base_url('assets/frontend/images/profile-setting.svg')?>" alt="">
                                <span class="none-profile-setting"><?php echo trans('profile_settings'); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('user/logout'); ?>">
                                <img class="me-1 ar-reverse-img" src="<?php echo base_url('assets/frontend/images/signout.svg')?>" alt="">
                                <span class="none-signout"><?php echo trans('sign_out'); ?></span>
                            </a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo route(strtolower($this->router->fetch_class()) . '/change_language', [], ['locale' => ($locale == 'en' ? 'ar' : 'en'), 'uri_string' => uri_string()]); ?>">
                            <?php if ($locale == 'en') { ?>
                                <img src="<?php echo base_url('assets/frontend/images/ar.svg'); ?>" alt="">
                            <?php } else { ?>
                                EN
                            <?php } ?>
                        </a>
                    </li>
                </ul>
            </div>
            
        </div>
       <div class="row">
       <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <ul class="TopRightNav WelcomeMsg NavWelcomeMsg">
                    <?php if ($this->session->userdata('user')) { ?>
                        <li><?php echo trans('hi'); ?> <?php echo $this->session->userdata('user')->first_name ?: explode('@', $this->session->userdata('user')->email)[0]; ?>!</li>
                    <?php } ?>
                </ul>
            </div>
       </div>
    </div>
</header>