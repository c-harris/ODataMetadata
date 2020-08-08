<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * !!! children are final classes to prevent any mocking.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
abstract class VisitorOfT
{
    /**
     * @param IEdmElement $item
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>|null
     */
    public function visit($item, array &$followup, array &$references): ?iterable
    {
        assert(is_a($item, $this->forType()));
        return $this->visitT($item, $followup, $references);
    }

    /**
     * @param IEdmElement $item
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>|null
     */
    abstract protected function visitT($item, array &$followup, array &$references): ?iterable;

    abstract public function forType(): string;
}
