<?php

namespace InstanteTests\Bootstrap3Renderer;

use Instante\Bootstrap3Renderer\BootstrapRenderer;
use Instante\Tests\Utils\MockStatic;
use Nette\Bridges\FormsLatte\Runtime;
use Nette\Forms\Form;
use Tester\Assert;

require_once __DIR__ . '/../bootstrap.php';

$form = new Form;

MockStatic::mock(Runtime::class)->shouldReceive('renderFormBegin')->with($form, [])->once()->andReturn('[BEGIN]');

$renderer = new BootstrapRenderer;
Assert::same('[BEGIN]', $renderer->renderBegin($form));
