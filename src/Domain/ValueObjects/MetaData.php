<?php

declare(strict_types=1);

namespace App\Domain\ValueObjects;

use App\Interfaces\Enum\OgpTypeEnum;

/**
 * ページのメタデータを表す値オブジェクト
 * 
 * SEO対策とOGP（Open Graph Protocol）に必要な情報を
 * 不変なオブジェクトとして保持します。
 * 
 * @since 1.0.0
 * @author Nave-wata
 */
readonly class MetaData
{
    /**
     * メタデータオブジェクトを構築します
     * 
     * @param string $title ページのタイトル（SEOとOGPの両方で使用）
     * @param string $description ページの説明文（meta descriptionとog:descriptionで使用）
     * @param string $ogImage OGP画像の相対パス（og:imageで使用）
     * @param string $ogUrl OGPページURLの相対パス（og:urlで使用）
     * @param OgpTypeEnum $ogType OGPのタイプ（website、article等）
     */
    public function __construct(
        public string      $title,
        public string      $description,
        public string      $ogImage,
        public string      $ogUrl,
        public OgpTypeEnum $ogType
    ) {}
}
