<?php

namespace App\Application\Queries;

/**
 * ブログ記事取得クエリ
 * 
 * このクラスはブログ記事を取得するためのクエリオブジェクトです。
 * CQRSパターンのQueryの役割を果たします。
 */
class GetBlogPostsQuery
{
    /**
     * @var int 1ページあたりの記事数
     */
    private int $perPage;

    /**
     * @var int ページ番号
     */
    private int $page;

    /**
     * コンストラクタ
     * 
     * @param int|null $perPage 1ページあたりの記事数
     * @param int|null $page ページ番号
     */
    public function __construct(?int $perPage = null, ?int $page = null)
    {
        $this->perPage = $perPage ?? 10;
        $this->page = $page ?? 1;

        // ページ番号は1以上であることを保証
        if ($this->page < 1) {
            $this->page = 1;
        }

        // 1ページあたりの記事数は1以上であることを保証
        if ($this->perPage < 1) {
            $this->perPage = 10;
        }
    }

    /**
     * クエリパラメータから新しいインスタンスを作成
     * 
     * @param array $queryParams クエリパラメータ
     * @return self
     */
    public static function fromArray(array $queryParams): self
    {
        $page = isset($queryParams['page']) ? (int)$queryParams['page'] : null;
        $perPage = isset($queryParams['per_page']) ? (int)$queryParams['per_page'] : null;

        return new self($perPage, $page);
    }

    /**
     * 1ページあたりの記事数を取得
     * 
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * ページ番号を取得
     * 
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }
}
