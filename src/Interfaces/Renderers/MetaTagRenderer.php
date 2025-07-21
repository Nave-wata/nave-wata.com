<?php

declare(strict_types=1);

namespace App\Interfaces\Renderers;

use App\Application\Config\AppConfig;
use App\Domain\ValueObjects\MetaData;

/**
 * MetaDataオブジェクトからHTMLメタタグを生成するクラス
 * 
 * SEO対策およびOGP（Open Graph Protocol）タグの生成を担当します。
 * MetaDataバリューオブジェクトを受け取り、テンプレートで使用する
 * HTMLメタタグの配列を生成します。
 * 
 * @since 1.0.0
 * @author Nave-wata
 */
class MetaTagRenderer
{
    /**
     * MetaDataオブジェクトを受け取り、HTMLメタタグの配列を返します
     * 
     * 各種SEOタグ（title、description）とOGPタグ（og:title、og:description等）
     * を生成し、テンプレート変数として使用できる形で返します。
     *
     * @param MetaData $metaData メタデータオブジェクト
     * @return array<string, string> HTMLタグの連想配列（キー：タグ種別、値：HTMLタグ文字列）
     * 
     * @since 1.0.0
     */
    public function renderTags(MetaData $metaData): array
    {
        return [
            'title' => $this->generateTitle($metaData->title),
            'meta_description' => $this->generateDescription($metaData->description),
            'og_title' => $this->generateTitleOgp($metaData->title),
            'og_description' => $this->generateOgpDescription($metaData->description),
            'og_image' => $this->generateOgpImage($metaData->ogImage),
            'og_type' => $this->generateOgpType($metaData->ogType->value),
            'og_url' => $this->generateOgpUrl($metaData->ogUrl),
            'og_site_name' => $this->generateOgpSiteName(),
        ];
    }

    /**
     * ページタイトルタグを生成します
     *
     * @param string $title ページタイトル
     * @return string 完成したtitleタグのHTML文字列
     */
    private function generateTitle(string $title): string
    {
        return '<title>' . $title . AppConfig::getAppName() . '</title>';
    }

    /**
     * OGPタイトルタグを生成します
     *
     * @param string $title ページタイトル
     * @return string 完成したog:titleメタタグのHTML文字列
     */
    private function generateTitleOgp(string $title): string
    {
        return '<meta property="og:title" content="' . $title . AppConfig::getAppName() . '">';
    }

    /**
     * ページ説明メタタグを生成します
     *
     * @param string $description ページの説明
     * @return string 完成したdescriptionメタタグのHTML文字列
     */
    private function generateDescription(string $description): string
    {
        return '<meta name="description" content="' . $description . '">';
    }

    /**
     * OGP説明タグを生成します
     *
     * @param string $description ページの説明
     * @return string 完成したog:descriptionメタタグのHTML文字列
     */
    private function generateOgpDescription(string $description): string
    {
        return '<meta property="og:description" content="' . $description . '">';
    }

    /**
     * OGP画像タグを生成します
     *
     * @param string $ogImage OGP画像の相対パス
     * @return string 完成したog:imageメタタグのHTML文字列
     */
    private function generateOgpImage(string $ogImage): string
    {
        return '<meta property="og:image" content="' . AppConfig::getAppUrl() . $ogImage . '">';
    }

    /**
     * OGPタイプタグを生成します
     *
     * @param string $ogType OGPタイプ（website、article等）
     * @return string 完成したog:typeメタタグのHTML文字列
     */
    private function generateOgpType(string $ogType): string
    {
        return '<meta property="og:type" content="' . $ogType . '">';
    }

    /**
     * OGP URLタグを生成します
     *
     * @param string $ogUrl OGP URLの相対パス
     * @return string 完成したog:urlメタタグのHTML文字列
     */
    private function generateOgpUrl(string $ogUrl): string
    {
        return '<meta property="og:url" content="' . AppConfig::getAppUrl() . $ogUrl . '">';
    }

    /**
     * OGPサイト名タグを生成します
     *
     * @return string 完成したog:site_nameメタタグのHTML文字列
     */
    private function generateOgpSiteName(): string
    {
        return '<meta property="og:site_name" content="' . AppConfig::getAppName() . '">';
    }
}
