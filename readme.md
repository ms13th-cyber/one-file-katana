# One File Katana

A lightweight, single-file WordPress plugin designed to strip away unnecessary code and bolster your site's stealth security with a single "slash."

---

## Key Features

- **Extreme Bloat Removal**: Eliminates heavy WP-native scripts including Emojis, DNS prefetch, and oEmbed discovery links to speed up page rendering.[cite: 1]
- **Stealth Security**: Strips out version queries (e.g., `?ver=x.x`) from JS/CSS and hides the `wp_generator` tag to obscure your WordPress version from attackers.[cite: 1]
- **API Defense**: Disables sensitive REST API user endpoints to prevent login ID enumeration.[cite: 1]
- **Entry Point Hardening**: Fully disables XML-RPC and removes Pingback headers to mitigate DDoS and brute-force attack risks.[cite: 1]
- **Ambiguous Login Errors**: Overwrites specific login error hints with generic messages to prevent account existence confirmation.[cite: 1]
- **Performance Focused**: A single-file architecture with zero database overhead, perfect for memory-sensitive environments.[cite: 1]

## Installation

1. Upload the `one-file-katana` folder (containing `one-file-katana.php`) to your `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. The plugin starts working immediately—no configuration screens required.
4. *Tip: Check your site's source code to see the cleaner, version-free `<head>` section.*

---

## 主な機能（日本語）

WordPressの不要な出力を「一振り」で削ぎ落とし、サイトの気配を消してセキュリティを向上させる、単一ファイル構成の超軽量プラグインです。

- **徹底的な軽量化**: 絵文字、DNSプリフェッチ、oEmbed（外部埋め込み）関連のスクリプトを完全に排除し、レンダリング速度を向上させます。[cite: 1]
- **ステルス性能**: JSやCSSの末尾からバージョン情報（`?ver=`）を消去し、外部からWordPressのバージョンを特定されるのを防ぎます。[cite: 1]
- **ユーザー露出防止**: REST API経由のユーザー情報取得を制限し、ログインIDが特定されるリスクを低減します。[cite: 1]
- **攻撃窓口の閉鎖**: 悪用されやすいXML-RPCを無効化し、HTTPヘッダーからPingback情報を削除して防御力を高めます。[cite: 1]
- **ログインヒントの秘匿**: ログイン失敗時のメッセージを汎用的なものに変更し、アカウントの存在を推測させません。[cite: 1]
- **パフォーマンス最適化**: 設定画面すら持たない単一PHPファイル構成。サーバーリソースを一切浪費せず、共有サーバー環境でも軽快に動作します。[cite: 1]

## インストール

1. `one-file-katana` フォルダを `/wp-content/plugins/` にアップロードします。
2. 管理画面の「プラグイン」から有効化してください。
3. 有効化した瞬間から、自動的にすべての最適化と隠蔽が適用されます。設定画面はありません。
    - ※ソースコードを表示して、`<head>` 内がスッキリしていることを確認してください。

## 開発者情報
- **Author**: masato shibuya (Image-box Co., Ltd.)[cite: 1]
- **Version**: 1.0.0[cite: 1]
- **Update**: [https://github.com/ms13th-cyber/one-file-katana/](https://github.com/ms13th-cyber/one-file-katana/)[cite: 1]