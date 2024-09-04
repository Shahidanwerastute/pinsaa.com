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

    <script>
        var base_url = '<?php echo base_url(); ?>';
        var change_language_url = '<?php echo base_url(strtolower($this->router->fetch_class()) . '/change_language'); ?>';
        var locale = '<?php echo $locale; ?>';
        var user_has_address = '<?php echo user_has_address(); ?>';
        var map_lat = 21.4858;
        var map_long = 39.1925;
        var is_edit_address = false;
    </script>

    <style>
        .main-content-box {
            background-image: url('<?php echo base_url('assets/frontend/images/bg1-img.png'); ?>');
            background-position: left;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .shear_button li a {
            font-size: 15.5px !important;
            line-height: 19.19px !important;
            font-weight: 400 !important;
        }

        .inner_container {
            position: relative;
            border: 1px solid lightgray;
            border-radius: 20px;
            max-width: 780px;
            margin: 0 auto;
            background-color: #fff;
        }

        .client_heading {
            text-align: center;
            padding: 1.5rem 0;
            background: #293462;
            color: white;
            border-radius: 20px 20px 0px 0px;
            font-size: 20px !important;
            font-weight: 600;
        }

        .cilent_main {
            padding: 56px 47px 0px;
        }

        .client-row {
            margin-bottom: 57px;
            /*margin-right: 32px;*/
        }

        .information_wrap p {
            font-size: 12px;
            font-weight: 500px;
            color: #7c7c7c;
            line-height: 18px;
        }

        .information_wrap h5 {
            font-size: 16px;
            font-weight: 600;
            line-height: 24px;
            color: #293462;
        }

        .client_text {
            padding: 0px;
            max-width: 300px;
        }

        .client_text p {
            line-height: 18px !important;
            margin-bottom: 6px !important;
        }

        .client_text h5 {
            line-height: 18px !important;
            margin-bottom: 0px !important;
        }

        .information_wrap {
            border-bottom: 1px solid #F7D716;
            padding-bottom: 35px;
        }

        .buildimg_img_text {
        }

        .buildimg_img_text p {
            margin: 16px 0px 24px 0px !important;
            font-size: 12px;
            font-weight: 500px;
            color: #7c7c7c;
            line-height: 18px;
            /*padding:2rem 0;*/
        }

        .building_img {
            display: flex;
            justify-content: center;

        }

        .building_img img {
            max-width: 400px;
        }

        .new_shear_button {
            text-align: center;
            padding-top: 24px !important;
            padding-bottom: 28px !important;
        }

        .MainSection-BottomSpacing {
            margin-bottom: 46px;
        }

        .copywrite-text {
            color: #2B5597;
            padding-bottom: 53px;
            padding-top: 0px;

        }

        .map-text {
            text-decoration-line: underline;
        }

        /* @media (max-width: 991px) {
            .buildimg_img_text ul.SideMenu {
            display: inline;
        }
     } */

        .header_nav_container {
            display: flex;
        }

        ul.header_nav_container {
            padding: 0;
        }


        ul.header_nav_container li:last-child a:hover {
            background-color: transparent;
        }

        /*rtl css*/
        body.arb {
            direction: rtl;
        }

        body.arb .Page-Bg {
            background-image: url('<?php echo base_url('assets/frontend/images/other_pages1_bg.png'); ?>') !important;
            background-position: left !important;
            background-repeat: no-repeat;
            background-size: contain;
        }

        body.arb .main-content-box {
            background-image: url('<?php echo base_url('assets/frontend/images/bg-img.png'); ?>') !important;
            background-position: right !important;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .gmap_img {
            width: 4%;
        }

        @media (max-width: 991px) {
            .buildimg_img_text ul {
                justify-content: center !important;
            }
        }

        @media (max-width: 576px) {
            ul.header_nav_container li a {
                padding: 10px 10px;
            }

            .client-row {
                margin-bottom: 0px;
            }

            .client_text {
                margin-bottom: 20px;

            }
        }
    </style>

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

</head>
<body class="<?php echo($locale == 'en' ? '' : 'arb'); ?>">

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4JVXF2"
            height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="preloader">
    <h1>fgffff</h1>
    <!-- <div class="loader"></div> -->
    <svg class="pl" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="pl-grad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="orange"/>
                <stop offset="100%" stop-color="orange"/>
            </linearGradient>
        </defs>
        <circle class="pl__ring" r="56" cx="64" cy="64" fill="none" stroke="hsla(0,10%,10%,0.1)" stroke-width="16"
                stroke-linecap="round"/>
        <path
                class="pl__worm"
                d="M92,15.492S78.194,4.967,66.743,16.887c-17.231,17.938-28.26,96.974-28.26,96.974L119.85,59.892l-99-31.588,57.528,89.832L97.8,19.349,13.636,88.51l89.012,16.015S81.908,38.332,66.1,22.337C50.114,6.156,36,15.492,36,15.492a56,56,0,1,0,56,0Z"
                fill="none"
                stroke="url(#pl-grad)"
                stroke-width="16"
                stroke-linecap="round"
                stroke-linejoin="round"
                stroke-dasharray="44 1111"
                stroke-dashoffset="10"
        />
    </svg>
</div>

<div class="ajax_loader">
    <div class="loader"></div>
</div>
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
                    <li><a target="_blank"
                           href="https://api.whatsapp.com/send?text=<?php echo trans('appreciated') . urlencode("\n") . base_url(); ?>"
                           class="active"><?php echo trans('share_pinsaa_with_others'); ?></a></li>
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

<section class="MainSection-TopSpacing MainSection-BottomSpacing Page-Bg">
    <div class="main-content-box">
        <div class="class">
            <div class="container">
                <div class="inner_container">
                    <div class="main_page">
                        <div class="client_heading">
                            <h5><?php echo trans('client_address_information'); ?></h5>
                        </div>
                        <div class="cilent_main">
                            <div class="information_wrap">
                                <div class="client-row">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="client_text">
                                                <p><?php echo trans('address'); ?></p>
                                                <h5><?php echo $address->address; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="client-row">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="client_text">
                                                <p><?php echo trans('name'); ?></p>
                                                <h5><?php echo $address->name; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12">
                                            <div class="client_text">
                                                <p><?php echo trans('number'); ?></p>
                                                <h5><?php echo $address->phone; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="client-row">
                                    <div class="row">
                                        <div class="col-sm-6 col-12">
                                            <div class="client_text">
                                                <p><?php echo trans('location_map'); ?></p>
                                                <h5>
                                                    <img src="<?php echo base_url('assets/frontend/images/gmap_link_icon.png'); ?>" class="gmap_img" alt="">
                                                    <a href="http://www.google.com/maps/place/<?php echo $address->latitude; ?>,<?php echo $address->longitude; ?>"
                                                       target="_blank" class="pupup-map-link"
                                                       style="color: #1017d1;"><?php echo trans('click_here_to_view'); ?></a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->building_type) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('building_type'); ?></p>
                                                <h5><?php echo building_types($address->building_type); ?></h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->villa_number) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('villa_number'); ?></p>
                                                <h5><?php echo $address->villa_number ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="row">

                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->building_number) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('building_number'); ?></p>
                                                <h5><?php echo $address->building_number; ?></h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->office_number) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('office_number'); ?></p>
                                                <h5><?php echo $address->office_number; ?></h5>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->floor_number) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('floor_number'); ?></p>
                                                <h5><?php echo $address->floor_number; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="row">
                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->apartment_number) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('apartment_number'); ?></p>
                                                <h5><?php echo $address->apartment_number; ?></h5>
                                            </div>
                                        </div>

                                        <div class="col-sm-6 col-12"
                                             style="display: <?php echo !empty($address->other) ? 'block' : 'none'; ?>">
                                            <div class="client_text">
                                                <p><?php echo trans('other'); ?></p>
                                                <h5><?php echo $address->other; ?></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="">
                                        <div class="row">
                                            <div class="col-sm-6 col-12"
                                                 style="display: <?php echo !empty($address->note) ? 'block' : 'none'; ?>">
                                                <div class="client_text">
                                                    <p><?php echo trans('note'); ?></p>
                                                    <h5><?php echo $address->note; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="buildimg_img_text">
                                    <?php
                                    if ($address->villa_picture) { ?>
                                        <p><?php echo trans('villa_picture'); ?></p>
                                        <div class="building_img">
                                            <img src="<?php echo base_url($address->villa_picture); ?>" alt=""/>
                                        </div>
                                    <?php }
                                    if ($address->building_picture) { ?>
                                        <p><?php echo trans('building_pic'); ?></p>
                                        <div class="building_img">
                                            <img src="<?php echo base_url($address->building_picture); ?>" alt=""/>
                                        </div>
                                    <?php }
                                    if ($address->office_picture) { ?>
                                        <p><?php echo trans('office_picture'); ?></p>
                                        <div class="building_img">
                                            <img src="<?php echo base_url($address->office_picture); ?>" alt=""/>
                                        </div>
                                    <?php }
                                    if ($address->apartment_picture) { ?>
                                        <p><?php echo trans('apartment_pic'); ?></p>
                                        <div class="building_img">
                                            <img src="<?php echo base_url($address->apartment_picture); ?>" alt=""/>
                                        </div>

                                    <?php }
                                    ?>
                                    <ul class="SideMenu shear_button new_shear_button">
                                        <li><a target="_blank"
                                               href="https://api.whatsapp.com/send?text=<?php echo trans('appreciated') . urlencode("\n") . base_url(); ?>"
                                               class="active"><?php echo trans('share_pinsaa_with_others'); ?></a></li>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
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

<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/popper.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/bootstrap-5.0.2/js/bootstrap.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/frontend/plugins/toast-notify/jquery.toast.min.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.js"></script>
<script src="<?php echo base_url('assets/frontend/jquery/functions.js?v=' . v()); ?>"></script>

<script type="text/javascript"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDt0bOxp3E183vkWlHGZsA50Hhu6wF7jN8&callback=init_map&libraries=places,geocoder&region=SA&language=en"></script>
</body>
</html>
