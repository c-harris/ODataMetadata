<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 10:42 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportBindableFunctionImportMustHaveParameters;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportBindableFunctionImportMustHaveParametersTest extends TestCase
{
    public function invokeProvider(): array
    {
        $result = [];
        // first is isBindable, second is isEmpty
        $result[] = [true, true, 1];
        $result[] = [true, false, 0];
        $result[] = [false, true, 0];
        $result[] = [false, false, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param bool $isBindable
     * @param bool $isEmpty
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeBindable(bool $isBindable, bool $isEmpty, int $numErrors)
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
        $element->shouldReceive('isBindable')->andReturn($isBindable);
        if ($isEmpty) {
            $element->shouldReceive('getParameters')->andReturn([]);
        } else {
            $parm = m::mock(IFunctionParameter::class);
            $element->shouldReceive('getParameters')->andReturn([$parm]);
        }

        $foo = new FunctionImportBindableFunctionImportMustHaveParameters();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];
            $errorCode = EdmErrorCode::BindableFunctionImportMustHaveParameters();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The bindable function import \'name\' must have at least one parameter.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}