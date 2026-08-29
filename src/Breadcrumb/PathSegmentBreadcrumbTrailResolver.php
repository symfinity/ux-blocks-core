<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Breadcrumb;

use Symfony\Component\HttpFoundation\Request;

/**
 * Builds a trail from the request path: /products/bad-banana → Home, Products, Bad Banana.
 * Intermediate segments link to their cumulative prefix; the last segment is current (no link).
 */
final class PathSegmentBreadcrumbTrailResolver implements BreadcrumbTrailResolverInterface
{
    private const HOME_LABEL = 'Home';

    /**
     * @return list<BreadcrumbItem>
     */
    public function resolve(Request $request): array
    {
        $segments = $this->pathSegments($request->getPathInfo());
        if ([] === $segments) {
            return [];
        }

        $items = [new BreadcrumbItem(self::HOME_LABEL, '/')];
        $prefix = '';

        foreach ($segments as $index => $segment) {
            $prefix .= '/' . $segment;
            $isLast = $index === \count($segments) - 1;

            $items[] = new BreadcrumbItem(
                label: $this->labelFromSegment($segment),
                url: $isLast ? null : $prefix,
                current: $isLast,
            );
        }

        return $items;
    }

    /**
     * @return list<string>
     */
    private function pathSegments(string $pathInfo): array
    {
        $trimmed = trim($pathInfo, '/');
        if ('' === $trimmed) {
            return [];
        }

        return array_values(array_filter(
            explode('/', $trimmed),
            static fn (string $segment): bool => '' !== $segment,
        ));
    }

    private function labelFromSegment(string $segment): string
    {
        $decoded = rawurldecode($segment);

        return ucwords(str_replace(['-', '_'], ' ', $decoded));
    }
}
