<?php

use App\Interfaces\Controllers\BlogController;
use App\Interfaces\Controllers\HomeController;
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

    // ブログページのルート
    $app->get('/blog', [BlogController::class, 'index']);

    // ブログ詳細ページのルート
    $app->get('/blog/{id}', [BlogController::class, 'show']);
};
