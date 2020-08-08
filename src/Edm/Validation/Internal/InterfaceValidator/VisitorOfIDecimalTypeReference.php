<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;

class VisitorOfIDecimalTypeReference extends VisitorOfT
{
    /**
     * @param $typeRef
     * @param array $followup
     * @param array $references
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
