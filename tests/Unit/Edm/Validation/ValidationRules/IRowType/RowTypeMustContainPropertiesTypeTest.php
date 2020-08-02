<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/08/20
 * Time: 6:26 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IRowType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType\RowTypeMustContainProperties;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class RowTypeMustContainPropertiesTypeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeEmptyProperties()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $loc = m::mock(ILocation::class);

        $element = m::mock(IRowType::class);
        $element->shouldReceive('properties')->andReturn([]);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('fullName')->andReturn('complex');

        $foo = new RowTypeMustContainProperties();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];
        $errorCode = EdmErrorCode::RowTypeMustHaveProperties();
        $this->assertEquals($errorCode, $error->getErrorCode());
        $expected = 'The row type is invalid. A row must contain at least one property.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }

    /**
     * @throws \ReflectionException
     */
    public function testInvokeNonEmptyProperties()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $prop = m::mock(IProperty::class);

        $loc = m::mock(ILocation::class);

        $element = m::mock(IRowType::class);
        $element->shouldReceive('properties')->andReturn([$prop]);
        $element->shouldReceive('location')->andReturn($loc);
        $element->shouldReceive('fullName')->andReturn('complex');

        $foo = new RowTypeMustContainProperties();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(0, count($errors));
    }
}
