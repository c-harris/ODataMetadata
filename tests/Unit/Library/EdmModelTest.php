<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 12:18 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library;

use AlgoWeb\ODataMetadata\Enums\SchemaElementKind;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Library\EdmModel;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class EdmModelTest extends TestCase
{
    public function testFindDeclaredFunctionNotExists()
    {
        $foo = new EdmModel();

        $name = 'func';

        $expected = [];
        $actual   = $foo->findDeclaredFunctions($name);
        $this->assertEquals($expected, $actual);
    }

    public function testFindDeclaredFunctionExistsSingleton()
    {
        $foo = new EdmModel();

        $name    = 'func';
        $element = m::mock(ISchemaElement::class . ', ' . IFunction::class);
        $element->shouldReceive('fullName')->andReturn($name);
        $element->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::Function());

        $foo->addElement($element);

        $expected = [$element];
        $actual   = $foo->findDeclaredFunctions($name);
        $this->assertEquals($expected, $actual);
    }

    public function testFindDeclaredFunctionExistsDoubleton()
    {
        $foo = new EdmModel();

        $name    = 'func';
        $element = m::mock(ISchemaElement::class . ', ' . IFunction::class);
        $element->shouldReceive('fullName')->andReturn($name);
        $element->shouldReceive('getSchemaElementKind')->andReturn(SchemaElementKind::Function());

        $foo->addElement($element);
        $foo->addElement($element);

        $expected = [$element, $element];
        $actual   = $foo->findDeclaredFunctions($name);
        $this->assertEquals($expected, $actual);
    }
}
