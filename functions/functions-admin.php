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
 * 管理画面のお知らせラベルを変更
 */
function change_admin_menu_label()
{
    global $menu;
    global $submenu;
    $name = 'お知らせ';
    $menu[5][0] = $name;
    $submenu['edit.php'][5][0] = $name.'一覧';
}
add_action('admin_menu', 'change_admin_menu_label');

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

/**
 * 404ページをホームにリダイレクト
 */
function is404_redirect_home()
{
    if (is_404()) {
        wp_safe_redirect(home_url('/'));
        exit();
    }
}
add_action('template_redirect', 'is404_redirect_home');

/*
* 商品詳細のスラッグをIDで採番
*/
function custom_auto_post_slug($slug, $post_ID, $post_status, $post_type)
{
    if ($post_type == 'product' || $post_type == 'post') {
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

/**
 * 特殊なURLをホーム画面にリダイレクトする
 * （補足）
 * ・is_author => ?author=ID からユーザー名が見れてしまう
 * ・is_shop => 既存のショップページに飛んでしまう
 */
function theme_slug_redirect_author_archive()
{
    if (is_author() || is_shop()) {
        wp_redirect(home_url());
        exit;
    }
}
add_action('template_redirect', 'theme_slug_redirect_author_archive');

/**
 * ホームのパーマリンクを取得
 */
function get_permalink_home()
{
    return '<a href="'.esc_url(home_url()).'">ホーム</a>';
}

/**
 * メダカ一覧のパーマリンクを取得
 */
function get_permalink_products()
{
    return '<a href="'.esc_url(home_url().'/products').'">メダカ一覧</a>';
}

/**
 * パンくずリストを表示
 */
function my_breadcrumbs()
{
    echo '<div id="breadcrumbs"><ul>';

    $sep = '>';
    $post_type = get_post_type(get_the_ID());
    // echo $post_type;

    switch ($post_type) {
        case 'page':
            $link_name = '<li>'.get_the_title().'</li>';
            break;

        case 'product':
            $link_name = '<li>'.get_permalink_products().'</li><li>'.get_the_title().'</li>';
            break;
        
        case 'post':
            $link_name = '';
            break;

        default:
            $link_name = '';
    }
    
    echo '<li>'.get_permalink_home().'</li>'.$link_name;
    echo '</ul></div>';
}
