<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 5:43 PM
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IValueTermReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IValueTerm;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator\VisitorOfIValueTermReferenceExpression;
use Mockery as m;

class VisitorOfIValueTermReferenceExpressionTest extends TestCase
{
    public function visitProvider(): array
    {
        $result = [];
        // first is base null, second is term null, third is num errors, fourth is num followup, fifth is num references
        $result[] = [true, true, 2, 0, 0];
        $result[] = [true, false, 1, 0, 1];
        $result[] = [false, true, 1, 1, 0];
        $result[] = [false, false, 0, 1, 1];

        return $result;
    }

    /**
     * @dataProvider visitProvider
     *
     * @param bool $baseNull
     * @param bool $termNull
     * @param int $numErrors
     * @param int $numFollow
     * @param int $numReference
     */
    public function testVisit(bool $baseNull, bool $termNull, int $numErrors, int $numFollow, int $numReference)
    {
        $expression = m::mock(IValueTermReferenceExpression::class);

        if ($baseNull) {
            $expression->shouldReceive('getBase')->andReturn(null);
        } else {
            $expr = m::mock(IExpression::class);
            $expression->shouldReceive('getBase')->andReturn($expr);
        }
        if ($termNull) {
            $expression->shouldReceive('getTerm')->andReturn(null);
        } else {
            $term = m::mock(IValueTerm::class);
            $expression->shouldReceive('getTerm')->andReturn($term);
        }

        $followup = [];
        $references = [];

        $foo = new VisitorOfIValueTermReferenceExpression();

        $errors = $foo->visit($expression, $followup, $references);
        $this->assertEquals($numErrors, count($errors));
        $this->assertEquals($numFollow, count($followup));
        $this->assertEquals($numReference, count($references));
    }
}
