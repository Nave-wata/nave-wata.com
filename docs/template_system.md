# テンプレートシステム (Template System)

このドキュメントでは、Nave-Wataプロジェクトで使用されているTwigテンプレートシステムについて説明します。

## Twigテンプレートエンジン

このプロジェクトは [Twig](https://twig.symfony.com/) テンプレートエンジンを使用しています。Twigは、PHPのためのモダンで柔軟なテンプレートエンジンで、以下の特徴があります：

- シンプルで読みやすい構文
- 自動エスケープによるセキュリティ
- テンプレートの継承とブロック
- マクロとインクルード機能
- 拡張可能なフィルターとファンクション

## テンプレートの構造

テンプレートは `templates` ディレクトリに保存されています：

- `templates/layouts/layout.twig`: ベースレイアウトテンプレート
- `templates/top.twig`: ホームページテンプレート
- `templates/users/index.twig`: ユーザー一覧ページ
- `templates/users/show.twig`: ユーザー詳細ページ

## レイアウトの継承

Twigのテンプレート継承を使用して、共通のレイアウトを定義しています。`layout.twig`は基本的なHTMLの構造を定義し、子テンプレートが特定のブロックを上書きできるようにしています。

### layouts/layout.twig

```twig
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{% block title %}Nave-Wata{% endblock %}</title>
    {% block head %}{% endblock %}
</head>
<body>
    <header>
        <h1>Nave-Wata</h1>
        <nav>
            <!-- ナビゲーションメニュー -->
        </nav>
    </header>
    
    <main>
        {% block content %}{% endblock %}
    </main>
    
    <footer>
        <!-- フッターコンテンツ -->
    </footer>
    
    {% block scripts %}{% endblock %}
</body>
</html>
```

### ページテンプレートの例 (top.twig)

```twig
{% extends "layouts/layout.twig" %}

{% block title %}ホーム - Nave-Wata{% endblock %}

{% block content %}
    <h2>ようこそ Nave-Wata へ</h2>
    <p>
        このサイトは Slim PHP フレームワークと Twig テンプレートエンジンを使用して構築されています。
    </p>
    <!-- その他のコンテンツ -->
{% endblock %}

{% block head %}
    <style>
        /* ページ固有のスタイル */
    </style>
{% endblock %}
```

## コントローラーからのテンプレートレンダリング

コントローラーからテンプレートをレンダリングするには、Twigビューオブジェクトを使用します：

```php
public function home(Request $request, Response $response): Response
{
    // テンプレートをレンダリング（データなし）
    return $this->view->render($response, 'top.twig');
}
```

データをテンプレートに渡す場合：

```php
public function home(Request $request, Response $response): Response
{
    $data = [
        'title' => 'ホームページ',
        'message' => 'ようこそ！'
    ];
    
    return $this->view->render($response, 'top.twig', $data);
}
```

## Twigの構文

### 変数の出力

```twig
{{ variable }}
```

### 条件分岐

```twig
{% if condition %}
    <!-- 条件が真の場合 -->
{% else %}
    <!-- 条件が偽の場合 -->
{% endif %}
```

### ループ

```twig
{% for item in items %}
    {{ item.name }}
{% endfor %}
```

### フィルター

```twig
{{ variable|upper }}
{{ variable|length }}
{{ variable|date('Y-m-d') }}
```

### インクルード

```twig
{% include 'partials/header.twig' %}
```

### マクロ

```twig
{% macro input(name, value, type = "text") %}
    <input type="{{ type }}" name="{{ name }}" value="{{ value }}">
{% endmacro %}
```

## ベストプラクティス

1. **ロジックとプレゼンテーションの分離**
   - ビジネスロジックはコントローラーやユースケースに実装し、テンプレートにはできるだけロジックを含めないようにします。

2. **共通要素の抽出**
   - 繰り返し使用される要素は部分テンプレートやマクロとして抽出します。

3. **テンプレートの継承**
   - 共通のレイアウトを定義し、ページ固有のコンテンツはブロックで上書きします。

4. **セキュリティ**
   - Twigの自動エスケープ機能を活用し、XSS攻撃を防止します。
   - 信頼できない入力を `raw` フィルターでエスケープ解除しないようにします。