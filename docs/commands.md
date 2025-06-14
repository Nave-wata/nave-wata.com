# コマンド (Commands)

このドキュメントでは、Nave-Wataプロジェクトで使用できる主要なコマンドについて説明します。

## Docker コマンド

### 開発環境の起動と停止

- 開発環境を起動:
  ```bash
  docker-compose up
  ```

- バックグラウンドで起動:
  ```bash
  docker-compose up -d
  ```

- 開発環境を停止:
  ```bash
  docker-compose down
  ```

### Docker イメージの管理

- Docker イメージを再ビルド:
  ```bash
  docker-compose build
  ```

- 特定のサービスのみ再ビルド:
  ```bash
  docker-compose build php
  ```

### コンテナ操作

- PHP コンテナのシェルにアクセス:
  ```bash
  docker-compose exec php bash
  ```

- コンテナのログを表示:
  ```bash
  docker-compose logs
  ```

- 特定のサービスのログをリアルタイムで表示:
  ```bash
  docker-compose logs -f php
  ```

## Composer コマンド

Composer コマンドは PHP コンテナ内で実行します。

- 依存関係のインストール:
  ```bash
  docker-compose exec php composer install
  ```

- 依存関係の更新:
  ```bash
  docker-compose exec php composer update
  ```

- 新しいパッケージの追加:
  ```bash
  docker-compose exec php composer require [package]
  ```

- 開発用パッケージの追加:
  ```bash
  docker-compose exec php composer require --dev [package]
  ```

- オートローダーの最適化:
  ```bash
  docker-compose exec php composer dump-autoload -o
  ```

## アプリケーション管理

- キャッシュのクリア:
  ```bash
  # Twigキャッシュのクリア
  rm -rf var/cache/twig/*
  ```

- 設定の更新後にアプリケーションを再起動:
  ```bash
  docker-compose restart
  ```

## 開発ワークフロー

1. ローカルでコードを変更します
2. 変更はリアルタイムでコンテナに反映されます
3. ブラウザで http://localhost:8080 にアクセスして変更を確認します
4. 新しい依存関係を追加する場合は、`docker-compose exec php composer require [package]` を実行します

## トラブルシューティング

- コンテナが起動しない場合:
  ```bash
  # ログを確認
  docker-compose logs
  
  # コンテナを再ビルド
  docker-compose down
  docker-compose build
  docker-compose up -d
  ```

- 依存関係の問題が発生した場合:
  ```bash
  # Composerキャッシュをクリア
  docker-compose exec php composer clear-cache
  
  # 依存関係を再インストール
  docker-compose exec php composer install
  ```

- パーミッションの問題が発生した場合:
  ```bash
  # ログディレクトリのパーミッションを修正
  chmod -R 777 var/log
  
  # キャッシュディレクトリのパーミッションを修正
  chmod -R 777 var/cache
  ```