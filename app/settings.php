<?php

/**
 * アプリケーション設定
 * 
 * このファイルはアプリケーションの設定を定義します。
 * 環境に応じて設定を変更できるようにします。
 */

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

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

    // WordPressのAPI設定
    'wordpress' => [
        'baseUrl' => $_ENV['WP_BASE_URL'],
        'apiBasePath' => $_ENV['WP_API_BASE_PATH'],
    ],
];
