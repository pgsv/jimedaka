<?php
$slug = get_post(get_the_ID())->post_name;
if ($slug == 'products') {
    include(dirname(__FILE__).'/template-parts/product_aside.php');
}
