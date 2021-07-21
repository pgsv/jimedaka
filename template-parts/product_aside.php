<?php clog('ok') ?>
<aside class="products-aside">
    <div class="products-aside-cart">
        <div class="productsCart productsItem">
            <div class="productsCart-head">
                買い物カゴ
            </div>
            <div class="productsCart-body">
                <div>※ 現在カート内に商品はございません。</div>
            </div>
            <a href="<?php echo home_url(); ?>/cart"
                class="productsCart-foot btn_stroke_beige">
                <img src='<?php echo get_template_directory_uri(); ?>/assets/img/cart_beige.svg'
                    alt='カート'>
                カートの詳細
            </a>
        </div>

        <a href="#" class="products-aside-all productsItem">
            全商品から探す
        </a>
        <a href="#" class="products-aside-recommend productsItem">
            おすすめ商品
        </a>
        <div class="productsSort productsItem">
            <div class="productsSort-head">
                並び替え
            </div>
            <div class="productsSort-body">
                <ul>
                    <li><a class="productsSort-body-link" href="#">カテゴリ順</a></li>
                    <li><a class="productsSort-body-link" href="#">人気順</a></li>
                    <li><a class="productsSort-body-link" href="#">安い順</a></li>
                    <li><a class="productsSort-body-link" href="#">高い順</a></li>
                    <li><a class="productsSort-body-link" href="#">飼育しやすい順</a></li>
                </ul>
            </div>
        </div>
        <div class="productsSort productsItem">
            <div class="productsSort-head">
                価格帯
            </div>
            <div class="productsSort-body">
                <ul>
                    <li><a class="productsSort-body-link" href="#">〜1,000円</a></li>
                    <li><a class="productsSort-body-link" href="#">1,000円～1,500円</a></li>
                    <li><a class="productsSort-body-link" href="#">1,500円〜2,000円</a></li>
                    <li><a class="productsSort-body-link" href="#">2,000円〜3,000円</a></li>
                    <li><a class="productsSort-body-link" href="#">3,000円〜4,000円</a></li>
                    <li><a class="productsSort-body-link" href="#">4,000円〜</a></li>
                </ul>
            </div>
        </div>
    </div>
</aside>