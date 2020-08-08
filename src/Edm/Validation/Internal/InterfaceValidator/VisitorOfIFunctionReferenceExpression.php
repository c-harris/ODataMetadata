<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IFunctionReferenceExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;

class VisitorOfIFunctionReferenceExpression extends VisitorOfT
{
    protected function visitT($expression, array &$followup, array &$references): ?iterable
    {
        assert($expression instanceof IFunctionReferenceExpression);
        $reference = $expression->getReferencedFunction();
        if (null !== $reference) {
            assert(
                $reference instanceof ISchemaElement || $reference instanceof IFunctionImport, /** @phpstan-ignore-line */
                'Return as followup if the referenced object is not a schema function or a function import.'
            );
            $references[] = $reference;
            return null;
        } else {
            return [ InterfaceValidator::createPropertyMustNotBeNullError($expression, 'ReferencedFunction') ];
        }
    }

    public function forType(): string
    {
        return IFunctionReferenceExpression::class;
    }
}
