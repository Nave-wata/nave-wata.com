<?php

use App\Interfaces\Controllers\HomeController;
use App\Interfaces\Controllers\StaticPageController;
use Slim\App;

/**
 * ルート設定
 *
 * このファイルはアプリケーションのルートを設定します。
 * 各ルートは特定のコントローラーメソッドにマッピングされます。
 */
return function(App $app) {
    // ホームページのルート
    $app->get('/', [HomeController::class, 'home']);

    // 固定ページのルート
    $app->get('/about', [StaticPageController::class, 'about']);
    $app->get('/contact', [StaticPageController::class, 'contact']);
    $app->get('/privacy-policy', [StaticPageController::class, 'privacyPolicy']);
};
