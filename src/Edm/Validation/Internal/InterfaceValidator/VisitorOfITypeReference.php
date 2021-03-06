<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

final class VisitorOfITypeReference extends VisitorOfT
{
    protected function visitT($type, array &$followup, array &$references): ?iterable
    {
        assert($type instanceof ITypeReference);

        if (null !== $type->getDefinition()) {
            // Transient types, such as collections, rows and entity refs are considered to be owned by the type
            // reference, so they go as followups.
            // Schema types are owned by their model, so they go as references.
            if ($type->getDefinition() instanceof ISchemaType) {
                $references[] = $type->getDefinition();
            } else {
                $followup[] = $type->getDefinition();
            }

            return null;
        } else {
            return [ InterfaceValidator::createPropertyMustNotBeNullError($type, 'Definition')];
        }
    }

    public function forType(): string
    {
        return ITypeReference::class;
    }
}
