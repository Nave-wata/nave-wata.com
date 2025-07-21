<?php

namespace App\Application\DTOs;

use App\Domain\Entities\Blog;

/**
 * ブログDTO
 * 
 * このクラスはブログ記事のデータを転送するためのDTOです。
 * アプリケーション層とインターフェース層の間でデータを転送するために使用されます。
 */
class BlogDTO
{
    /**
     * コンストラクタ
     * 
     * @param int $id 記事ID
     * @param string $title 記事タイトル
     * @param string $content 記事内容
     * @param string $excerpt 記事抜粋
     * @param \DateTimeImmutable $date 投稿日時
     * @param string $link 記事URL
     */
    public function __construct(
        private int $id,
        private string $title,
        private string $content,
        private string $excerpt,
        private \DateTimeImmutable $date,
        private string $link
    ) {
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

    /**
     * 記事タイトルを取得
     * 
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * 記事内容を取得
     * 
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * 記事抜粋を取得
     * 
     * @return string
     */
    public function getExcerpt(): string
    {
        return $this->excerpt;
    }

    /**
     * 投稿日時を取得
     * 
     * @return \DateTimeImmutable
     */
    public function getDate(): \DateTimeImmutable
    {
        return $this->date;
    }

    /**
     * 記事URLを取得
     * 
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }

    /**
     * ドメインエンティティからDTOを作成
     * 
     * @param Blog $blog ブログエンティティ
     * @return self
     */
    public static function fromEntity(Blog $blog): self
    {
        return new self(
            $blog->getId(),
            $blog->getTitle(),
            $blog->getContent(),
            $blog->getExcerpt(),
            $blog->getDate(),
            $blog->getLink()
        );
    }
}
