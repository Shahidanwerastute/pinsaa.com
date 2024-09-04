<?php
$locale = $this->session->userdata('locale');
?>
<!DOCTYPE html>
<html lang="<?php echo $locale; ?>" dir="<?php echo ($locale == 'en' ? 'ltr' : 'rtl'); ?>">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <title>PINSAA</title>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/frontend/bootstrap-5.0.2/css/bootstrap.min.css'); ?>"/>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/icofont/icofont.min.css'); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/fontawesome/css/all.css'); ?>"/>
    <link rel="stylesheet" type="text/css"
          href="<?php echo base_url('assets/frontend/plugins/toast-notify/jquery.toast.min.css'); ?>"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/styles.css?v=' . v()); ?>"/>
    <script src="<?php echo base_url('assets/frontend/jquery/jquery-3.6.0.min.js'); ?>"></script>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-250697129-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-250697129-1');
    </script>

    <!-- Google Tag Manager -->
    <script>
        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
        })(window,document,'script','dataLayer','GTM-M4JVXF2');
    </script>
    <!-- End Google Tag Manager -->

    <script>
        ga('send', {
            hitType: 'event',
            eventCategory: 'User',
            eventAction: 'Registered',
            eventLabel: 'User Registered'
        });
    </script>

    <style>
        .main_content {
            max-width: 780px;
            height: 492px;
            background: #FFFFFF;
            border: 1px solid #C9C9C9;
            border-radius: 20px;
            text-align: center;
            vertical-align: middle;
            margin: auto;
            padding-top: 72px;
            margin-bottom: 174px
        }
        .thank_you_heading {
            font-weight: 600;
            font-size: 20px;
            line-height: 24px;
            padding-top: 32px;
        }
        .thank_you_text {
            font-size: 14px;
            line-height: 21px;
            max-width: 450px;
            margin: auto;
        }
        .thank-you-page-bg {
            background-image: url(../assets/frontend/images/other_pages_bg.png), url(../assets/frontend/images/thanku_page_bg.png);
            background-position: right top, left bottom -329px;
            background-repeat: no-repeat;
            background-size: 37%;
        }
        .thank-you-page-main-section .MainSection-TopSpacing {
            min-height: unset;
        }
        .arb .thank-you-page-main-section .main_content img {
            -webkit-transform: scaleX(-1);
            transform: scaleX(-1);

        }
        @media screen and (max-width: 1024px) {
            .main_content {
                margin-bottom: 68px;
            }
        }
        @media screen and (max-width: 767px) {
            .main_content {
                background: unset;
                border: none;
                border-radius: unset;
            }
            .thank-you-page-bg {
            background-image: url(../assets/frontend/images/thanku_page_bg_mobile.png);
            background-position: center center;
            background-repeat: no-repeat;
            background-size: cover;
        }
        }
    </style>

</head>
<body class="<?php echo($locale == 'en' ? '' : 'arb'); ?>">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4JVXF2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<!-- ----------header---------- -->
<header class="position-absolute w-100">
    <div class="container">
        <div class="row d-flex align-items-center justify-content-between">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-2 col-sm-2 col-2">
                <div class="pinsaa-logo">
                    <a href="<?php echo base_url('address/manage'); ?>"><img
                                src="<?php echo base_url('assets/frontend/images/logo.svg'); ?>" alt=""/></a>
                </div>
            </div>

            <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-10 col-sm-10 col-10 d-flex align-items-center justify-content-end">
                <ul class="SideMenu shear_button header_nav_container">
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
    </div>
</header>
<!-- ----------header---------- -->

<!-- ----------main---------- -->
<div class="Page-Bg thank-you-page-bg thank-you-page-main-section">
    <section class="MainSection-TopSpacing MainSection-BottomSpacing ">
        <div class="main-content-box">
                <div class="container">
                    <div class="main_content">
                        <img src="<?php echo base_url('assets/frontend/images/thank-you-page.png'); ?>" alt="">  
                        <p class="thank_you_heading">Thank you for registering</p>
                        <?php if ($this->session->flashdata('is_manual_signup')) { ?>
                            <p class="thank_you_text"><?php echo trans('account_activation_email_sent'); ?></p>
                        <?php } else { ?>
                            <p class="thank_you_text"><?php echo trans('thank_you_for_sign_up'); ?></p>
                        <?php } ?>
                    </div>
                </div>
    </section>

    <!-- ----------main end---------- -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="Pinsaa-Credits copywrite-text"><?php echo trans('all_rights_reserved_by_pinsaa'); ?></div>
                </div>
            </div>
        </div>
    </footer>
</div>

<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/plugins/toast-notify/jquery.toast.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('assets/frontend/jquery/functions.js?v=' . v()); ?>"></script>

</body>
</html>
