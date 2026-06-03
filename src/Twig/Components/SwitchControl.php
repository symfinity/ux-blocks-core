<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Switch', template: '@UxBlocksCore/components/Switch.html.twig')]
final class SwitchControl
{
    public bool $checked = false;

}