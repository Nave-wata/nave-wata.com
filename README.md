# nave-wata.com

PHP Slim フレームワーク、Twig テンプレート、Docker を使用して構築された日本語のウェブサイトです。

A Japanese website built with PHP Slim Framework, Twig templating, and Docker.

## プロジェクト概要 (Project Overview)

このサイトは Slim PHP フレームワークと Twig テンプレートエンジンを使用して構築されています。Docker コンテナ化されており、開発環境の構築が容易です。

## 開発環境のセットアップ (Development Environment Setup)

### 前提条件 (Prerequisites)

- Docker
- Docker Compose

### 環境仕様 (Environment Specifications)

- Rocky Linux 8（ロッキー・リナックス 8）
- PHP 8.2 with Apache（PHP 8.2 と Apache）
- Composer 2.8.9（コンポーザー 2.8.9）
- Slim Framework 4.x（スリム・フレームワーク 4.x）
- Twig Template Engine 3.x（Twig テンプレートエンジン 3.x）
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
    - Nave-wata のホームページが表示されます

### プロジェクト構造 (Project Structure)

プロジェクトはクリーンアーキテクチャに基づいた構造になっています。詳細な構造については [プロジェクト構造](docs/project_structure.md) を参照してください。

## 設定ファイル (Configuration Files)

プロジェクトで使用されている設定ファイルについては [設定ファイル](docs/configuration.md) を参照してください。

## コマンド (Commands)

プロジェクトで使用できるコマンドについては [コマンド](docs/commands.md) を参照してください。

## 開発ワークフロー (Development Workflow)

プロジェクトの開発ワークフローについては [貢献ワークフロー](docs/contribution_workflow.md) を参照してください。

## テンプレートシステム (Template System)

プロジェクトで使用されているテンプレートシステムについては [テンプレートシステム](docs/template_system.md) を参照してください。

## セキュリティ (Security)

プロジェクトで実装されているセキュリティ対策については [セキュリティ](docs/security.md) を参照してください。

## ドキュメント (Documentation)

プロジェクトに関する詳細なドキュメントは `docs` ディレクトリにあります:

- [プロジェクト構造](docs/project_structure.md): プロジェクトのディレクトリ構造と各コンポーネントの役割
- [クリーンアーキテクチャ](docs/clean_architecture.md): クリーンアーキテクチャの概要と実装方法
- [設定ファイル](docs/configuration.md): プロジェクトで使用されている設定ファイルの説明
- [コマンド](docs/commands.md): プロジェクトで使用できるコマンドの一覧と使用方法
- [テンプレートシステム](docs/template_system.md): Twigテンプレートエンジンの使用方法
- [セキュリティ](docs/security.md): プロジェクトで実装されているセキュリティ対策
- [開発ガイドライン](docs/development_guidelines.md): コーディング規約、アーキテクチャガイドライン、テスト方法
- [貢献ワークフロー](docs/contribution_workflow.md): プロジェクトへの貢献方法と変更を行うためのワークフロー

これらのドキュメントは、プロジェクトの開発と保守を支援するために作成されています。新しい開発者がプロジェクトに参加する際や、既存の開発者が作業を行う際に参照してください。
