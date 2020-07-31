<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Expressions;

use AlgoWeb\ODataMetadata\Enums\ExpressionKind;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Library\Expressions\EdmApplyExpression;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmApplyExpressionTest extends TestCase
{
    public function testCreateUsingIFunction()
    {
        $func = m::mock(IFunction::class);

        $foo = new EdmApplyExpression($func);

        $applied = $foo->getAppliedFunction();
        $this->assertTrue($applied instanceof IExpression);
        $this->assertEquals([], $foo->getArguments());
    }

    public function testCreateUsingIExpression()
    {
        $func = m::mock(IExpression::class);

        $foo = new EdmApplyExpression($func);

        $applied = $foo->getAppliedFunction();
        $this->assertTrue($applied instanceof IExpression);
        $this->assertEquals(ExpressionKind::FunctionApplication(), $foo->getExpressionKind());
    }

    public function testCreateUsingNull()
    {
        $func = null;

        $this->expectException(\Error::class);

        $foo = new EdmApplyExpression($func);
    }
}
