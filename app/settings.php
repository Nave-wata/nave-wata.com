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
    // アプリケーション基本設定
    'displayErrorDetails' => $_ENV['APP_ENV'] !== 'production',
    'logErrorDetails' => true,
    'logErrors' => true,

    // Twigの設定
    'twig' => [
        'templates_path' => __DIR__ . '/../templates',
        'cache_path' => $_ENV['APP_ENV'] === 'production' ? __DIR__ . '/../var/cache/twig' : false,
        'debug' => $_ENV['APP_ENV'] === 'development',
    ],

    // WordPressのAPI設定
    'wordpress' => [
        'baseUrl' => $_ENV['WP_BASE_URL'],
        'apiBasePath' => $_ENV['WP_API_BASE_PATH'],
        'graphqlEndpoint' => $_ENV['WP_GRAPHQL_ENDPOINT'],
    ],

    // 年数計算用の設定
    'dates' => [
        'job_start_year' => 2024,
        'job_start_year_offset' => 2025, // 4月以前の場合に使用
        'engineer_start_year' => 2020,
    ],
];
