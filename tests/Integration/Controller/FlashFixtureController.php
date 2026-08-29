<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Integration\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FlashFixtureController extends AbstractController
{
    #[Route('/test/flash', name: 'ux_blocks_core_test_flash_post', methods: ['POST'])]
    public function post(): Response
    {
        $this->addFlash('success', 'Saved');

        return $this->redirectToRoute('ux_blocks_core_test_flash_view');
    }

    #[Route('/test/flash/view', name: 'ux_blocks_core_test_flash_view', methods: ['GET'])]
    public function view(): Response
    {
        return $this->render('flash_fixture.html.twig');
    }
}
