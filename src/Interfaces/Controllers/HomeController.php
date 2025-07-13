<?php

namespace App\Interfaces\Controllers;

use App\Interfaces\Enum\PageEnum;
use App\Interfaces\Services\MetaDataService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * ホームページのコントローラー
 *
 * このクラスはホームページ（トップページ）に関連するHTTPリクエストを処理します。
 * 単一責任原則に従い、ホームページのみを担当します。
 * 静的なホームページを表示します。
 */
class HomeController
{
    /**
     * コンストラクタ
     *
     * @param Twig $view Twigテンプレートエンジン
     */
    public function __construct(
        private Twig $view
    ) {
    }

    /**
     * ホームページを表示
     *
     * @param Request $request HTTPリクエスト
     * @param Response $response HTTPレスポンス
     * @return Response レンダリングされたHTTPレスポンス
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function home(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'top.twig', array_merge(
            MetaDataService::get(PageEnum::HOME)->toArray(),
            [
                'job_age' => (int)date('n') >= 4 ? (int)date('Y') - 2024 : (int)date('Y') - 2025,
                'engineer_age' => (int)date('Y') - 2020,
            ],
        ));
    }
}
