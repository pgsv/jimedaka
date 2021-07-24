<?php get_header(); ?>

<div>
    <?php if (have_posts()): ?>
    <?php
    if (isset($_GET['s']) && empty($_GET['s'])) {
        echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
    } else {
        printf(esc_attr__('Search Results for: %s', 'storefront'), '<span>' . get_search_query() . '</span>');
    }
    ?>
    <ul>
        <?php while (have_posts()): the_post(); ?>
        <li>
            <a href="<?php the_permalink(); ?>"><?php echo get_the_title(); ?></a>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php else: ?>
    検索されたキーワードにマッチする記事はありませんでした
    <?php endif; ?>
</div>
<?php get_footer();
