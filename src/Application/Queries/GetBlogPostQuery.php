<?php

namespace App\Application\Queries;

use InvalidArgumentException;

/**
 * 単一ブログ記事取得クエリ
 * 
 * このクラスは単一のブログ記事を取得するためのクエリオブジェクトです。
 * CQRSパターンのQueryの役割を果たします。
 */
class GetBlogPostQuery
{
    /**
     * コンストラクタ
     * 
     * @param int $id 記事ID
     */
    public function __construct(
        private int $id
    ) {
    }

    /**
     * ルートパラメータから新しいインスタンスを作成
     * 
     * @param array $routeParams ルートパラメータ
     * @return self
     * @throws InvalidArgumentException
     */
    public static function fromArray(array $routeParams): self
    {
        if (!isset($routeParams['id']) || !is_numeric($routeParams['id'])) {
            throw new InvalidArgumentException('Invalid or missing post ID');
        }

        return new self((int)$routeParams['id']);
    }

    /**
     * 記事IDを取得
     * 
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}
