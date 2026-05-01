=== One File Katana ===
Contributors: masato shibuya(Image-box Co., Ltd.)
Tags: performance, security, stealth, optimization, speed
Requires at least: 5.0
Tested up to: 6.9.4
Requires PHP: 8.3.23
Stable tag: 1.0.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPressの不要な出力を「一振り」で削ぎ落とし、サイトの気配を消してセキュリティを向上させる、単一ファイル構成の超軽量プラグインです。[cite: 1]

== Description ==

One File Katana は、無駄を切り捨て、WordPressを研ぎ澄ますためのパフォーマンス・セキュリティ最適化ツールです。[cite: 1]

多くの多機能プラグインとは異なり、設定画面すら持たない単一のPHPファイルで動作。サーバーリソースを一切浪費せず、共有サーバー環境でも最高のパフォーマンスを発揮します。[cite: 1]

主な特徴：

* **徹底的な軽量化**: 絵文字、DNSプリフェッチ、oEmbed（外部埋め込み）関連のスクリプトを排除し、ページ読み込みを高速化します。[cite: 1]
* **ステルス性能**: JS/CSS末尾のバージョン情報（?ver=）や、wp_generatorタグを削除。外部からのバージョン特定を困難にします。[cite: 1]
* **API防御**: REST API経由のユーザー情報露出を制限し、ログインIDの推測攻撃を防ぎます。[cite: 1]
* **攻撃窓口の閉鎖**: XML-RPCを完全に無効化し、HTTPヘッダーからPingback情報を削除。不正アクセスやDDoSのリスクを低減します。[cite: 1]
* **ログインエラーの秘匿**: ログイン失敗メッセージを汎用的な表現に変更し、アカウント情報の漏洩を防ぎます。[cite: 1]
* **ゼロ・オーバーヘッド**: 単一ファイル構成でDBアクセスも最小限。[cite: 1]

== Installation ==

1. プラグインフォルダを配置します。[cite: 1]
   `wp-content/plugins/one-file-katana/`[cite: 1]

2. WordPress管理画面の「プラグイン」から有効化します。[cite: 1]

3. 設定は不要です。有効化した瞬間からすべての最適化が適用されます。[cite: 1]

== Usage ==

このプラグインは「導入して有効化するだけ」で機能します。設定画面はありません。[cite: 1]

* **動作確認**: サイトのソースコードを表示し、`<head>` セクションから不要なタグや `?ver=` クエリが消えていることを確認してください。[cite: 1]
* **oEmbedの停止**: セキュリティと軽量化のため外部埋め込み機能を停止しています。YouTube等の自動埋め込みが必要な場合はコードの調整を検討してください。[cite: 1]

== Changelog ==

= 1.0.0 =
* 初版リリース[cite: 1]
* ステージ1：軽量化機能（Emoji, DNS Prefetch, oEmbed, Generatorの削除）の実装[cite: 1]
* ステージ2：ステルス機能（クエリ文字列削除, REST API制限, XML-RPC停止, ログインエラー秘匿）の実装[cite: 1]
* ステージ3：フッターリソース（wp-embed.min.js）のクリーンアップ実装[cite: 1]

== License ==

This plugin is licensed under the GPLv2 or later.[cite: 1]