<?php
// $page = get_post(get_the_ID());
// get_template_part('pages/page', $page->post_name);
?>
<?php $slug = get_post(get_the_ID())->post_name;?>

<?php get_header(); ?>
<div class="<?php echo $slug;?>">
    <?php get_sidebar(); ?>
    <main class="<?php echo $slug;?>-wrapper">
        <?php get_breadcrumbs(); ?>
        <h1 class="<?php echo $slug;?>-title"><?php the_title(); ?>
        </h1>
        <div class="<?php echo $slug;?>-contents">
            <?php get_template_part('contents/content', $slug); ?>
            <?php if (have_posts()): while (have_posts()):the_post(); ?>
            <?php the_content(); ?>
            <?php endwhile;endif; ?>
        </div>
    </main>
</div>
<?php get_footer();
