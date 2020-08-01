<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 7:10 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Enums\FunctionParameterMode;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportReturnEntitiesButDoesNotSpecifyEntitySetTest extends TestCase
{
    public function nullProvider(): array
    {
        $result = [];
        // first is null return type, second is null entity set
        $result[] = [true, true];
        $result[] = [true, false];
        $result[] = [false, false];

        return $result;
    }

    /**
     * @dataProvider nullProvider
     *
     * @param  bool                 $returnNull
     * @param  bool                 $entityNull
     * @throws \ReflectionException
     */
    public function testInvokeBypass(bool $returnNull, bool $entityNull)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('location')->never();
        if ($returnNull) {
            $element->shouldReceive('getReturnType')->andReturn(null);
        } else {
            $rType = m::mock(ITypeReference::class);
            $element->shouldReceive('getReturnType')->andReturn($rType);
        }
        if ($entityNull) {
            $element->shouldReceive('getEntitySet')->andReturn(null);
        } else {
            $expr = m::mock(IExpression::class);
            $element->shouldReceive('getEntitySet')->andReturn($expr);
        }

        $foo = new FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet();

        $foo->__invoke($context, $element);

        $this->assertEquals(0, count($context->getErrors()));
    }

    public function invokeProvider(): array
    {
        $result = [];
        // first is collection, second is entity, third is bad
        $result[] = [true, true, true, 0];
        $result[] = [true, true, false, 1];
        $result[] = [true, false, true, 0];
        $result[] = [true, false, false, 0];
        $result[] = [false, true, true, 0];
        $result[] = [false, true, false, 1];
        $result[] = [false, false, true, 0];
        $result[] = [false, false, false, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param  bool                 $isCollection
     * @param  bool                 $isEntity
     * @param  bool                 $isBad
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeNonBypass(bool $isCollection, bool $isEntity, bool $isBad, int $numErrors)
    {
        $callable = function (IEdmElement $one) use ($isBad): bool {
            return $isBad;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $def = m::mock(IType::class);

        $rType = m::mock(ITypeReference::class);
        $rType->shouldReceive('isCollection')->andReturn($isCollection);
        $rType->shouldReceive('isEntity')->andReturn($isEntity);
        $rType->shouldReceive('asCollection->elementType')->andReturn($rType);
        $rType->shouldReceive('getDefinition')->andReturn($def);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('getEntitySet')->andReturn(null);
        $element->shouldReceive('getReturnType')->andReturn($rType);
        $element->shouldReceive('getName')->andReturn('funcImport');

        $foo = new FunctionImportReturnEntitiesButDoesNotSpecifyEntitySet();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
        if (1 === $numErrors) {
            $error     = $errors[0];
            $errorCode = EdmErrorCode::FunctionImportReturnsEntitiesButDoesNotSpecifyEntitySet();
            $this->assertEquals($errorCode, $error->getErrorCode());
            $expected = 'The function import \'funcImport\' returns entities but does not specify an entity set.';
            $this->assertEquals($expected, $error->getErrorMessage());
        }
    }
}
