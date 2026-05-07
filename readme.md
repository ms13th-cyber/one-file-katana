# One File Katana

A lightweight, single-file WordPress plugin designed to strip away unnecessary code and bolster your site's stealth security with a single "slash."

---

## Key Features

- **Extreme Bloat Removal (Stage 1)**: Eliminates heavy WP-native scripts including Emojis, oEmbed links, and newly targets Gutenberg-specific bloat (Global Styles CSS and SVG filters) to maximize page rendering speed.
- **Stealth Security (Stage 2)**: Strips out version queries from JS/CSS and hides the `wp_generator` tag. Now fully disables Author archives to prevent user enumeration through URL manipulation.
- **API Defense**: Disables REST API user endpoints and Application Passwords to close modern unauthorized access routes.
- **Entry Point Hardening**: Fully disables XML-RPC and removes Pingback headers to mitigate DDoS risks.
- **Resource Optimization (Stage 3)**: Disables the Heartbeat API in the admin dashboard to reduce server CPU load during editing.
- **True Single-File Architecture**: Now includes a built-in update checker within the single `.php` file, eliminating external library dependencies while supporting GitHub-based updates.

## Installation

1. Upload the `one-file-katana.php` file directly to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The plugin starts working immediately—no configuration screens required.

---

## 主な機能（日本語）

WordPressの不要な出力を「一振り」で削ぎ落とし、サイトの気配を消してセキュリティを向上させる、単一ファイル構成の超軽量プラグインです。

- **徹底的な軽量化 (Stage 1)**: 絵文字やoEmbedに加え、Gutenberg固有の不要なインラインCSS（Global Styles）やSVGフィルタを排除。現代のWP環境に最適化されたレンダリング速度を提供します。
- **ステルス性能 (Stage 2)**: JS/CSSのバージョン情報除去に加え、投稿者（Author）アーカイブを完全に無効化。URLからのユーザー名特定を徹底的に防ぎます。
- **API防御の強化**: REST APIの制限に加え、アプリケーションパスワード機能も無効化。現代的な攻撃経路を遮断します。
- **攻撃窓口の閉鎖**: XML-RPCの無効化とPingback情報の削除により、DDoSやブルートフォース攻撃のリスクを低減します。
- **サーバー負荷の低減 (Stage 3)**: 管理画面のHeartbeat APIを制御し、編集中のバックグラウンド通信によるサーバー負荷を抑制します。
- **究極の単一ファイル構成**: 外部ライブラリを一切使わず、独自のアップデート検知ロジックを統合。GitHub経由の更新通知を受け取りつつ、ファイル1つで完結する美学を追求しました。

## インストール

1. `one-file-katana.php` を `/wp-content/plugins/` にアップロードします。
2. 管理画面の「プラグイン」から有効化してください。
3. 有効化した瞬間から、自動的にすべての最適化と隠蔽が適用されます。設定画面はありません。

## 開発者情報
- **Author**: masato shibuya (Image-box Co., Ltd.)
- **Version**: 1.1.5
- **GitHub**: [https://github.com/ms13th-cyber/one-file-katana/](https://github.com/ms13th-cyber/one-file-katana/)