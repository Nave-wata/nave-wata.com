# nave-wata.com

A Japanese website built with PHP Slim Framework, Twig templating, and Docker.

## プロジェクト概要 (Project Overview)

このサイトは Slim PHP フレームワークと Twig テンプレートエンジンを使用して構築されています。Docker コンテナ化されており、開発環境の構築が容易です。

## 開発環境のセットアップ (Development Environment Setup)

### 前提条件 (Prerequisites)

- Docker
- Docker Compose

### 環境仕様 (Environment Specifications)

- Rocky Linux 8
- PHP 8.2 with Apache
- Composer 2.8.9
- Slim Framework 4.x
- Twig Template Engine 3.x
- 必要な PHP 拡張機能がすべてインストール済み

### 始め方 (Getting Started)

1. リポジトリをクローンします:
   ```
   git clone https://github.com/your-username/nave-wata.com.git
   cd nave-wata.com
   ```

2. 開発環境を起動します:
   ```
   docker-compose up -d
   ```

3. 依存関係をインストールします (初回のみ):
   ```
   docker-compose exec php composer install
   ```

4. アプリケーションにアクセスします:
   - ブラウザで http://localhost:8080 にアクセスします
   - Nave-Wata のホームページが表示されます

### プロジェクト構造 (Project Structure)

```
nave-wata.com/
├── composer.json      # PHP 依存関係の定義
├── docker/            # Docker 設定ファイル
│   ├── apache/        # Apache 設定
│   └── php/           # PHP 設定と Dockerfile
├── docker-compose.yml # Docker Compose 設定
├── public/            # 公開ディレクトリ
│   ├── index.php      # フロントコントローラー
│   └── .htaccess      # Apache リライトルール
├── templates/         # Twig テンプレート
│   ├── layouts/       # レイアウトテンプレート
│   └── *.twig         # ページテンプレート
└── vendor/            # Composer 依存関係 (gitignore)
```

## 設定ファイル (Configuration Files)

プロジェクトは `docker` ディレクトリに保存されている設定ファイルを使用しています:

### Apache 設定:
- `docker/apache/httpd.conf`: メイン Apache 設定ファイル
- `docker/apache/php.conf`: Apache 用 PHP モジュール設定
- `docker/apache/ssl.conf`: SSL 設定 (ローカル開発では使用しない)
- `docker/apache/disable-php-fpm.conf`: PHP-FPM を無効化する設定
- `docker/apache/mpm_prefork.conf`: MPM Prefork 設定
- `docker/apache/load-php-module.conf`: PHP モジュールの読み込み設定

### PHP 設定:
- `docker/php/php.ini`: PHP 設定ファイル
- `docker/php/Dockerfile`: PHP コンテナのビルド設定

これらのファイルはコンテナ内にボリュームとしてマウントされるため、イメージを再ビルドすることなく変更が反映されます。

## コマンド (Commands)

- 開発環境を起動:
  ```
  docker-compose up
  ```

- バックグラウンドで起動:
  ```
  docker-compose up -d
  ```

- 開発環境を停止:
  ```
  docker-compose down
  ```

- Docker イメージを再ビルド:
  ```
  docker-compose build
  ```

- PHP コンテナのシェルにアクセス:
  ```
  docker-compose exec php bash
  ```

- Composer コマンドを実行:
  ```
  docker-compose exec php composer [command]
  ```

## 開発ワークフロー (Development Workflow)

1. ローカルでコードを変更します
2. 変更はリアルタイムでコンテナに反映されます
3. ブラウザで http://localhost:8080 にアクセスして変更を確認します
4. 新しい依存関係を追加する場合は、`docker-compose exec php composer require [package]` を実行します

## テンプレートシステム (Template System)

このプロジェクトは Twig テンプレートエンジンを使用しています。テンプレートは `templates` ディレクトリにあります:

- `templates/layouts/layout.twig`: ベースレイアウトテンプレート
- `templates/top.twig`: ホームページテンプレート

## セキュリティ (Security)

- `.htaccess` ファイルへのアクセスは拒否されます
- `index.php` 以外の PHP ファイルへの直接アクセスは拒否されます
- ディレクトリインデックスは無効化されています
