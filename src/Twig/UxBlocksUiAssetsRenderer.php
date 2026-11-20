<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Twig;

use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Emits ux-blocks inline CSS once per request for activated tiers.
 *
 * Tier providers are wired in services.yaml (optional cross-package services).
 */
final class UxBlocksUiAssetsRenderer
{
    private const REQUEST_FLAG = '_symfinity_ux_blocks_ui_assets_emitted';

    /** @var list<string> */
    private array $activeTiers = [];

    /**
     * @param array<string, object|null> $tierProviders map tier key → provider with stylesheet()
     * @param list<string>                $alwaysTiers   tiers turned on for every full page
     */
    public function __construct(
        private readonly RequestStack $requestStack,
        private readonly UxBlocksUiAssetsTierResolver $tierResolver,
        private readonly array $tierProviders = [],
        array $alwaysTiers = [],
    ) {
        $this->activeTiers = array_values(array_unique($alwaysTiers));
    }

    public function activateForFragmentId(string $fragmentId): void
    {
        foreach ($this->tierResolver->resolveForFragmentId($fragmentId) as $tier) {
            if (!\in_array($tier, $this->activeTiers, true)) {
                $this->activeTiers[] = $tier;
            }
        }
    }

    public function renderInlineStylesOnce(): string
    {
        if ($this->alreadyRendered() || $this->activeTiers === []) {
            return '';
        }

        $chunks = [];

        foreach ($this->orderedActiveTiers() as $tier) {
            $css = $this->stylesheetForTier($tier);
            if ($css === null || $css === '') {
                continue;
            }

            $chunks[] = \sprintf('<style id="ux-blocks-%s-css">%s</style>', $tier, $css);
        }

        if ($chunks === []) {
            return '';
        }

        $this->markRendered();

        return implode('', $chunks);
    }

    /**
     * @return list<string>
     */
    private function orderedActiveTiers(): array
    {
        $order = ['core', 'form', 'extended', 'interactive', 'marketing', 'ecommerce'];
        $active = array_flip($this->activeTiers);

        return array_values(array_filter(
            $order,
            static fn (string $tier): bool => isset($active[$tier]),
        ));
    }

    private function stylesheetForTier(string $tier): ?string
    {
        $provider = $this->tierProviders[$tier] ?? null;
        if ($provider === null || !method_exists($provider, 'stylesheet')) {
            return null;
        }

        $css = $provider->stylesheet();

        return \is_string($css) ? $css : null;
    }

    private function alreadyRendered(): bool
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request === null) {
            return false;
        }

        return $request->attributes->getBoolean(self::REQUEST_FLAG);
    }

    private function markRendered(): void
    {
        $request = $this->requestStack->getCurrentRequest();
        if ($request !== null) {
            $request->attributes->set(self::REQUEST_FLAG, true);
        }
    }
}
