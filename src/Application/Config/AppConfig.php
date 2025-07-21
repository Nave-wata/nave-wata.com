<?php

declare(strict_types=1);

namespace App\Application\Config;

/**
 * アプリケーション設定クラス
 * 
 * 環境変数から設定値を取得し、アプリケーション全体で使用される定数や設定値を管理します。
 */
class AppConfig
{
    /**
     * アプリケーション名を取得します
     * 
     * 環境変数APP_NAMEが設定されている場合はその値を、
     * 設定されていない場合はデフォルト値を返します。
     *
     * @return string アプリケーション名
     */
    public static function getAppName(): string
    {
        return $_ENV['APP_NAME'] ?? 'Nave-wata\'s ブログ';
    }

    /**
     * アプリケーションURLを取得します
     * 
     * 環境変数APP_URLが設定されている場合はその値を、
     * 設定されていない場合はデフォルト値（http://localhost）を返します。
     *
     * @return string アプリケーションのベースURL
     */
    public static function getAppUrl(): string
    {
        return $_ENV['APP_URL'] ?? 'http://localhost';
    }
}
