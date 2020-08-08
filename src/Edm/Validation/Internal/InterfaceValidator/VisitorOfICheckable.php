<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

final class VisitorOfICheckable extends VisitorOfT
{
    /**
     * @param  ICheckable $item
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>
     */
    protected function visitT($item, array &$followup, array &$references): iterable
    {
        $checkableErrors = [];
        $errors          = [];
        InterfaceValidator::processEnumerable($item, $item->getErrors(), 'Errors', $checkableErrors, $errors);
        return $errors ?? $checkableErrors;
    }

    public function forType(): string
    {
        return ICheckable::class;
    }
}
