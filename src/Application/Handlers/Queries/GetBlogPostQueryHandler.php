<?php

namespace App\Application\Handlers\Queries;

use App\Application\DTOs\BlogDTO;
use App\Application\Queries\GetBlogPostQuery;
use App\Domain\Repositories\BlogRepositoryInterface;

/**
 * 単一ブログ記事取得クエリハンドラ
 * 
 * このクラスはGetBlogPostQueryを処理するハンドラです。
 * CQRSパターンのQueryHandlerの役割を果たします。
 */
class GetBlogPostQueryHandler
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
     * クエリを処理して単一のブログ記事を取得
     * 
     * @param GetBlogPostQuery $query 単一ブログ記事取得クエリ
     * @return BlogDTO|null ブログDTO、記事が存在しない場合はnull
     */
    public function handle(GetBlogPostQuery $query): ?BlogDTO
    {
        $blog = $this->blogRepository->findById($query->getId());

        if ($blog === null) {
            return null;
        }

        // ドメインエンティティをDTOに変換
        return BlogDTO::fromEntity($blog);
    }
}