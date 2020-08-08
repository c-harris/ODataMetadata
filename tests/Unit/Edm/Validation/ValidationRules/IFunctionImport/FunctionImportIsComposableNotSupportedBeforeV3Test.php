<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 11:10 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportIsComposableNotSupportedBeforeV3;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportIsComposableNotSupportedBeforeV3Test extends TestCase
{
    public function invokeProvider(): array
    {
        $result = [];
        // first is isComposable
        $result[] = [true, 1];
        $result[] = [false, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param  bool                 $isComposable
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeComposable(bool $isComposable, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getName')->andReturn('name');
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('isComposable')->andReturn($isComposable);

        $foo = new FunctionImportIsComposableNotSupportedBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::FunctionImportComposableNotSupportedBeforeV3();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The \'Composable\' setting of function imports is not supported before version 3.0.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
