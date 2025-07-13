<?php

namespace App\Interfaces\Controllers;

use App\Application\Handlers\Queries\GetBlogPostQueryHandler;
use App\Application\Handlers\Queries\GetBlogPostsQueryHandler;
use App\Application\Queries\GetBlogPostQuery;
use App\Application\Queries\GetBlogPostsQuery;
use App\Interfaces\Presenters\BlogPresenter;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Exception\HttpNotFoundException;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

/**
 * ブログページのコントローラー
 *
 * このクラスはブログページに関連するHTTPリクエストを処理します。
 * アプリケーション層を通じてブログ記事を取得し、ビューに表示します。
 */
class BlogController
{
    /**
     * コンストラクタ
     *
     * @param Twig $view Twigテンプレートエンジン
     * @param GetBlogPostsQueryHandler $getBlogPostsQueryHandler ブログ記事取得クエリハンドラ
     * @param GetBlogPostQueryHandler $getBlogPostQueryHandler 単一ブログ記事取得クエリハンドラ
     * @param BlogPresenter $blogPresenter ブログプレゼンター
     */
    public function __construct(
        private Twig $view,
        private GetBlogPostsQueryHandler $getBlogPostsQueryHandler,
        private GetBlogPostQueryHandler $getBlogPostQueryHandler,
        private BlogPresenter $blogPresenter
    ) {
    }

    /**
     * ブログページを表示
     *
     * @param Request $request HTTPリクエスト
     * @param Response $response HTTPレスポンス
     * @return Response レンダリングされたHTTPレスポンス
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function index(Request $request, Response $response): Response
    {
        // クエリパラメータからGetBlogPostsQueryを作成
        $query = GetBlogPostsQuery::fromArray($request->getQueryParams());

        // クエリハンドラを使用してブログDTOを取得
        $blogDTOs = $this->getBlogPostsQueryHandler->handle($query);

        // プレゼンターを使用してブログDTOをビュー用のデータに変換
        $posts = $this->blogPresenter->presentCollection($blogDTOs);

        // ビューにデータを渡してレンダリング
        return $this->view->render($response, 'blog.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * 単一のブログ記事ページを表示
     *
     * @param Request $request HTTPリクエスト
     * @param Response $response HTTPレスポンス
     * @return Response レンダリングされたHTTPレスポンス
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function show(Request $request, Response $response): Response
    {
        // ルートパラメータからGetBlogPostQueryを作成
        $query = GetBlogPostQuery::fromArray($request->getAttributes());

        try {
            // クエリハンドラを使用して単一のブログDTOを取得
            $blogDTO = $this->getBlogPostQueryHandler->handle($query);
        } catch (\InvalidArgumentException $e) {
            throw new HttpNotFoundException($request, '無効なブログ記事IDが指定されました。');
        }

        if ($blogDTO === null) {
            throw new HttpNotFoundException($request, '指定されたブログ記事が見つかりませんでした。');
        }

        // プレゼンターを使用してブログDTOをビュー用のデータに変換
        $post = $this->blogPresenter->presentItem($blogDTO);

        // ビューにデータを渡してレンダリング
        return $this->view->render($response, 'blog-detail.twig', [
            'post' => $post
        ]);
    }
}
