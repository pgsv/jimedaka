<!DOCTYPE html>
<html lang="ja">

<head>
    <title>じめだか</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.svg'); ?>" type="image/svg+xml">
    <link rel="stylesheet" href="<?php echo esc_url(get_stylesheet_uri() . '?' . filemtime(get_stylesheet_directory() . '/style.css')); ?>">
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Klee+One:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri() . '/assets/slick/slick.css'); ?>" media="screen" />
    <link rel="stylesheet" type="text/css" href="<?php echo esc_url(get_template_directory_uri() . '/assets/slick/slick-theme.css'); ?>" media="screen" />
    <script src="<?php echo esc_url(get_template_directory_uri() . "/assets/slick/slick.min.js"); ?>">
    </script>
    <?php wp_head(); ?>

</head>

<body>
    <?php include("template-parts/header.php");
