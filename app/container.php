<?php

use App\Domain\Repositories\BlogRepositoryInterface;
use App\Infrastructure\Repositories\WordPressBlogRepository;
use DI\ContainerBuilder;

/**
 * 依存性注入コンテナの設定
 * 
 * このファイルはアプリケーションの依存性を設定します。
 * クリーンアーキテクチャに基づいて、各レイヤーの依存関係を管理します。
 */
return function() {
    // 設定を読み込む
    $settings = require __DIR__ . '/settings.php';

    // コンテナビルダーを作成
    $containerBuilder = new ContainerBuilder();

    // 定義を設定
    $containerBuilder->addDefinitions([
        // WordPressのAPI設定
        'wpBaseUrl' => $settings['wordpress']['baseUrl'],
        'wpApiBasePath' => $settings['wordpress']['apiBasePath'],

        // リポジトリ
        BlogRepositoryInterface::class => \DI\autowire(WordPressBlogRepository::class)
            ->constructorParameter('wpBaseUrl', \DI\get('wpBaseUrl'))
            ->constructorParameter('wpApiBasePath', \DI\get('wpApiBasePath')),
    ]);

    // コンテナを構築して返す
    return $containerBuilder->build();
};
