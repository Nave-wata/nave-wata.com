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
    echo $e->getMessage() . '<br><br>';
    echo $e->getFile() . ':' . $e->getLine() . '<br><br>';
    echo $e->getTraceAsString() . '<br><br>';
    exit();
}
