<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 2/08/20
 * Time: 5:21 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\ValidationRules\IEntityContainer;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\ICollectionExpression\CollectionExpressionAllElementsCorrectType;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\ICollectionExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class CollectionExpressionAllElementsCorrectTypeTest extends TestCase
{
    /**
     * @throws \ReflectionException
     */
    public function testInvokeAllElementsCorrect()
    {
        $callable = function (IEdmElement $one): bool {
            return false;
        };
        $model = m::mock(IModel::class);

        $context = new ValidationContext($model, $callable);

        $typeRef = m::mock(ITypeReference::class);
        $typeRef->shouldReceive('isCollection')->andReturn(false);

        $loc = m::mock(ILocation::class);

        $element = m::mock(ICollectionExpression::class);
        $element->shouldReceive('getDeclaredType')->andReturn($typeRef);
        $element->shouldReceive('location')->andReturn($loc);

        $foo = new CollectionExpressionAllElementsCorrectType();
        $foo->__invoke($context, $element);

        $errors = $context->getErrors();
        $this->assertEquals(1, count($errors));
        $error = $errors[0];
        $errorCode = EdmErrorCode::CollectionExpressionNotValidForNonCollectionType();
        $this->assertEquals($errorCode, $error->getErrorCode());

        $expected = 'A collection expression is incompatible with a non-collection type.';
        $this->assertEquals($expected, $error->getErrorMessage());
    }
}
