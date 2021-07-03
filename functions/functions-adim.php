<?php
echo "---------------------------------- functions_admin";
/**
 * 投稿ラベルを「お知らせ」に変更
 */
function post_has_archive($args, $post_type)
{
    if ('post' == $post_type) {
        $args['rewrite'] = true;
        $args['has_archive'] = 'news';
        $args['label'] = 'お知らせ';
    }
    return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);

/**
 * カスタムフィールドを取得
 */
function get_custom_field($field_name, $page_slug)
{
    $page = get_page_by_path($page_slug);
    $id = $page->ID;
    return get_field_object($field_name, $id);
}
