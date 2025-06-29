<?php

namespace App\Domain\Repositories;

use App\Domain\Entities\Blog;

/**
 * ブログリポジトリインターフェース
 * 
 * このインターフェースはブログ記事のデータアクセスを抽象化します。
 * ドメイン層に属し、具体的な実装はインフラストラクチャ層で行われます。
 */
interface BlogRepositoryInterface
{
    /**
     * すべてのブログ記事を取得
     * 
     * @param int $perPage 1ページあたりの記事数
     * @param int $page ページ番号
     * @return Blog[] ブログ記事の配列
     */
    public function findAll(int $perPage = 10, int $page = 1): array;
    
    /**
     * 指定されたIDのブログ記事を取得
     * 
     * @param int $id 記事ID
     * @return Blog|null ブログ記事、存在しない場合はnull
     */
    public function findById(int $id): ?Blog;
}