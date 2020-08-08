<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 1/08/20
 * Time: 1:04 AM.
 */

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Library\Core;

use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Library\Core\EdmCoreModel;
use AlgoWeb\ODataMetadata\Library\Core\EdmValidCoreModelPrimitiveType;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class EdmCoreModelTest extends TestCase
{
    public function testGetPrimitiveTypeExtant()
    {
        $foo = new EdmCoreModel();

        $kind = PrimitiveTypeKind::String();

        $expected = new EdmValidCoreModelPrimitiveType(
            'Edm',
            'String',
            PrimitiveTypeKind::String()
        );
        $actual = $foo->getPrimitiveType($kind);
        $this->assertEquals($expected, $actual);
    }

    public function testGetPrimitiveTypeNonExtant()
    {
        $foo = new EdmCoreModel();

        $kind = PrimitiveTypeKind::None();

        $expected = null;
        $actual   = $foo->getPrimitiveType($kind);
        $this->assertEquals($expected, $actual);
    }
}
