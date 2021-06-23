<!DOCTYPE html>
<html lang="ja">

<head>
    <title>MEDAKA</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet"
        href="<?php echo get_template_directory_uri(); ?>/style.css">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <?php wp_head(); ?>
    <script>
        jQuery(function() {
            jQuery('a[href^="#"]').click(function() {
                var headerHeight = 30;
                var speed = 800;
                var href = jQuery(this).attr("href");
                var target = jQuery(href == "#" || href == "" ? 'html' : href);
                var position = target.offset().top - headerHeight;
                jQuery('body,html').animate({
                    scrollTop: position
                }, speed, 'swing');
                return false;
            });
        });
    </script>
</head>

<body>
    <?php include("template-parts/header.php");
