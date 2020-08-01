<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 10:48 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportUnsupportedReturnTypeV1;
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

class FunctionImportUnsupportedReturnTypeV1TypeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullReturnType()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getReturnType')->andReturn(null);

        $foo = new FunctionImportUnsupportedReturnTypeV1();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function invokeProvider(): array
    {
        $result   = [];
        $result[] = [true, true, null, 0];
        $result[] = [true, false, null, 1];
        $result[] = [true, true, 'isPrimitive', 0];
        $result[] = [true, false, 'isPrimitive', 0];
        $result[] = [true, true, 'isEntity', 0];
        $result[] = [true, false, 'isEntity', 0];
        $result[] = [false, true, null, 0];
        $result[] = [false, false, null, 1];


        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param  bool                 $isCollection
     * @param  bool                 $isBad
     * @param  string               $isTrue
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeWithNonNullReturnType(bool $isCollection, bool $isBad, ?string $isTrue, int $numErrors)
    {
        $callable = function (IEdmElement $one) use ($isBad): bool {
            return $isBad;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $methods = ['isPrimitive' => false, 'isEntity' => false, 'isComplex' => false, 'isEnum' => false,
            'isString' => false];
        if (null !== $isTrue) {
            $methods[$isTrue] = true;
        }

        $iType = m::mock(IType::class);

        $rType = m::mock(ITypeReference::class);
        $rType->shouldReceive('isCollection')->andReturn($isCollection);
        $rType->shouldReceive($methods);
        if ($isCollection) {
            $rType->shouldReceive('asCollection->elementType')->andReturn($rType);
        }
        $rType->shouldReceive('getDefinition')->andReturn($iType);

        $loc = m::mock(ILocation::class);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getReturnType')->andReturn($rType);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getName')->andReturn('TNMN');

        $foo = new FunctionImportUnsupportedReturnTypeV1();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::FunctionImportUnsupportedReturnType();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The return type is not valid in function import \'TNMN\'. In version 1.0 a function import' .
                        ' can have no return type or return a collection of scalar values or a collection of entities.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
