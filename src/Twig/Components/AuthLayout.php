<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('AuthLayout', template: '@UxBlocksCore/components/AuthLayout.html.twig')]
final class AuthLayout
{
}