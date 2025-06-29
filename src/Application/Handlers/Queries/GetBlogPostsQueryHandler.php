<?php

namespace App\Application\Handlers\Queries;

use App\Application\DTOs\BlogDTO;
use App\Application\Queries\GetBlogPostsQuery;
use App\Domain\Repositories\BlogRepositoryInterface;

/**
 * ブログ記事取得クエリハンドラ
 * 
 * このクラスはGetBlogPostsQueryを処理するハンドラです。
 * CQRSパターンのQueryHandlerの役割を果たします。
 */
class GetBlogPostsQueryHandler
{
    /**
     * @var BlogRepositoryInterface ブログリポジトリ
     */
    private BlogRepositoryInterface $blogRepository;

    /**
     * コンストラクタ
     * 
     * @param BlogRepositoryInterface $blogRepository ブログリポジトリ
     */
    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * クエリを処理してブログ記事を取得
     * 
     * @param GetBlogPostsQuery $query ブログ記事取得クエリ
     * @return BlogDTO[] ブログDTOの配列
     */
    public function handle(GetBlogPostsQuery $query): array
    {
        $blogs = $this->blogRepository->findAll(
            $query->getPerPage(),
            $query->getPage()
        );

        // ドメインエンティティをDTOに変換
        $blogDTOs = [];
        foreach ($blogs as $blog) {
            $blogDTOs[] = BlogDTO::fromEntity($blog);
        }

        return $blogDTOs;
    }
}
