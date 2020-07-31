<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 1:21 AM
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Annotations;

use AlgoWeb\ODataMetadata\Enums\EdmVocabularyAnnotationSerializationLocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmValueAnnotation;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmValueAnnotationTest extends TestCase
{
    public function testIsInlineDirect()
    {
        $foo = m::mock(EdmValueAnnotation::class)->makePartial();
        $foo->shouldReceive('getSerializationLocation')
            ->andReturn(EdmVocabularyAnnotationSerializationLocation::Inline());
        $foo->shouldReceive('targetString')->never();

        $model = m::mock(IModel::class);

        $expected = true;
        $actual = $foo->isInline($model);
        $this->assertEquals($expected, $actual);
    }

    public function testIsInlineIndirect()
    {
        $foo = m::mock(EdmValueAnnotation::class)->makePartial();
        $foo->shouldReceive('getSerializationLocation')
            ->andReturn(EdmVocabularyAnnotationSerializationLocation::OutOfLine());
        $foo->shouldReceive('targetString')->andReturn(null);

        $model = m::mock(IModel::class);

        $expected = true;
        $actual = $foo->isInline($model);
        $this->assertEquals($expected, $actual);
    }

    public function testIsInlineNot()
    {
        $foo = m::mock(EdmValueAnnotation::class)->makePartial();
        $foo->shouldReceive('getSerializationLocation')
            ->andReturn(EdmVocabularyAnnotationSerializationLocation::OutOfLine());
        $foo->shouldReceive('targetString')->andReturn('foo');

        $model = m::mock(IModel::class);

        $expected = false;
        $actual = $foo->isInline($model);
        $this->assertEquals($expected, $actual);
    }
}
