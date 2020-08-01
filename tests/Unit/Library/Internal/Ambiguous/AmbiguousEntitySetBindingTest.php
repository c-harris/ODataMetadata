<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 10:13 PM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Internal\Ambiguous;

use AlgoWeb\ODataMetadata\Enums\ContainerElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainer;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\Library\Internal\Ambiguous\AmbiguousEntitySetBinding;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class AmbiguousEntitySetBindingTest extends TestCase
{
    public function testGetContainer()
    {
        $cont = m::mock(IEntityContainer::class);

        $first = m::mock(IEntitySet::class);
        $first->shouldReceive('getName')->andReturn('first');
        $first->shouldReceive('getContainer')->andReturn($cont)->once();
        $second = m::mock(IEntitySet::class);
        $second->shouldReceive('getContainer')->never();

        $foo = new AmbiguousEntitySetBinding($first, $second);

        $actual = $foo->getContainer();
        $this->assertEquals($cont, $actual);
    }

    public function testGetContainerElementKind()
    {
        $first = m::mock(IEntitySet::class);
        $first->shouldReceive('getName')->andReturn('first');
        $second = m::mock(IEntitySet::class);

        $foo = new AmbiguousEntitySetBinding($first, $second);

        $expected = ContainerElementKind::EntitySet();
        $actual = $foo->getContainerElementKind();

        $this->assertEquals($expected, $actual);
    }

    public function testGetNavigationTargets()
    {
        $first = m::mock(IEntitySet::class);
        $first->shouldReceive('getName')->andReturn('first');
        $second = m::mock(IEntitySet::class);

        $foo = new AmbiguousEntitySetBinding($first, $second);

        $expected = [];
        $actual = $foo->getNavigationTargets();

        $this->assertEquals($expected, $actual);
    }

    public function testFindNavigationTarget()
    {
        $first = m::mock(IEntitySet::class);
        $first->shouldReceive('getName')->andReturn('first');
        $second = m::mock(IEntitySet::class);

        $prop = m::mock(INavigationProperty::class);

        $foo = new AmbiguousEntitySetBinding($first, $second);

        $expected = null;
        $actual = $foo->findNavigationTarget($prop);

        $this->assertEquals($expected, $actual);
    }

    public function testGetElementType()
    {
        $first = m::mock(IEntitySet::class);
        $first->shouldReceive('getName')->andReturn('first');
        $second = m::mock(IEntitySet::class);

        $prop = m::mock(INavigationProperty::class);

        $foo = new AmbiguousEntitySetBinding($first, $second);

        $expected = new BadEntityType('', $foo->getErrors());
        $actual = $foo->getElementType();

        $this->assertEquals($expected, $actual);
    }
}
