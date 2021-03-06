<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IType;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRule;
use AlgoWeb\ODataMetadata\Interfaces\IType;

abstract class TypeRule extends ValidationRule
{
    public function getValidatedType(): string
    {
        return IType::class;
    }
}
