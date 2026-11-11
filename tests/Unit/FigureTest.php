<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UxBlocksCore\Tests\Unit\Twig\Components\ComponentTestCase;

final class FigureTest extends ComponentTestCase
{
    #[Test]
    public function emptyCaptionOmitsFigcaption(): void
    {
        self::bootKernel();
        $media = (string) $this->renderTwigComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Decorative',
        ]);
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'media' => $media,
        ]);

        self::assertStringContainsString('<figure', $html);
        self::assertStringContainsString('data-ui-role="figure"', $html);
        self::assertStringNotContainsString('<figcaption', $html);
        self::assertStringNotContainsString('figure-caption', $html);
    }

    #[Test]
    public function alignStartSetsDataUiAlign(): void
    {
        self::bootKernel();
        $media = (string) $this->renderTwigComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Example',
        ]);
        $html = (string) $this->renderTwigComponent('Figure', [
            'align' => 'start',
        ], blocks: [
            'media' => $media,
        ]);

        self::assertStringContainsString('data-ui-align="start"', $html);
    }

    #[Test]
    public function alignCenterSetsDataUiAlign(): void
    {
        self::bootKernel();
        $media = (string) $this->renderTwigComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Example',
        ]);
        $html = (string) $this->renderTwigComponent('Figure', [
            'align' => 'center',
        ], blocks: [
            'media' => $media,
        ]);

        self::assertStringContainsString('data-ui-align="center"', $html);
    }

    #[Test]
    public function captionSlotRendersInsideFigureCaptionRole(): void
    {
        self::bootKernel();
        $media = (string) $this->renderTwigComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Example',
        ]);
        $caption = (string) $this->renderTwigComponent('Typography', [
            'variant' => 'p',
        ], content: 'Figure caption copy');
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'media' => $media,
            'caption' => $caption,
        ]);

        self::assertStringContainsString('<figcaption data-ui-role="figure-caption">', $html);
        self::assertStringContainsString('Figure caption copy', $html);
        self::assertStringContainsString('data-ui-role="image"', $html);
        self::assertRootAttributes($html, 'figure', 'blocks.figure');
    }

    #[Test]
    public function quoteSlotRendersFigureQuoteRole(): void
    {
        self::bootKernel();
        $quote = (string) $this->renderTwigComponent('Typography', [
            'variant' => 'p',
        ], content: 'A shared quote');
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'quote' => $quote,
        ]);

        self::assertStringContainsString('<blockquote data-ui-role="figure-quote">', $html);
        self::assertStringContainsString('A shared quote', $html);
    }

    #[Test]
    public function emptyQuoteOmitsBlockquote(): void
    {
        self::bootKernel();
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'quote' => '   ',
        ]);

        self::assertStringNotContainsString('<blockquote', $html);
        self::assertStringNotContainsString('figure-quote', $html);
    }

    #[Test]
    public function mediaQuoteAndCaptionRenderTogether(): void
    {
        self::bootKernel();
        $media = (string) $this->renderTwigComponent('Image', [
            'src' => 'https://example.test/photo.jpg',
            'alt' => 'Example',
        ]);
        $quote = (string) $this->renderTwigComponent('Typography', [
            'variant' => 'p',
        ], content: 'Quoted line');
        $caption = (string) $this->renderTwigComponent('Typography', [
            'variant' => 'p',
        ], content: 'Figure caption copy');
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'media' => $media,
            'quote' => $quote,
            'caption' => $caption,
        ]);

        $mediaAt = strpos($html, 'data-ui-role="image"');
        $quoteAt = strpos($html, 'data-ui-role="figure-quote"');
        $captionAt = strpos($html, 'data-ui-role="figure-caption"');

        self::assertNotFalse($mediaAt);
        self::assertNotFalse($quoteAt);
        self::assertNotFalse($captionAt);
        self::assertLessThan($quoteAt, $mediaAt);
        self::assertLessThan($captionAt, $quoteAt);
        self::assertStringContainsString('Quoted line', $html);
        self::assertStringContainsString('Figure caption copy', $html);
    }

    #[Test]
    public function emptyCaptionStillOmitsFigcaptionWhenQuoteIsPresent(): void
    {
        self::bootKernel();
        $quote = (string) $this->renderTwigComponent('Typography', [
            'variant' => 'p',
        ], content: 'Quoted line');
        $html = (string) $this->renderTwigComponent('Figure', [], blocks: [
            'quote' => $quote,
            'caption' => '   ',
        ]);

        self::assertStringContainsString('data-ui-role="figure-quote"', $html);
        self::assertStringNotContainsString('<figcaption', $html);
    }
}
