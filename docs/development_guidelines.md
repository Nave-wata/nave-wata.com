# 開発ガイドライン

このドキュメントでは、Nave-wataプロジェクトの開発ガイドラインとコーディング規約について説明します。

## 基本原則

1. **クリーンアーキテクチャの遵守**
   - 各層の責任を明確に分離し、依存関係の方向を内側に向けること
   - 外側の層は内側の層に依存できるが、内側の層は外側の層に依存してはならない

2. **シンプルな実装**
   - 必要以上に複雑な実装は避ける
   - 現時点では単純にビューを表示するだけの実装で十分な場合は、複雑なデータ取得ロジックは実装しない

3. **ドキュメント駆動開発**
   - コードを書く前に、その目的と設計を文書化する
   - PHPDocコメントを適切に記述する

## 開発ワークフローとツール

### Docker

- **起動:** `docker-compose up -d`
- **停止:** `docker-compose down`
- **コンテナへのアクセス:** `docker-compose exec <service_name> bash`

### Composer

- **依存関係のインストール:** `docker-compose exec app composer install`
- **新しい依存関係の追加:** `docker-compose exec app composer require <vendor>/<package>`
- **開発用の依存関係の追加:** `docker-compose exec app composer require --dev <vendor>/<package>`

### 静的解析

コード品質を維持するため、[PHPStan](https://phpstan.org/) を使用します。コミット前に必ず実行してください。

- **実行:** `docker-compose exec app vendor/bin/phpstan analyse`

### コードフォーマット

[PHP-CS-Fixer](https://cs.symfony.com/) を使用して、PSR-12コーディングスタイルを強制します。

- **実行:** `docker-compose exec app vendor/bin/php-cs-fixer fix`

## コーディング規約

### PHP

1. **PSR-1, PSR-12 の遵守**
   - [PSR-1: 基本コーディング規約](https://www.php-fig.org/psr/psr-1/)
   - [PSR-12: 拡張コーディングスタイルガイド](https://www.php-fig.org/psr/psr-12/)

2. **命名規則**
   - クラス名: PascalCase (例: `HomeController`)
   - メソッド名: camelCase (例: `getHomeData`)
   - 変数名: camelCase (例: `$userData`)
   - 定数: UPPER_CASE (例: `MAX_RETRY_COUNT`)

3. **PHPDocコメント**
   - すべてのクラス、メソッド、プロパティにPHPDocコメントを記述する
   - パラメータと戻り値の型を明示する
   - メソッドの目的と動作を簡潔に説明する

### Twig

1. **テンプレート構造**
   - 共通レイアウトを `layouts/` ディレクトリに配置する
   - ページ固有のテンプレートは `templates/` ディレクトリの直下に配置する

2. **命名規則**
   - テンプレートファイル名: snake_case (例: `user_profile.twig`)
   - ブロック名: snake_case (例: `{% block page_content %}`)
   - 変数名: snake_case (例: `{{ user_name }}`)

3. **ベストプラクティス**
   - ロジックはコントローラーに実装し、テンプレートにはできるだけロジックを含めない
   - 共通の要素は部分テンプレートとして抽出する
   - テンプレートの継承を活用する

## アーキテクチャガイドライン

### Domain層

- エンティティ、値オブジェクト、ドメインイベント、ビジネスロジックを含む
- 外部のフレームワークやライブラリに依存しない
- リポジトリのインターフェースを定義する
- **値オブジェクト例:** `Email` や `Money` など、不変で単純な値を持つオブジェクト

### Application層

- ユースケース（サービスクラス）を実装する
- Domain層のエンティティとリポジトリインターフェースを使用する
- DTO（Data Transfer Object）を使用して、レイヤー間のデータ転送を行う
- **DTO vs エンティティ:** DTOは単なるデータコンテナであり、振る舞いを持たない。エンティティはドメインの核となるビジネスロジックとデータを持つ。

### Interfaces層

- コントローラー、プレゼンター、コンソールコマンドを含む
- HTTPリクエストの処理とレスポンスの生成を担当する
- Application層のユースケースを使用する

### Infrastructure層

- 外部サービスとの連携を担当する
- Domain層で定義されたリポジトリインターフェースを実装する
- データベース、ファイルシステム、外部API（WordPress GraphQL）などへのアクセスを担当する

## テスト

### PHPUnit

テストフレームワークとして [PHPUnit](https://phpunit.de/) を使用します。

- **テストの実行:** `docker-compose exec app vendor/bin/phpunit`
- **カバレッジレポートの生成:** `docker-compose exec app vendor/bin/phpunit --coverage-html coverage`

### テストの構造

- **単体テスト:** `tests/Unit`
- **統合テスト:** `tests/Integration`
- **E2Eテスト:** `tests/E2E`

## セキュリティガイドライン

1. **入力検証**
   - [respect/validation](https://respect-validation.readthedocs.io/en/latest/) などのライブラリを使用して、すべてのユーザー入力を厳密に検証する

2. **XSS対策**
   - Twigの自動エスケープを常に有効にする。無効にする必要がある場合は、その理由を明確にコメントに残す

3. **機密情報の保護**
   - APIキーなどの機密情報は `.env` ファイルで管理し、バージョン管理に含めない (`.env.example` を使用)
   - [vlucas/phpdotenv](https://github.com/vlucas/phpdotenv) を使用して環境変数をロードする

4. **セキュアなHTTPヘッダー**
   - `Content-Security-Policy`, `Strict-Transport-Security`, `X-Frame-Options` などのヘッダーをミドルウェアで設定することを推奨

## 貢献ワークフロー

詳細な貢献手順については、[`contribution_workflow.md`](./contribution_workflow.md) を参照してください。