<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Breadcrumb;

use Symfony\Component\HttpFoundation\Request;

interface BreadcrumbTrailResolverInterface
{
    /**
     * @return list<BreadcrumbItem>
     */
    public function resolve(Request $request): array;
}
