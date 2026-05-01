<?php
/*
Plugin Name: One File Katana
Plugin URI: https://github.com/ms13th-cyber/one-file-katana
Description: 無駄を切り捨て、WordPressを研ぎ澄ます一振り。 / Slash the bloat. Purify your WordPress.
Version: 1.0.0
Tested up to: 6.9.4
Requires PHP: 8.3.23
Author: masato shibuya (Image-box Co., Ltd.)
Author URI: https://image-box.jp
License: GPL2
*/

if (!defined('ABSPATH')) exit;

/**
 * Katana - Stage 1: Lightweight (不要なタグ・リソースの削除)
 */
add_action('init', function() {
    // 絵文字関連の削除
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_styles', 'print_emoji_styles');
    remove_filter('the_content_feed', 'wp_staticize_emoji');
    remove_filter('comment_text_rss', 'wp_staticize_emoji');
    remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

    // DNS Prefetch 削除
    add_filter('emoji_svg_url', '__return_false');

    // WPバージョン情報の削除
    remove_action('wp_head', 'wp_generator');

    // RSD / wlwmanifest / Shortlink の削除
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // oEmbed 関連の削除 (外部埋め込み機能の停止)
    remove_action('wp_head', 'wp_oembed_add_discovery_links');
    remove_action('wp_head', 'wp_oembed_add_host_js');
});

/**
 * Katana - Stage 2: Security & Stealth (情報の隠蔽と防御)
 */

// 1. JS/CSSのバージョンクエリ (?ver=x.x) を削除して隠蔽
function katana_remove_src_version($src) {
    if (strpos($src, 'ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('script_loader_src', 'katana_remove_src_version', 15);
add_filter('style_loader_src', 'katana_remove_src_version', 15);

// 2. REST API ユーザーエンドポイントを無効化 (ID漏洩防止)
add_filter('rest_endpoints', function($endpoints) {
    if (isset($endpoints['/wp/v2/users'])) {
        unset($endpoints['/wp/v2/users']);
    }
    if (isset($endpoints['/wp/v2/users/(?P<id>[\d]+)'])) {
        unset($endpoints['/wp/v2/users/(?P<id>[\d]+)']);
    }
    return $endpoints;
});

// 3. XML-RPC 無効化 & HTTPヘッダーのPingback削除
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function($headers) {
    unset($headers['X-Pingback']);
    return $headers;
});

// 4. ログインエラーメッセージを曖昧にして推測を防ぐ
add_filter('login_errors', function() {
    return 'ログイン情報に誤りがあります。正しく入力してください。';
});

/**
 * Katana - Stage 3: Footnote (おまけ: フッターのwp-embed.min.js等を削除)
 */
add_action('wp_footer', function() {
    wp_deregister_script('wp-embed');
});


require_once __DIR__ . '/plugin-update-checker/plugin-update-checker.php';

$updateChecker = \YahnisElsts\PluginUpdateChecker\v5\PucFactory::buildUpdateChecker(
    'https://github.com/ms13th-cyber/one-file-katana/',
    __FILE__,
    'one-file-katana'
);

$updateChecker->setBranch('main');