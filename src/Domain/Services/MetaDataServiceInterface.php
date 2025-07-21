<?php

declare(strict_types=1);

namespace App\Domain\Services;

use App\Domain\ValueObjects\MetaData;
use App\Interfaces\Enum\PageEnum;

/**
 * ページのメタデータを取得するためのサービスインターフェース
 */
interface MetaDataServiceInterface
{
    /**
     * 指定されたページのメタデータを取得します。
     *
     * @param PageEnum $page ページの種類を指定するEnum
     * @return MetaData メタデータオブジェクト
     */
    public function getMetaData(PageEnum $page): MetaData;
}
