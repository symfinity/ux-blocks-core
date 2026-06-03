<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Dialog', template: '@UxBlocksCore/components/Dialog.html.twig')]
final class Dialog
{
    public bool $open = false;

}