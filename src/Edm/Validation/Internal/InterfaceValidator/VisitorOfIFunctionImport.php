<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;

class VisitorOfIFunctionImport extends VisitorOfT
{
    protected function visitT($functionImport, array &$followup, array &$references): ?iterable
    {
        assert($functionImport instanceof IFunctionImport);
        if (null !== $functionImport->getEntitySet()) {
            $followup[] = $functionImport->getEntitySet();
        }

        return null;
    }

    public function forType(): string
    {
        return IFunctionImport::class;
    }
}
