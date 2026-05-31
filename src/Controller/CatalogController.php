<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

final class CatalogController extends AbstractController
{
    public function catalog(): Response
    {
        return $this->render('@UxBlocksCore/catalog.html.twig');
    }
}
