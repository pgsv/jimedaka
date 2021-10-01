<aside class="products-aside">
    <!-- <div class="products-aside-cart">
        <div class="productsCart productsItem">
            <div class="productsCart-head">
                買い物カゴ
            </div>
            <div class="productsCart-body">
                <div>※ 現在お買い物カゴ内に商品はございません。</div>
            </div>
            <a href="<?php echo home_url(); ?>/cart"
    class="productsCart-foot btn_stroke_beige">
    <img src='<?php echo get_template_directory_uri(); ?>/assets/img/cart_beige.svg'
        alt='お買い物カゴ'>
    お買い物カゴの詳細
    </a>
    </div>
    </div> -->

    <a href="<?php echo esc_url(home_url().'/products'); ?>"
        class="products-aside-all productsItem">
        全商品から探す
    </a>
    <!-- <a href="#" class="products-aside-recommend productsItem">
            おすすめ商品
        </a> -->
    <?php
    $list1 = [
        ['category', 'カテゴリー順'],
        ['cheap', '安い順'],
        ['expensive', '高い順'],
    ];
    $list2 = [
        ['0_1000', '〜1,000円'],
        ['1000_1500','1,000円～1,500円'],
        ['1500_2000','1,500円～2,000円'],
        ['2000_3000','2,000円～3,000円'],
        ['3000_4000','3,000円～4,000円'],
        ['4000_100000','4,000円～'],
    ];
    $sort_list = [$list1, $list2];
?>
    <?php
        $url_str = esc_url(home_url('/'). 'products/');
        $form_cnt = 0;?>
    <?php for ($i=0; $i<2; $i++): ?>
    <div class="productsSort productsItem">
        <div class="productsSort-head">
            <?php
            if ($i==0) {
                echo '並び替え';
            } else {
                echo '価格帯';
            }
            ?>
        </div>
        <div class="productsSort-body">
            <ul>
                <?php foreach ($sort_list[$i] as $value) : ?>
                <li>
                    <form name="formSort" method="get"
                        action="<?php echo $url_str ?>">
                        <input type="hidden" name="sort"
                            value="<?php echo $value[0]; ?>">
                        <a id="<?php echo $value[0]; ?>"
                            class="productsSort-body-link"
                            href="javascript:formSort[<?php echo $form_cnt; ?>].submit()"><?php echo $value[1]; ?></a>
                    </form>
                </li>
                <?php $form_cnt++;?>
                <?php endforeach;?>
            </ul>
        </div>
    </div>
    <?php endfor;?>
</aside>

<button class="products-search">
    絞り込み
</button>