<?php

declare(strict_types=1);

namespace App\Interfaces\Controllers;

use App\Domain\Services\MetaDataServiceInterface;
use App\Interfaces\Enum\PageEnum;
use App\Interfaces\Renderers\MetaTagRenderer;
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
readonly class HomeController
{
    /**
     * コンストラクタ
     *
     * @param Twig $view Twigテンプレートエンジン
     * @param MetaDataServiceInterface $metaDataService メタデータサービス
     * @param MetaTagRenderer $metaTagRenderer メタタグレンダラー
     */
    public function __construct(
        private Twig $view,
        private MetaDataServiceInterface $metaDataService,
        private MetaTagRenderer $metaTagRenderer
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
        $metaData = $this->metaDataService->getMetaData(PageEnum::HOME);
        $tags = $this->metaTagRenderer->renderTags($metaData);

        return $this->view->render($response, 'top.twig', array_merge(
            $tags,
            [
                'job_age' => (int)date('n') >= 4 ? (int)date('Y') - 2024 : (int)date('Y') - 2025,
                'engineer_age' => (int)date('Y') - 2020,
            ],
        ));
    }
}
