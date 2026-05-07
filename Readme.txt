=== One File Katana ===
Contributors: masato shibuya(Image-box Co., Ltd.)
Tags: performance, security, stealth, optimization, speed
Requires at least: 5.0
Tested up to: 6.9.4
Requires PHP: 8.3.23
Stable tag: 1.1.3
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

WordPressの不要な出力を「一振り」で削ぎ落とし、サイトの気配を消してセキュリティを向上させる、単一ファイル構成の超軽量プラグインです。

== Description ==

One File Katana は、無駄を切り捨て、WordPressを研ぎ澄ますためのパフォーマンス・セキュリティ最適化ツールです。

多くの多機能プラグインとは異なり、設定画面すら持たない単一のPHPファイルで動作。サーバーリソースを一切浪費せず、共有サーバー環境でも最高のパフォーマンスを発揮します。

主な特徴：

* **徹底的な軽量化 (Stage 1)**: 絵文字、oEmbedに加え、Gutenberg固有の不要なインラインCSSやSVGフィルタを排除し、現代のWP環境に最適化されたレンダリング速度を提供します。
* **ステルス性能 (Stage 2)**: JS/CSS末尾のバージョン情報削除に加え、投稿者（Author）アーカイブを完全に無効化。URLからのユーザー名特定を徹底的に防ぎます。
* **API防御の強化**: REST APIの制限に加え、アプリケーションパスワード機能も無効化。現代的な攻撃経路を遮断します。
* **攻撃窓口の閉鎖**: XML-RPCを完全に無効化し、HTTPヘッダーからPingback情報を削除。不正アクセスやDDoSのリスクを低減します。
* **サーバー負荷の低減 (Stage 3)**: 管理画面のHeartbeat APIを制御し、編集中のバックグラウンド通信によるサーバー負荷を抑制します。
* **究極の単一ファイル構成**: 外部ライブラリを一切使わず、独自のアップデート検知ロジックを統合。GitHub経由の更新通知を受け取れるスタンドアロン構成です。

== Installation ==

1. プラグインファイルを配置します。
   `wp-content/plugins/one-file-katana.php`

2. WordPress管理画面の「プラグイン」から有効化します。

3. 設定は不要です。有効化した瞬間からすべての最適化が適用されます。

== Usage ==

このプラグインは「導入して有効化するだけ」で機能します。設定画面はありません。

* **動作確認**: サイトのソースコードを表示し、`<head>` セクションから不要なタグや `?ver=` クエリが消えていることを確認してください。
* **Authorアーカイブの停止**: セキュリティのため `/author/ユーザー名` のURLはトップページへリダイレクトされます。
* **oEmbedの停止**: セキュリティと軽量化のため外部埋め込み機能を停止しています。YouTube等の自動埋め込みが必要な場合はコードの調整を検討してください。

== Changelog ==

= 1.1.0 =
* Stage 1: Gutenberg由来のグローバルスタイルCSSおよびSVGフィルタの削除機能を追加。
* Stage 2: 投稿者（Author）アーカイブのリダイレクト機能を追加（ユーザー名漏洩防止）。
* Stage 2: アプリケーションパスワード機能の無効化を追加。
* Stage 3: Heartbeat APIの無効化（管理画面の動作軽量化）を追加。
* Update Check: GitHub APIを利用したスタンドアロンなアップデート検知機能を統合。
* 構成変更: ライブラリ依存を排除し、完全な単一PHPファイル構成へ移行。

= 1.0.0 =
* 初版リリース
* ステージ1：軽量化機能（Emoji, DNS Prefetch, oEmbed, Generatorの削除）の実装
* ステージ2：ステルス機能（クエリ文字列削除, REST API制限, XML-RPC停止, ログインエラー秘匿）の実装
* ステージ3：フッターリソース（wp-embed.min.js）のクリーンアップ実装

== License ==

This plugin is licensed under the GPLv2 or later.