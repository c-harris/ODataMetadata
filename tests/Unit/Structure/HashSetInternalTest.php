<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Tests\Unit\Structure;

use AlgoWeb\ODataMetadata\Structure\HashSetInternal;
use AlgoWeb\ODataMetadata\Tests\TestCase;

class HashSetInternalTest extends TestCase
{
    public function testConstructNonNull()
    {
        $iterable = ['foo', 'bar'];

        $foo = new HashSetInternal($iterable);
        foreach ($iterable as $val) {
            $this->assertTrue($foo->contains($val));
        }
    }

    public function testConstructNullDefault()
    {
        $foo = new HashSetInternal();
        $this->assertEquals(0, count($foo));
    }
}
