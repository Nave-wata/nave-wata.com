<?php

declare(strict_types=1);

namespace App\Infrastructure\Services;

use App\Domain\Services\MetaDataServiceInterface;
use App\Domain\ValueObjects\MetaData;
use App\Interfaces\Enum\OgpTypeEnum;
use App\Interfaces\Enum\PageEnum;

/**
 * ページメタデータサービス実装クラス
 * 
 * PageEnumで指定されたページのメタデータ情報を管理し、
 * MetaDataオブジェクトとして返すサービスです。
 * SEO対策のためのメタデータを一元管理します。
 */
class MetaDataService implements MetaDataServiceInterface
{
    private const META_DATA = [
        PageEnum::HOME->value => [
            'title' => 'ホーム',
            'description' => '',
            'og_image' => '',
            'og_url' => '',
            'og_type' => OgpTypeEnum::WEBSITE,
        ],
        PageEnum::ABOUT->value => [
            'title' => 'About | ',
            'description' => 'nave-wataのプロフィールページです。経歴、スキル、経験について詳しく紹介しています。',
            'og_image' => '/img/author/nave-wata.webp',
            'og_url' => '/about',
            'og_type' => OgpTypeEnum::WEBSITE,
        ],
        PageEnum::CONTACT->value => [
            'title' => 'Contact | ',
            'description' => 'nave-wataへのお問い合わせページです。ご質問やご相談がございましたらお気軽にご連絡ください。',
            'og_image' => '/img/author/nave-wata.webp',
            'og_url' => '/contact',
            'og_type' => OgpTypeEnum::WEBSITE,
        ],
        PageEnum::PRIVACY_POLICY->value => [
            'title' => 'Privacy Policy | ',
            'description' => 'nave-wata.comのプライバシーポリシーです。個人情報の取り扱いについて説明しています。',
            'og_image' => '/img/author/nave-wata.webp',
            'og_url' => '/privacy-policy',
            'og_type' => OgpTypeEnum::WEBSITE,
        ],
    ];

    /**
     * 指定されたページのメタデータを取得します
     * 
     * PageEnumで指定されたページに対応するメタデータを定数配列から取得し、
     * MetaDataバリューオブジェクトとして返します。
     *
     * @param PageEnum $page 取得するメタデータのページ種別
     * @return MetaData ページのメタデータオブジェクト
     * 
     * @since 1.0.0
     */
    public function getMetaData(PageEnum $page): MetaData
    {
        return new MetaData(
            self::META_DATA[$page->value]['title'],
            self::META_DATA[$page->value]['description'],
            self::META_DATA[$page->value]['og_image'],
            self::META_DATA[$page->value]['og_url'],
            self::META_DATA[$page->value]['og_type'],
        );
    }
}
