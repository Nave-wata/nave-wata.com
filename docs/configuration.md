# 設定ファイル (Configuration Files)

このドキュメントでは、Nave-Wataプロジェクトで使用されている設定ファイルについて説明します。

## Docker設定

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

## アプリケーション設定

アプリケーションの設定は `app` ディレクトリに保存されています:

### コンテナ設定:
- `app/container.php`: 依存性注入コンテナの設定

### ルート設定:
- `app/routes.php`: アプリケーションのルート定義

### アプリケーション設定:
- `app/settings.php`: アプリケーションの設定（Twigの設定、ログの設定など）

## 環境変数

環境変数は `.env` ファイルで管理されています。このファイルはバージョン管理されていないため、`.env.example` ファイルをコピーして作成する必要があります:

```bash
cp .env.example .env
```

主な環境変数:
- `APP_ENV`: アプリケーション環境（development, production）
- `APP_DEBUG`: デバッグモードの有効/無効
- `DB_HOST`: データベースホスト
- `DB_PORT`: データベースポート
- `DB_NAME`: データベース名
- `DB_USER`: データベースユーザー
- `DB_PASS`: データベースパスワード

## 設定の変更方法

### Docker設定の変更

Docker設定を変更する場合は、対応するファイルを編集し、Dockerコンテナを再起動します:

```bash
docker-compose down
docker-compose up -d
```

### アプリケーション設定の変更

アプリケーション設定を変更する場合は、対応するファイルを編集するだけで、変更が即座に反映されます（キャッシュが有効な場合を除く）。

### 環境変数の変更

環境変数を変更する場合は、`.env` ファイルを編集し、アプリケーションを再起動します:

```bash
docker-compose restart
```