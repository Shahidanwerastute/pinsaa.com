<!DOCTYPE html>
<html lang="<?php echo $locale; ?>" dir="<?php echo ($locale == 'en' ? 'ltr' : 'rtl'); ?>">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo trans('app_name'); ?></title>
    <?php if ($locale == 'ar') { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/bootstrap-5.0.2/css/bootstrap.rtl.min.css'); ?>">
    <?php } else { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/bootstrap-5.0.2/css/bootstrap.min.css'); ?>">
    <?php } ?>
    <link rel="stylesheet" href="<?php echo base_url('assets/frontend/icofont/icofont.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/fontawesome/css/all.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/plugins/toast-notify/jquery.toast.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.2/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/styles.css?v=' . v()); ?>">
    <?php if ($locale == 'ar') { ?>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/frontend/css/styles-rtl.css?v=' . v()); ?>">
    <?php } ?>
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
        body {
            counter-reset: ci_validation_error;
        }

        .ci_validation_error {
            position: relative;
            counter-increment: ci_validation_error;
            padding: 3px;
        }

        .ci_validation_error:before {
            content: counter(ci_validation_error) ". ";
        }

        .social-home {
            vertical-align: middle;
        }

        .social-signedin {
            vertical-align: text-bottom;
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
<body>

<!-- Google Tag Manager (noscript) -->
<noscript>
    <iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4JVXF2"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe>
</noscript>
<!-- End Google Tag Manager (noscript) -->

<div id="preloader">
    <!--<div class="loader"></div>-->
    <svg class="pl" viewBox="0 0 128 128" width="128px" height="128px" xmlns="http://www.w3.org/2000/svg">
        <defs>
            <linearGradient id="pl-grad" x1="0" y1="0" x2="0" y2="1">
                <stop offset="0%" stop-color="orange" />
                <stop offset="100%" stop-color="orange" />
            </linearGradient>
        </defs>
        <circle class="pl__ring" r="56" cx="64" cy="64" fill="none" stroke="hsla(0,10%,10%,0.1)" stroke-width="16" stroke-linecap="round" />
        <path class="pl__worm" d="M92,15.492S78.194,4.967,66.743,16.887c-17.231,17.938-28.26,96.974-28.26,96.974L119.85,59.892l-99-31.588,57.528,89.832L97.8,19.349,13.636,88.51l89.012,16.015S81.908,38.332,66.1,22.337C50.114,6.156,36,15.492,36,15.492a56,56,0,1,0,56,0Z" fill="none" stroke="url(#pl-grad)" stroke-width="16" stroke-linecap="round" stroke-linejoin="round" stroke-dasharray="44 1111" stroke-dashoffset="10" />
    </svg>
</div>
<div class="ajax_loader">
    <div class="loader"></div>
</div>