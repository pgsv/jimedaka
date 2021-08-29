<?php
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

function add_user_script()
{
    wp_enqueue_script(
        'main-script', // スクリプトを登録、削除するための名前を設定する
        get_template_directory_uri().'/assets/js/main.js', // jsファイルの場所を指定する
        ['jquery'] // jQueryなどのスクリプト名を指定する
    );
    wp_enqueue_script(
        'header-script', // スクリプトを登録、削除するための名前を設定する
        get_template_directory_uri().'/assets/js/header.js', // jsファイルの場所を指定する
        ['jquery'] // jQueryなどのスクリプト名を指定する
    );
    wp_enqueue_script(
        'aside-script', // スクリプトを登録、削除するための名前を設定する
        get_template_directory_uri().'/assets/js/aside.js', // jsファイルの場所を指定する
        ['jquery'] // jQueryなどのスクリプト名を指定する
    );
}
add_action('wp_enqueue_scripts', 'add_user_script');


/*
* 商品詳細のスラッグをIDで採番
*/
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
    if ($post_type == 'product') {
        $slug = $post_ID;
    }
    return $slug;
}
  add_filter('wp_unique_post_slug', 'custom_auto_post_slug', 10, 4);

/**
 * 通知メッセージを管理者のみに表示
 */
function update_message_admin_only()
{
    if (!current_user_can('level_10')) {
        add_filter('pre_site_transient_update_core', '__return_zero');
        remove_action('wp_version_check', 'wp_version_check');
        remove_action('admin_init', '_maybe_update_core');
    }
}
add_action('admin_init', 'update_message_admin_only');
