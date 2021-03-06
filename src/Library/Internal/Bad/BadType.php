<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Helpers\TypeHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\Concerns\SimpleBaseToString;

class BadType extends BadElement implements IType
{
    use SimpleBaseToString;
    use TypeHelpers;

    public function __construct(iterable $errors)
    {
        parent::__construct($errors);
    }

    /**
     * @return TypeKind gets the kind of this type
     */
    public function getTypeKind(): TypeKind
    {
        return TypeKind::None();
    }
}
