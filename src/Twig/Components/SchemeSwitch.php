<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('SchemeSwitch', template: '@UxBlocksCore/components/SchemeSwitch.html.twig')]
final class SchemeSwitch
{
    public string $scheme = 'auto';

    public bool $enhanced = true;

    public string $schemeEndpoint = '/_ui/theme/scheme';

    /**
     * @var list<array{scheme: string, url: string, active: bool}>
     */
    public array $links = [];
}
