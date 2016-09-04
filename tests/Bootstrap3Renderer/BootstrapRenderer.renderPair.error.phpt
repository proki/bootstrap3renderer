<?php

namespace InstanteTests\Bootstrap3Renderer;

use Instante\Bootstrap3Renderer\BootstrapRenderer;
use Instante\ExtendedFormMacros\IControlRenderer;
use Nette\Forms\Form;
use Nette\Forms\IControl;
use Nette\InvalidStateException;
use Nette\Utils\Html;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';


$renderer = new BootstrapRenderer;
$renderer->controlRenderers['*'] = $controlRenderer = mock(IControlRenderer::class);
$control = mock(IControl::class);
$controlRenderer->shouldReceive('renderPair')->with($control)->andReturnUsing(function () { return Html::el('div'); });
$control->shouldReceive('getErrors')->andReturnValues([['a'], []]);
$renderer->renderBegin(new Form);

$element = $renderer->renderPair($control);
Assert::contains('has-error', (string)$element);

$element = $renderer->renderPair($control);
Assert::notContains('has-error', (string)$element);
