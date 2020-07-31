<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 10:51 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportComposableFunctionImportCannotBeSideEffecting;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportComposableFunctionImportCannotBeSideEffectingTest extends TestCase
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
     * @param bool $isSideEffecting
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeComposable(bool $isComposable, bool $isSideEffecting, int $numErrors)
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
        $element->shouldReceive('isSideEffecting')->andReturn($isSideEffecting);

        $foo = new FunctionImportComposableFunctionImportCannotBeSideEffecting();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];
            $errorCode = EdmErrorCode::ComposableFunctionImportCannotBeSideEffecting();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The function import \'name\' cannot be composable and side-effecting at the same time.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
