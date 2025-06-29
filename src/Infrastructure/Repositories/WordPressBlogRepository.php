<?php

namespace App\Infrastructure\Repositories;

use App\Domain\Entities\Blog;
use App\Domain\Repositories\BlogRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;

/**
 * WordPressブログリポジトリ
 * 
 * このクラスはWordPressのREST APIを使用してブログ記事を取得するリポジトリの実装です。
 * インフラストラクチャ層に属し、ドメイン層で定義されたインターフェースを実装します。
 */
class WordPressBlogRepository implements BlogRepositoryInterface
{
    /**
     * @var Client HTTPクライアント
     */
    private Client $httpClient;

    /**
     * @var string WordPressのベースURL
     */
    private string $wpBaseUrl;

    /**
     * @var string WordPressのAPIベースパス
     */
    private string $wpApiBasePath;

    /**
     * コンストラクタ
     * 
     * @param Client $httpClient HTTPクライアント
     * @param string $wpBaseUrl WordPressのベースURL
     * @param string $wpApiBasePath WordPressのAPIベースパス
     */
    public function __construct(
        Client $httpClient,
        string $wpBaseUrl,
        string $wpApiBasePath
    ) {
        $this->httpClient = $httpClient;
        $this->wpBaseUrl = $wpBaseUrl;
        $this->wpApiBasePath = $wpApiBasePath;
    }

    /**
     * すべてのブログ記事を取得
     * 
     * @param int $perPage 1ページあたりの記事数
     * @param int $page ページ番号
     * @return Blog[] ブログ記事の配列
     */
    public function findAll(int $perPage = 10, int $page = 1): array
    {
        $endpoint = '/posts';
        $queryParams = [
            'per_page' => $perPage,
            'page' => $page,
            '_embed' => 1 // メディアや著者情報も取得
        ];

        $posts = $this->fetchFromApi($endpoint, $queryParams);

        if ($posts === null) {
            return [];
        }

        return $this->mapToDomainEntities($posts);
    }

    /**
     * 指定されたIDのブログ記事を取得
     * 
     * @param int $id 記事ID
     * @return Blog|null ブログ記事、存在しない場合はnull
     */
    public function findById(int $id): ?Blog
    {
        $endpoint = '/posts/' . $id;
        $queryParams = [
            '_embed' => 1 // メディアや著者情報も取得
        ];

        $post = $this->fetchFromApi($endpoint, $queryParams);

        if ($post === null) {
            return null;
        }

        return $this->mapToDomainEntity($post);
    }

    /**
     * WordPressのAPIからデータを取得
     * 
     * @param string $endpoint APIエンドポイント
     * @param array $queryParams クエリパラメータ
     * @return array|null APIレスポンス、エラーの場合はnull
     */
    private function fetchFromApi(string $endpoint, array $queryParams = []): ?array
    {
        $url = $this->wpBaseUrl . $this->wpApiBasePath . $endpoint;

        try {
            $response = $this->httpClient->request('GET', $url, [
                'query' => $queryParams
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (GuzzleException $e) {
            // エラーログを出力するなどの処理を追加できます
            return null;
        }
    }

    /**
     * WordPressのAPIレスポンスをドメインエンティティの配列に変換
     * 
     * @param array $posts WordPressのAPIレスポンス
     * @return Blog[] ブログエンティティの配列
     */
    private function mapToDomainEntities(array $posts): array
    {
        $blogs = [];

        foreach ($posts as $post) {
            $blog = $this->mapToDomainEntity($post);
            if ($blog !== null) {
                $blogs[] = $blog;
            }
        }

        return $blogs;
    }

    /**
     * WordPressの投稿データをドメインエンティティに変換
     * 
     * @param array $post WordPressの投稿データ
     * @return Blog|null ブログエンティティ、変換できない場合はnull
     */
    private function mapToDomainEntity(array $post): ?Blog
    {
        if (!isset($post['id'], $post['title']['rendered'], $post['content']['rendered'], 
                  $post['excerpt']['rendered'], $post['date'], $post['link'])) {
            return null;
        }

        try {
            return new Blog(
                $post['id'],
                $post['title']['rendered'],
                $post['content']['rendered'],
                $post['excerpt']['rendered'],
                new \DateTimeImmutable($post['date']),
                $post['link']
            );
        } catch (\Exception $e) {
            // 日付の変換に失敗した場合などのエラー処理
            return null;
        }
    }
}
