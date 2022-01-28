<?php get_header(); ?>
<!-- <div class="searchResult"> -->
    <div class="products">
    
        <?php include(dirname(__FILE__).'/template-parts/product_aside.php');?>
        <div class="products-wrapper">
            <main class="products-contents">
                <h1 class="products-title">
                    <?php
                    if (isset($_GET['s']) && empty($_GET['s'])) {
                        echo '検索キーワード未入力'; // 検索キーワードが未入力の場合のテキストを指定
                    } else {
                        // echo '“'.$_GET['s'] .'”の検索結果：'.$wp_query->found_posts .'件'; // 検索キーワードと該当件数を表示
                        echo '“'.$_GET['s'] .'”の検索結果：'; // 検索キーワードと該当件数を表示
                    }
                    ?>
                </h1>
                <?php 
                if (have_posts() && get_post_type() === 'product'): 
                    ?>
                    <ul class="clearfix">
                        <?php 
                        while (have_posts()) { 
                            the_post(); 
                            $wc_product = wc_get_product(get_the_ID()); 
                            if ( $wc_product->is_in_stock() ){
                                the_product_link_html(get_the_ID());
                            }
                        }
                        ?>
                    </ul>
                    <?php 
                else: 
                    ?>
                    <div class="">検索キーワードにマッチする商品はありませんでした。</div>
                    <?php 
                endif; 
            ?>
            </main>
        </div>
    </div>
<!-- </div> -->
<?php get_footer();
