<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

/**
 * The general shape of a validation visitor is
 *      Visit(IXYZInterface $item, array $followup, array $references): EdmError[]
 * Each visitor may return a null or empty collection of errors.
 * Note that if a visitor returns errors, followup and references will be ignored.
 * @package AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator
 */
abstract class VisitorBase
{
    /**
     * @param IEdmElement $item
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>
     */
    abstract public function visit($item, array &$followup, array &$references): iterable;
}
