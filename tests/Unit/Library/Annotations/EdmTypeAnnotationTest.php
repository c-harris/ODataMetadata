<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 1:38 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Annotations;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;
use AlgoWeb\ODataMetadata\Interfaces\ITerm;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmTypeAnnotation;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmTypeAnnotationTest extends TestCase
{
    public function testFindPropertyBindingByIPropertyPresent()
    {
        $targ = m::mock(IVocabularyAnnotatable::class);
        $term = m::mock(ITerm::class);
        $qualifier = null;

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('prop');

        $binding = m::mock(IPropertyValueBinding::class);
        $binding->shouldReceive('getBoundProperty')->andReturn($prop);

        $foo = new EdmTypeAnnotation($targ, $term, $qualifier, $binding);

        $actual = $foo->findPropertyBinding($prop);
        $this->assertEquals($binding, $actual);
    }

    public function testFindPropertyBindingByName()
    {
        $targ = m::mock(IVocabularyAnnotatable::class);
        $term = m::mock(ITerm::class);
        $qualifier = null;

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('prop');

        $binding = m::mock(IPropertyValueBinding::class);
        $binding->shouldReceive('getBoundProperty')->andReturn($prop);

        $foo = new EdmTypeAnnotation($targ, $term, $qualifier, $binding);

        $actual = $foo->findPropertyBinding($prop->getName());
        $this->assertEquals($binding, $actual);
    }

    public function testFindPropertyBindingByNameNonExtant()
    {
        $targ = m::mock(IVocabularyAnnotatable::class);
        $term = m::mock(ITerm::class);
        $qualifier = null;

        $prop = m::mock(IProperty::class);
        $prop->shouldReceive('getName')->andReturn('prop');

        $binding = m::mock(IPropertyValueBinding::class);
        $binding->shouldReceive('getBoundProperty')->andReturn($prop);

        $foo = new EdmTypeAnnotation($targ, $term, $qualifier, $binding);

        $actual = $foo->findPropertyBinding('foobar');
        $this->assertEquals(null, $actual);
    }
}
