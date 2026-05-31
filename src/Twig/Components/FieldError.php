<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('Field:Error', template: '@UxBlocksCore/components/_shared/p_alert_slot.html.twig')]
final class FieldError
{
}
