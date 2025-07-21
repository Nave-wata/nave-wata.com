<?php

namespace App\Interfaces\Presenters;

use App\Application\DTOs\BlogDTO;

/**
 * ブログプレゼンター
 * 
 * このクラスはブログDTOをビュー用のデータに変換するプレゼンターです。
 * インターフェース層に属し、表示用データの整形を担当します。
 */
class BlogPresenter
{
    /**
     * ブログDTOをビュー用のデータに変換
     * 
     * @param BlogDTO[] $blogDTOs ブログDTOの配列
     * @return array ビュー用のデータ
     */
    public function presentCollection(array $blogDTOs): array
    {
        $posts = [];

        foreach ($blogDTOs as $blogDTO) {
            $posts[] = $this->presentItem($blogDTO);
        }

        return $posts;
    }

    /**
     * 単一のブログDTOをビュー用のデータに変換
     * 
     * @param BlogDTO $blogDTO ブログDTO
     * @return array ビュー用のデータ
     */
    public function presentItem(BlogDTO $blogDTO): array
    {
        return [
            'id' => $blogDTO->getId(),
            'title' => ['rendered' => $blogDTO->getTitle()],
            'content' => ['rendered' => $blogDTO->getContent()],
            'excerpt' => ['rendered' => $blogDTO->getExcerpt()],
            'date' => $blogDTO->getDate()->format('c'),
            'link' => $blogDTO->getLink()
        ];
    }
}