<?php

use App\Interfaces\Controllers\HomeController;
use DI\ContainerBuilder;

/**
 * 依存性注入コンテナの設定
 * 
 * このファイルはアプリケーションの依存性を設定します。
 * シンプルな実装のため、必要最小限の依存関係のみを管理します。
 */
return function() {
    // コンテナビルダーを作成
    $containerBuilder = new ContainerBuilder();

    // 定義を設定
    $containerBuilder->addDefinitions([
        // コントローラー
        HomeController::class => \DI\autowire(HomeController::class),
    ]);

    // コンテナを構築して返す
    return $containerBuilder->build();
};
