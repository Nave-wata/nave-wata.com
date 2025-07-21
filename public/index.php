<?php

/**
 * アプリケーションのエントリーポイント
 * 
 * このファイルはウェブリクエストのエントリーポイントです。
 * ブートストラップファイルを読み込み、アプリケーションを実行します。
 * 
 * クリーンアーキテクチャの原則に従い、このファイルはできるだけシンプルに保ち、
 * 実際の初期化ロジックは別のファイルに分離しています。
 */

try {
    // ブートストラップファイルを読み込み、アプリケーションを取得
    $app = require __DIR__ . '/../src/bootstrap.php';

    // アプリケーションを実行
    $app->run();
} catch (\Throwable $e) {
    // 環境変数から本番環境かどうかを判定
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
    $dotenv->load();
    
    $isProduction = $_ENV['APP_ENV'] === 'production';
    
    if ($isProduction) {
        // 本番環境では一般的なエラーメッセージのみ表示
        echo '<h1>500 Internal Server Error</h1>';
        echo '<p>申し訳ございませんが、サーバーエラーが発生しました。しばらくしてから再度お試しください。</p>';
        
        // ログファイルにエラー詳細を記録（実装により異なる）
        error_log("Error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
    } else {
        // 開発環境では詳細なエラー情報を表示
        echo $e->getMessage() . '<br><br>';
        echo $e->getFile() . ':' . $e->getLine() . '<br><br>';
        echo $e->getTraceAsString() . '<br><br>';
    }
    exit();
}
