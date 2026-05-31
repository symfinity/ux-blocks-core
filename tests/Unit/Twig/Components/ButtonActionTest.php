<?php

declare(strict_types=1);

namespace Symfinity\UxBlocksCore\Tests\Unit\Twig\Components;

use PHPUnit\Framework\Attributes\Test;
use Symfinity\UiAction\ActionIntent;
use Symfinity\UiAction\NativeActionRules;
use Symfinity\UxBlocksCore\Tests\Support\ActionMarkupContextFactory;

final class ButtonActionTest extends ComponentTestCase
{
    private NativeActionRules $rules;

    protected function setUp(): void
    {
        parent::setUp();
        $this->rules = new NativeActionRules();
    }

    #[Test]
    public function navigateAnchorPassesNativeActionRules(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'as' => 'a',
            'href' => '/linked',
        ]);

        self::assertStringNotContainsString('data-ui-action', $html);
        $context = ActionMarkupContextFactory::fromInteractiveHtml($html);
        $result = $this->rules->validate(ActionIntent::Navigate, $context);
        self::assertTrue($result->valid, implode(', ', array_map(static fn ($v) => $v->code, $result->violations)));
    }

    #[Test]
    public function downloadAnchorPassesNativeActionRules(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'as' => 'a',
            'href' => '/ux-blocks-demo/sample.txt',
            'download' => 'symfinity-ux-blocks-sample.txt',
        ]);

        self::assertStringNotContainsString('data-ui-action', $html);
        $context = ActionMarkupContextFactory::fromInteractiveHtml($html);
        $result = $this->rules->validate(ActionIntent::Download, $context);
        self::assertTrue($result->valid);
    }

    #[Test]
    public function submitButtonPassesNativeActionRulesInPostFormContext(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'type' => 'submit',
        ]);

        self::assertStringNotContainsString('data-ui-action', $html);
        $context = ActionMarkupContextFactory::fromInteractiveHtml(
            $html,
            parentIsForm: true,
            formMethod: 'post',
        );
        $result = $this->rules->validate(ActionIntent::Submit, $context);
        self::assertTrue($result->valid);
    }

    #[Test]
    public function deleteSubmitPassesNativeActionRulesInPostFormContext(): void
    {
        self::bootKernel();
        $html = $this->renderComponent('Button', [
            'type' => 'submit',
        ]);

        $context = ActionMarkupContextFactory::fromInteractiveHtml(
            $html,
            parentIsForm: true,
            formMethod: 'post',
            hasCsrfField: true,
        );
        $result = $this->rules->validate(ActionIntent::Delete, $context);
        self::assertTrue($result->valid);
    }
}
