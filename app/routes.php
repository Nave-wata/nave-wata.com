<?php

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
};
