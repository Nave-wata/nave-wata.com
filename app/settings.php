<?php

/**
 * アプリケーション設定
 * 
 * このファイルはアプリケーションの設定を定義します。
 * 環境に応じて設定を変更できるようにします。
 */
return [
    'app' => [
        // 表示設定
        'displayErrorDetails' => true, // 開発環境では true、本番環境では false に設定
        'logErrors' => true,
        'logErrorDetails' => true,
    ],

    // Twigの設定
    'twig' => [
        'templates_path' => __DIR__ . '/../templates',
        'cache_path' => false, // キャッシュを無効化（本番環境ではパスを設定）
        'debug' => true,
    ],
];