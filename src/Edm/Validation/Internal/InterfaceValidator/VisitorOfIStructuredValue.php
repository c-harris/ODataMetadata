<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStructuredValue;

class VisitorOfIStructuredValue extends VisitorOfT
{
    /**
     * @param IEdmElement $value
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>
     */
    protected function visitT($value, array &$followup, array &$references): iterable
    {
        assert($value instanceof IStructuredValue);
        $errors = [];
        InterfaceValidator::processEnumerable(
            $value,
            $value->getPropertyValues(),
            'PropertyValues',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return IStructuredValue::class;
    }
}
