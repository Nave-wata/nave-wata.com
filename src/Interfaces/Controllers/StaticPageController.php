<?php

declare(strict_types=1);

namespace App\Interfaces\Controllers;

use App\Interfaces\Enum\PageEnum;
use App\Interfaces\Services\MetaDataService;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

readonly class StaticPageController
{
    public function __construct(
        private Twig $view,
    ) {
    }

    public function about(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'about.twig', array_merge(
            MetaDataService::get(PageEnum::ABOUT)->toArray(),
            [
                'job_age' => (int)date('n') >= 4 ? (int)date('Y') - 2024 : (int)date('Y') - 2025,
                'engineer_age' => (int)date('Y') - 2020,
            ],
        ));
    }

    public function contact(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'contact.twig', 
            MetaDataService::get(PageEnum::CONTACT)->toArray()
        );
    }

    public function privacyPolicy(Request $request, Response $response): Response
    {
        return $this->view->render($response, 'privacy-policy.twig', 
            MetaDataService::get(PageEnum::PRIVACY_POLICY)->toArray()
        );
    }
}
