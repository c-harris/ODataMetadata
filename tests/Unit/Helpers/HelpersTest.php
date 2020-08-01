<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 2:22 AM.
 */

namespace AlgoWeb\ODataMetadata\Tests\Unit\Helpers;

use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Helpers\Helpers;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Library\EdmType;
use AlgoWeb\ODataMetadata\Tests\TestCase;
use Mockery as m;

class HelpersTest extends TestCase
{
    public function testAnnotationValueClassMismatch()
    {
        $typeOf   = IModel::class;
        $annotate = m::mock(EdmType::class);

        $this->expectException(InvalidOperationException::class);
        $this->expectExceptionMessage('cannot be interpreted as \'' . IModel::class . '\'');

        Helpers::annotationValue($typeOf, $annotate);
    }

    public function testClassNameToLocalNameQualified()
    {
        $name = 'foo.bar';

        $expected = 'foo_____bar';
        $actual   = Helpers::classNameToLocalName($name);
        $this->assertEquals($expected, $actual);
    }
}
