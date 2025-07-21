<?php

declare(strict_types=1);

namespace App\Interfaces\Services;

use App\Interfaces\Config\AppConfig;
use App\Interfaces\Enum\OgpTypeEnum;
use App\Interfaces\Enum\PageEnum;

class MetaDataService
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

    public function __construct(
        private readonly string      $title,
        private readonly string      $description,
        private readonly string      $ogImage,
        private readonly string      $ogUrl,
        private readonly OgpTypeEnum $ogType
    ) {}

    /**
     * @param PageEnum $page
     * @return self
     */
    public static function get(PageEnum $page): self
    {
        return new self(
            self::META_DATA[$page->value]['title'],
            self::META_DATA[$page->value]['description'],
            self::META_DATA[$page->value]['og_image'],
            self::META_DATA[$page->value]['og_url'],
            self::META_DATA[$page->value]['og_type'],
        );
    }

    /**
     * @return array{
     *      title: string,
     *      description: string,
     *      og_image: string,
     *      og_url: string,
     *      og_type: OgpTypeEnum,
     * }
     */
    public function toArray(): array
    {
        return [
            'title' => $this->generateTitle(),
            'meta_description' => $this->generateDescription(),
            'og_title' => $this->generateTitleOgp(),
            'og_description' => $this->generateOgpDescription(),
            'og_image' => $this->generateOgpImage(),
            'og_type' => $this->generateOgpType(),
            'og_url' => $this->generateOgpUrl(),
            'og_site_name' => $this->generateOgpSiteName(),
        ];
    }

    private function generateTitle(): string
    {
        return '<title>' . $this->title . AppConfig::APP_NAME . '</title>';
    }

    private function generateTitleOgp(): string
    {
        return '<meta property="og:title" content="' . $this->title . AppConfig::APP_NAME . '">';
    }

    private function generateDescription(): string
    {
        return '<meta name="description" content="' . $this->description . '">';
    }

    private function generateOgpDescription(): string
    {
        return '<meta property="og:description" content="' . $this->description . '">';
    }

    private function generateOgpImage(): string
    {
        return '<meta property="og:image" content="' . AppConfig::APP_URL . $this->ogImage . '">';
    }

    private function generateOgpType(): string
    {
        return '<meta property="og:type" content="' . $this->ogType->value . '">';
    }

    private function generateOgpUrl(): string
    {
        return '<meta property="og:url" content="' . AppConfig::APP_URL . $this->ogUrl . '">';
    }

    private function generateOgpSiteName(): string
    {
        return '<meta property="og:site_name" content="' . AppConfig::APP_NAME . '">';
    }
}
