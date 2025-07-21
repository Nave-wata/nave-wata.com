<?php

use App\Domain\Services\MetaDataServiceInterface;
use App\Infrastructure\Services\MetaDataService;
use App\Interfaces\Renderers\MetaTagRenderer;
use DI\ContainerBuilder;
use Slim\Views\Twig;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

/**
 * 依存性注入コンテナの設定
 *
 * このファイルはアプリケーションの依存性を設定します。
 * 静的ページとホームページのための基本的な依存関係を管理します。
 */
return function() {
    // 設定を読み込む
    $settings = require __DIR__ . '/settings.php';

    // コンテナビルダーを作成
    $containerBuilder = new ContainerBuilder();

    // 定義を設定
    $containerBuilder->addDefinitions([
        // Twig設定
        LoaderInterface::class => \DI\create(FilesystemLoader::class)
            ->constructor(__DIR__ . '/../templates'),
        Twig::class => \DI\create(Twig::class)
            ->constructor(\DI\get(LoaderInterface::class)),

        // Service
        MetaDataServiceInterface::class => \DI\autowire(MetaDataService::class),

        // Renderer
        MetaTagRenderer::class => \DI\autowire(MetaTagRenderer::class),
    ]);

    // コンテナを構築して返す
    return $containerBuilder->build();
};
