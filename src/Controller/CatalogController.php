<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Controller;

use Symfinity\UxBlocksCore\Showcase\ComponentExampleManifestLoader;
use Symfinity\UxBlocksCore\Showcase\ComponentExampleViewFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class CatalogController extends AbstractController
{
    public function __construct(
        private readonly ComponentExampleManifestLoader $manifestLoader,
        private readonly ComponentExampleViewFactory $viewFactory,
    ) {
    }

    public function catalog(): Response
    {
        $manifests = [];
        foreach ($this->manifestLoader->loadAll() as $manifest) {
            $manifests[] = $this->viewFactory->build($manifest);
        }

        return $this->render('@UxBlocksCore/catalog.html.twig', [
            'manifests' => $manifests,
        ]);
    }
}
