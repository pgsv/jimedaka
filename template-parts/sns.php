<?php
$url_encode=urlencode(get_permalink());
$title_encode=urlencode(get_the_title()).'｜'.get_bloginfo('name');
?>

<div>
    <!-- instagram -->
    <a class="share-link" href="https://www.instagram.com/jimedaka" target="_blank" rel="noopener noreferrer">
        <div><img src='<?php echo get_template_directory_uri(); ?>/assets/img/instagram.svg' alt='instagram-icon'></div>
        <div class="share-label">Instagram</div>
    </a>
</div>