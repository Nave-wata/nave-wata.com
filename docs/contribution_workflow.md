# 貢献ワークフロー

このドキュメントでは、Nave-Wataプロジェクトへの貢献方法と変更を行うためのワークフローについて説明します。

## 開発環境のセットアップ

1. **リポジトリのクローン**

   ```bash
   git clone <repository-url>
   cd nave-wata.com
   ```

2. **依存関係のインストール**

   ```bash
   composer install
   ```

3. **環境変数の設定**

   `.env.example` ファイルを `.env` にコピーし、必要に応じて値を変更します。

   ```bash
   cp .env.example .env
   ```

4. **Dockerの起動**

   ```bash
   docker-compose up -d
   ```

5. **アプリケーションへのアクセス**

   ブラウザで `http://localhost:8080` にアクセスします。

## 変更の手順

### 1. 新しい機能やバグ修正の開発

1. **新しいブランチの作成**

   ```bash
   git checkout -b feature/your-feature-name
   # または
   git checkout -b fix/your-bug-fix
   ```

2. **変更の実装**

   - [開発ガイドライン](./development_guidelines.md)に従ってコードを実装します。
   - 必要に応じてテストを追加します。

3. **ローカルでのテスト**

   - 実装した機能が正しく動作することを確認します。
   - 既存のテストが通ることを確認します。

### 2. コードのコミット

1. **変更をステージング**

   ```bash
   git add .
   ```

2. **コミットの作成**

   ```bash
   git commit -m "feat: 機能の説明"
   # または
   git commit -m "fix: バグ修正の説明"
   ```

   コミットメッセージは以下の形式に従います：

   - `feat:` - 新機能
   - `fix:` - バグ修正
   - `docs:` - ドキュメントのみの変更
   - `style:` - コードの意味に影響を与えない変更（空白、フォーマット、セミコロンの欠落など）
   - `refactor:` - バグ修正でも新機能の追加でもないコードの変更
   - `test:` - テストの追加または修正
   - `chore:` - ビルドプロセスやツールの変更

### 3. プルリクエストの作成

1. **リモートリポジトリにプッシュ**

   ```bash
   git push origin feature/your-feature-name
   ```

2. **プルリクエストの作成**

   GitHubやGitLabなどのプラットフォームでプルリクエストを作成します。

   - タイトルは明確で簡潔にします。
   - 説明には変更の目的、実装の詳細、テスト方法などを記載します。
   - 関連するイシューがある場合は、そのイシュー番号を記載します。

### 4. コードレビュー

1. **レビューの依頼**

   プロジェクトのメンテナーやチームメンバーにレビューを依頼します。

2. **フィードバックへの対応**

   レビューでのフィードバックに基づいて変更を行い、再度プッシュします。

   ```bash
   git add .
   git commit -m "refactor: レビューフィードバックの対応"
   git push origin feature/your-feature-name
   ```

### 5. マージと公開

1. **プルリクエストのマージ**

   すべてのレビューが完了し、承認されたら、プルリクエストをマージします。

2. **ブランチの削除**

   マージ後、不要になったブランチを削除します。

   ```bash
   git checkout main
   git pull
   git branch -d feature/your-feature-name
   ```

## リリースプロセス

1. **バージョンタグの作成**

   ```bash
   git tag -a v1.0.0 -m "バージョン1.0.0"
   git push origin v1.0.0
   ```

2. **リリースノートの作成**

   GitHubやGitLabなどのプラットフォームでリリースノートを作成します。

   - 追加された機能
   - 修正されたバグ
   - 非互換性のある変更
   - 依存関係の更新

3. **本番環境へのデプロイ**

   ```bash
   # 本番環境でのデプロイコマンド
   ```

## トラブルシューティング

開発中に問題が発生した場合は、以下の手順を試してください：

1. **ログの確認**

   ```bash
   docker-compose logs -f
   ```

2. **依存関係の更新**

   ```bash
   composer update
   ```

3. **Dockerコンテナの再起動**

   ```bash
   docker-compose down
   docker-compose up -d
   ```

4. **キャッシュのクリア**

   ```bash
   # Twigキャッシュのクリア
   rm -rf var/cache/twig/*
   ```

問題が解決しない場合は、イシューを作成して詳細を報告してください。