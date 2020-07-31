<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 2:28 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportParametersIncorrectTypeBeforeV3;
use AlgoWeb\ODataMetadata\Exception\ArgumentNullException;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportParametersIncorrectTypeBeforeV3Test extends TestCase
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

        $foo = new FunctionImportParametersIncorrectTypeBeforeV3();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function invokeProvider(): array
    {
        $result = [];
        $result[] = [true, true, null, 0];
        $result[] = [true, true, 'isPrimitive', 0];
        $result[] = [true, true, 'isComplex', 0];
        $result[] = [true, false, null, 0];
        $result[] = [true, false, 'isPrimitive', 0];
        $result[] = [true, false, 'isComplex', 0];
        $result[] = [false, true, null, 0];
        $result[] = [false, true, 'isPrimitive', 0];
        $result[] = [false, true, 'isComplex', 0];
        $result[] = [false, false, null, 1];
        $result[] = [false, false, 'isPrimitive', 0];
        $result[] = [false, false, 'isComplex', 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param bool $isNull
     * @param bool $isBad
     * @param string|null $isTrue
     * @param int $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeWithNonNullParms(bool $isNull, bool $isBad, ?string $isTrue, int $numErrors)
    {
        $callable = function (IEdmElement $one) use ($isBad): bool {
            return $isBad;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $methods = ['isPrimitive' => false, 'isComplex' => false, 'isString' => false];
        if (null !== $isTrue) {
            $methods[$isTrue] = true;
        }

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('fullName')->andReturn('fullName');
        $typeRef->shouldReceive($methods);
        if ($isNull) {
            $typeRef->shouldReceive('getDefinition')->andReturn(null);
        } else {
            $def = m::mock(IType::class);
            $typeRef->shouldReceive('getDefinition')->andReturn($def);
        }

        $loc = m::mock(ILocation::class);

        $parm = m::mock(IFunctionParameter::class);
        $parm->shouldReceive('getType')->andReturn($typeRef);
        $parm->shouldReceive('location')->andReturn($loc);
        $parm->shouldReceive('getName')->andReturn('funcParm');

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('TNMN');
        $element->shouldReceive('getParameters')->andReturn([$parm]);

        $foo = new FunctionImportParametersIncorrectTypeBeforeV3();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error = $errors[0];
            $errorCode = EdmErrorCode::FunctionImportParameterIncorrectType();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The type \'fullName\' of parameter \'funcParm\' is invalid. A function import parameter'.
                        ' must be one of the following types: A simple type or complex type.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
