<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 6:41 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class VisitorOfIFunctionReferenceExpressionTest extends TestCase
{
    public function testVisitNullReferencedFunction()
    {
        $expression = m::mock(IFunctionReferenceExpression::class);
        $expression->shouldReceive('getReferencedFunction')->andReturn(null);

        $foo = new VisitorOfIFunctionReferenceExpression();

        $followup = [];
        $reference = [];

        $actual = $foo->visit($expression, $followup, $reference);
        $this->assertEquals(0, count($followup));
        $this->assertEquals(0, count($reference));

        $this->assertEquals(1, count($actual));
    }

    public function testVisitSchemaElementReferencedFunction()
    {
        $ref = m::mock(ISchemaElement::class . ', ' . IFunction::class);

        $expression = m::mock(IFunctionReferenceExpression::class);
        $expression->shouldReceive('getReferencedFunction')->andReturn($ref);

        $foo = new VisitorOfIFunctionReferenceExpression();

        $followup = [];
        $reference = [];

        $actual = $foo->visit($expression, $followup, $reference);
        $this->assertEquals(0, count($followup));
        $this->assertEquals(1, count($reference));

        $this->assertEquals(null, $actual);
    }
}
