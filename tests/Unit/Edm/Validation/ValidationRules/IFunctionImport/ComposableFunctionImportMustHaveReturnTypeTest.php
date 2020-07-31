<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 10:14 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\ComposableFunctionImportMustHaveReturnType;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class ComposableFunctionImportMustHaveReturnTypeTest extends TestCase
{
    public function invokeProvider(): array
    {
        $result = [];
        // first is isComposable, second is isNull
        $result[] = [true, true, 1];
        $result[] = [true, false, 0];
        $result[] = [false, true, 0];
        $result[] = [false, false, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param bool $isComposable
     * @param bool $isNull
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeComposable(bool $isComposable, bool $isNull, int $numErrors)
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
        if ($isNull) {
            $element->shouldReceive('getReturnType')->andReturn(null);
        } else {
            $rType = m::mock(ITypeReference::class);
            $element->shouldReceive('getReturnType')->andReturn($rType);
        }

        $foo = new ComposableFunctionImportMustHaveReturnType();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];
            $errorCode = EdmErrorCode::ComposableFunctionImportMustHaveReturnType();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The composable function import \'name\' must specify a return type.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
