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
            <?php $url_str = esc_url(home_url('/'). 'products/'); ?>
            <div class="productsSort-body">
                <ul>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="category">
                            <a class="productsSort-body-link" href="javascript:formSort[0].submit()">カテゴリー順</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="cheap">
                            <a class="productsSort-body-link" href="javascript:formSort[1].submit()">安い順</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="expensive">
                            <a class="productsSort-body-link" href="javascript:formSort[2].submit()">高い順</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
        <div class="productsSort productsItem">
            <div class="productsSort-head">
                価格帯
            </div>
            <div class="productsSort-body">
                <ul>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="0_1000">
                            <a class="productsSort-body-link" href="javascript:formSort[3].submit()">〜1,000円</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="1000_1500">
                            <a class="productsSort-body-link" href="javascript:formSort[4].submit()">1,000円～1,500円</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="1500_2000">
                            <a class="productsSort-body-link" href="javascript:formSort[5].submit()">1,500円〜2,000円</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="2000_3000">
                            <a class="productsSort-body-link" href="javascript:formSort[6].submit()">2,000円〜3,000円</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="3000_4000">
                            <a class="productsSort-body-link" href="javascript:formSort[7].submit()">3,000円〜4,000円</a>
                        </form>
                    </li>
                    <li>
                        <form name="formSort" method="get"
                            action="<?php echo $url_str ?>">
                            <input type="hidden" name="sort" value="4000_100000">
                            <a class="productsSort-body-link" href="javascript:formSort[8].submit()">4,000円〜</a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</aside>