<?php
/*
Plugin Name: One File Katana
Plugin URI: https://github.com/ms13th-cyber/one-file-katana
Description: 無駄を切り捨て、WordPressを研ぎ澄ます一振り。 / Slash the bloat. Purify your WordPress.
Version: 1.1.2
Tested up to: 6.9.4
Requires PHP: 8.3.23
Author: masato shibuya (Image-box Co., Ltd.)
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
	add_filter('emoji_svg_url', '__return_false');

	// WPバージョン情報 / RSD / wlwmanifest / Shortlink の削除
	remove_action('wp_head', 'wp_generator');
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	remove_action('wp_head', 'wp_shortlink_wp_head');

	// oEmbed 関連の削除
	remove_action('wp_head', 'wp_oembed_add_discovery_links');
	remove_action('wp_head', 'wp_oembed_add_host_js');

	// 最近のコメントのインラインスタイル削除
	add_filter('show_recent_comments_widget_style', '__return_false');
});

// Gutenberg由来の巨大なSVGフィルタやインラインCSSを抜く
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
add_action('wp_enqueue_scripts', function() {
	wp_dequeue_style('global-styles');
}, 100);

/**
 * Katana - Stage 2: Security & Stealth (情報の隠蔽と防御)
 */

// 1. JS/CSSのバージョンクエリ (?ver=x.x) を削除
function katana_remove_src_version($src) {
	return (strpos($src, 'ver=')) ? remove_query_arg('ver', $src) : $src;
}
add_filter('script_loader_src', 'katana_remove_src_version', 15);
add_filter('style_loader_src', 'katana_remove_src_version', 15);

// 2. REST API ユーザーエンドポイントを無効化 (ID漏洩防止)
add_filter('rest_endpoints', function($endpoints) {
	unset($endpoints['/wp/v2/users'], $endpoints['/wp/v2/users/(?P<id>[\d]+)']);
	return $endpoints;
});

// 3. XML-RPC 無効化 & HTTPヘッダーのPingback削除
add_filter('xmlrpc_enabled', '__return_false');
add_filter('wp_headers', function($headers) {
	unset($headers['X-Pingback']);
	return $headers;
});

// 4. ログインエラーメッセージを曖昧にする
add_filter('login_errors', function() {
	return 'ログイン情報に誤りがあります。正しく入力してください。';
});

// 5. Authorアーカイブを無効化 (ユーザー名推測防止)
add_action('template_redirect', function() {
	if (is_author()) {
		wp_safe_redirect(home_url(), 301);
		exit;
	}
});

// 6. アプリケーションパスワードの無効化
add_filter('wp_is_application_passwords_available', '__return_false');

/**
 * Katana - Stage 3: Performance & Footnote (研磨と仕上げ)
 */

// wp-embed.min.js の削除
add_action('wp_footer', function() {
	wp_deregister_script('wp-embed');
});

// Heartbeat API の無効化 (管理画面の軽量化)
add_action('init', function() {
	wp_deregister_script('heartbeat');
});

/**
 * Katana - Update Check & Auto-update Support
 */
add_action('init', function() {
    if (!is_admin()) return;

    $plugin_file = 'one-file-katana/one-file-katana.php';
    $repo = 'ms13th-cyber/one-file-katana';
    $current_version = '1.1.2';

    // 1. 更新検知 & パッケージURLの提供（これだけで自動更新スイッチが機能します）
    add_filter('pre_set_site_transient_update_plugins', function($transient) use ($repo, $current_version, $plugin_file) {
        if (empty($transient->checked)) return $transient;

        $remote = get_transient('katana_update_check');
        if (false === $remote) {
            $response = wp_remote_get("https://api.github.com/repos/{$repo}/releases/latest", [
                'headers' => ['User-Agent' => 'WordPress/' . get_bloginfo('version')]
            ]);

            if (is_wp_error($response) || wp_remote_retrieve_response_code($response) !== 200) return $transient;

            $remote = json_decode(wp_remote_retrieve_body($response));
            set_transient('katana_update_check', $remote, 12 * HOUR_IN_SECONDS);
        }

        if ($remote && version_compare($current_version, ltrim($remote->tag_name, 'v'), '<')) {
            $res = new stdClass();
            $res->slug = 'one-file-katana';
            $res->plugin = $plugin_file;
            $res->new_version = ltrim($remote->tag_name, 'v');
            $res->url = $remote->html_url;
            $res->package = $remote->zipball_url; // これが自動更新に必須
            $transient->response[$plugin_file] = $res;
        }
        return $transient;
    });

    // 2. 更新詳細情報の補完（ポップアップ表示用）
    add_filter('plugins_api', function($res, $action, $args) use ($repo) {
        if ($action !== 'plugin_information' || (isset($args->slug) && $args->slug !== 'one-file-katana')) return $res;

        $remote = get_transient('katana_update_check');
        if (!$remote) return $res;

        $res = new stdClass();
        $res->name = 'One File Katana';
        $res->slug = 'one-file-katana';
        $res->version = ltrim($remote->tag_name, 'v');
        $res->author = 'masato shibuya (Image-box Co., Ltd.)';
        $res->homepage = 'https://github.com/' . $repo;
        $res->download_link = $remote->zipball_url;
        $res->sections = [
            'description' => '無駄を切り捨て、WordPressを研ぎ澄ます一振り。',
            'changelog' => isset($remote->body) ? make_clickable(nl2br(esc_html($remote->body))) : '最新版にアップデートしてください。'
        ];
        return $res;
    }, 10, 3);

    // 3. Zip解凍時のディレクトリ名調整
    add_filter('upgrader_source_selection', function($source, $remote_source, $upgrader, $hook_extra) {
        if (strpos($source, 'one-file-katana') !== false) {
            $new_source = trailingslashit($remote_source) . 'one-file-katana/';
            if (rename($source, $new_source)) return $new_source;
        }
        return $source;
    }, 10, 4);
});