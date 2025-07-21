<?php

declare(strict_types=1);

namespace App\Interfaces\Controllers;

use App\Domain\Services\MetaDataServiceInterface;
use App\Interfaces\Enum\PageEnum;
use App\Interfaces\Renderers\MetaTagRenderer;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

readonly class StaticPageController
{
    /**
     * @param Twig $view
     * @param MetaDataServiceInterface $metaDataService
     * @param MetaTagRenderer $metaTagRenderer
     */
    public function __construct(
        private Twig $view,
        private MetaDataServiceInterface $metaDataService,
        private MetaTagRenderer $metaTagRenderer
    ) {
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function about(Request $request, Response $response): Response
    {
        $metaData = $this->metaDataService->getMetaData(PageEnum::ABOUT);
        $tags = $this->metaTagRenderer->renderTags($metaData);

        return $this->view->render($response, 'about.twig', array_merge(
            $tags,
            [
                'job_age' => (int)date('n') >= 4 ? (int)date('Y') - 2024 : (int)date('Y') - 2025,
                'engineer_age' => (int)date('Y') - 2020,
            ],
        ));
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function contact(Request $request, Response $response): Response
    {
        $metaData = $this->metaDataService->getMetaData(PageEnum::CONTACT);
        $tags = $this->metaTagRenderer->renderTags($metaData);

        return $this->view->render($response, 'contact.twig', $tags);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function privacyPolicy(Request $request, Response $response): Response
    {
        $metaData = $this->metaDataService->getMetaData(PageEnum::PRIVACY_POLICY);
        $tags = $this->metaTagRenderer->renderTags($metaData);

        return $this->view->render($response, 'privacy-policy.twig', $tags);
    }
}
