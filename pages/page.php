<?php $slug = get_post(get_the_ID())->post_name;?>

<?php get_header(); ?>
<div class="<?php echo $slug;?>">
    <main class="<?php echo $slug;?>-wrapper">
        <h1 class="<?php echo $slug;?>-title"><?php the_title(); ?>
        </h1>
        <?php if (have_posts()): while (have_posts()):the_post(); ?>
        <div class="<?php echo $slug;?>-contents">
            <?php the_content(); ?>
        </div>
        <?php endwhile;endif; ?>
    </main>
</div>
<?php get_footer();
