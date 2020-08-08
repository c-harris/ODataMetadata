<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class VisitorOfIDecimalTypeReference extends VisitorOfT
{
    /**
     * @param IEdmElement $typeRef
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>
     */
    protected function visitT($typeRef, array &$followup, array &$references): iterable
    {
        assert($typeRef instanceof IDecimalTypeReference);
        $primitive = $typeRef->getDefinition();
        assert($primitive instanceof IPrimitiveType);
        return null !== $typeRef->getDefinition() && !$primitive->getPrimitiveKind()->isDecimal()
            ? [ InterfaceValidator::createTypeRefInterfaceTypeKindValueMismatchError($typeRef) ] : null;
    }

    public function forType(): string
    {
        return IDecimalTypeReference::class;
    }
}
