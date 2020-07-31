<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 6:23 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportParametersCannotHaveModeOfNone;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportParametersCannotHaveModeOfNoneTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullParameters()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getParameters')->andReturn(null);

        $foo = new FunctionImportParametersCannotHaveModeOfNone();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function invokeProvider(): array
    {
        $result = [];
        $result[] = [FunctionParameterMode::None(), true, 0];
        $result[] = [FunctionParameterMode::None(), false, 1];
        $result[] = [FunctionParameterMode::In(), true, 0];
        $result[] = [FunctionParameterMode::In(), false, 0];


        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param FunctionParameterMode $mode
     * @param bool $isBad
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeNonNullParameters(FunctionParameterMode $mode, bool $isBad, int $numErrors)
    {
        $callable = function (IEdmElement $one) use ($isBad): bool {
            return $isBad;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $parm = m::mock(IFunctionParameter::class);
        $parm->shouldReceive('getMode')->andReturn($mode);
        $parm->shouldReceive('location')->andReturn($loc);
        $parm->shouldReceive('getName')->andReturn('parm');

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getParameters')->andReturn([$parm]);
        $element->shouldReceive('getName')->andReturn('import');

        $foo = new FunctionImportParametersCannotHaveModeOfNone();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];

            $errorCode = EdmErrorCode::InvalidFunctionImportParameterMode();
            $this->assertEquals($errorCode, $error->getErrorCode());

            $expected = 'The mode of the parameter \'parm\' in the function import \'import\' is invalid.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
