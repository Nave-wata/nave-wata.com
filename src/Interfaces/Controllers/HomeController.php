<?php

namespace App\Interfaces\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * ホームページのコントローラー
 * 
 * このクラスはホームページに関連するHTTPリクエストを処理します。
 * シンプルにビューを表示するだけの実装です。
 */
class HomeController
{
    /**
     * @var Twig Twigテンプレートエンジン
     */
    private Twig $view;

    /**
     * コンストラクタ
     * 
     * @param Twig $view Twigテンプレートエンジン
     */
    public function __construct(Twig $view)
    {
        $this->view = $view;
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
        return $this->view->render($response, 'top.twig');
    }
}
