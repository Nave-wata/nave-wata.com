# プロジェクト構造

このドキュメントでは、Nave-wataプロジェクトのディレクトリ構造と各コンポーネントの役割について説明します。

## ディレクトリ構造

```
nave-wata.com/
├── app/                  # アプリケーション設定
│   ├── container.php     # 依存性注入コンテナの設定
│   ├── routes.php        # ルート定義
│   └── settings.php      # アプリケーション設定
├── docs/                 # プロジェクトドキュメント
├── docker/               # Docker関連ファイル
│   ├── apache/           # Apache設定
│   └── php/              # PHP設定
├── public/               # 公開ディレクトリ
│   ├── assets/           # 静的ファイル（CSS、JS、画像など）
│   └── index.php         # エントリーポイント
├── src/                  # ソースコード
│   ├── Application/      # アプリケーション層
│   │   └── UseCases/     # ユースケース
│   ├── Domain/           # ドメイン層
│   │   └── Repositories/ # リポジトリインターフェース
│   ├── Infrastructure/   # インフラストラクチャ層
│   │   └── Repositories/ # リポジトリ実装
│   ├── Interfaces/       # インターフェース層
│   │   └── Controllers/  # コントローラー
│   └── bootstrap.php     # アプリケーション起動スクリプト
├── templates/            # Twigテンプレート
│   ├── layouts/          # レイアウトテンプレート
│   └── *.twig            # ページテンプレート
├── vendor/               # Composerパッケージ
├── .env                  # 環境変数
├── .env.example          # 環境変数のサンプル
├── composer.json         # Composer設定
├── composer.lock         # Composerロックファイル
├── docker-compose.yml    # Docker Compose設定
└── README.md             # プロジェクト概要
```

## 主要コンポーネントの説明

### app/

アプリケーションの設定ファイルを格納するディレクトリです。

- **container.php**: 依存性注入コンテナの設定を行います。
- **routes.php**: アプリケーションのルート定義を行います。
- **settings.php**: アプリケーションの設定を定義します。

### src/

アプリケーションのソースコードを格納するディレクトリです。クリーンアーキテクチャに基づいて構成されています。

#### クリーンアーキテクチャの層

1. **Domain層** (`src/Domain/`):
   - ビジネスロジックとエンティティを含みます。
   - 他の層に依存しません。

2. **Application層** (`src/Application/`):
   - ユースケースを実装します。
   - Domain層に依存します。

3. **Interfaces層** (`src/Interfaces/`):
   - コントローラーとプレゼンターを含みます。
   - Application層に依存します。

4. **Infrastructure層** (`src/Infrastructure/`):
   - 外部サービスとの連携を担当します。
   - Domain層のインターフェースを実装します。

### templates/

Twigテンプレートを格納するディレクトリです。

- **layouts/**: 共通レイアウトテンプレートを格納します。
- **\*.twig**: 各ページのテンプレートファイルです。

### public/

Webサーバーが直接アクセスする公開ディレクトリです。

- **index.php**: アプリケーションのエントリーポイントです。
- **assets/**: CSS、JavaScript、画像などの静的ファイルを格納します。

### docker/

Docker関連の設定ファイルを格納するディレクトリです。

- **apache/**: Apache Webサーバーの設定ファイルを格納します。
- **php/**: PHPの設定ファイルを格納します。