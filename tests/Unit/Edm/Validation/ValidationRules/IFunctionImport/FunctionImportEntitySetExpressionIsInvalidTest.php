<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 31/07/20
 * Time: 3:06 PM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IFunctionImport;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IFunctionImport\FunctionImportEntitySetExpressionIsInvalid;
use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class FunctionImportEntitySetExpressionIsInvalidTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeNullEntitySet()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getEntitySet')->andReturn(null);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new FunctionImportEntitySetExpressionIsInvalid();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }

    public function invokeProvider(): array
    {
        $result   = [];
        $result[] = [ExpressionKind::None(), false, false, 1];
        $result[] = [ExpressionKind::EntitySetReference(), false, false, 1];
        $result[] = [ExpressionKind::EntitySetReference(), false, true, 0];
        $result[] = [ExpressionKind::EntitySetReference(), true, false, 0];
        $result[] = [ExpressionKind::EntitySetReference(), true, true, 0];
        $result[] = [ExpressionKind::Path(), false, false, 1];
        $result[] = [ExpressionKind::Path(), false, true, 0];
        $result[] = [ExpressionKind::Path(), true, false, 0];
        $result[] = [ExpressionKind::Path(), true, true, 0];

        return $result;
    }

    /**
     * @dataProvider invokeProvider
     *
     * @param  ExpressionKind       $kind
     * @param  bool                 $getStatic
     * @param  bool                 $getRelative
     * @param  int                  $numErrors
     * @throws \ReflectionException
     */
    public function testInvokeNonNullEntitySet(ExpressionKind $kind, bool $getStatic, bool $getRelative, int $numErrors)
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $entitySet = m::mock(IExpression::class);
        $entitySet->shouldReceive('getExpressionKind')->andReturn($kind);

        $element = m::mock(IFunctionImport::class);
        $element->shouldReceive('getEntitySet')->andReturn($entitySet);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('tryGetStaticEntitySet')->andReturn($getStatic);
        $element->shouldReceive('tryGetRelativeEntitySetPath')->andReturn($getRelative);
        $element->shouldReceive('getName')->andReturn('funcImport');

        $foo = new FunctionImportEntitySetExpressionIsInvalid();

        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals($numErrors, count($errors));
    }
}
