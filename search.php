<?php get_header(); ?>
<div class="searchResult">
    <?php if (have_posts() && get_post_type() === 'product'): ?>
    <?php
    if (isset($_GET['s']) && empty($_GET['s'])) {
        echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
    } else {
        echo '“'.$_GET['s'] .'”の検索結果：'.$wp_query->found_posts .'件'; // 検索キーワードと該当件数を表示
    }
    ?>
    <main class="products-list">
        <ul class="clearfix">
            <?php while (have_posts()): the_post(); ?>
            <li class="sm-col sm-col-6 md-col-3 lg-col-3 pr2 pb2">
                <?php the_product_link_html(get_the_ID());?>
            </li>
            <?php endwhile; ?>
        </ul>
    </main>
    <?php else: ?>
    <div class="">検索キーワードにマッチする商品はありませんでした</div>
    <?php endif; ?>
</div>
<?php get_footer();
