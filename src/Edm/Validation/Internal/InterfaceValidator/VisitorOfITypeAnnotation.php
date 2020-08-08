<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\InterfaceValidator;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\ITypeAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\Expressions\IExpression;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;

class VisitorOfITypeAnnotation extends VisitorOfT
{
    /**
     * @param IEdmElement $annotation
     * @param IExpression[] $followup
     * @param ITypeReference[] $references
     * @return iterable<EdmError>
     */
    protected function visitT($annotation, array &$followup, array &$references): iterable
    {
        assert($annotation instanceof ITypeAnnotation);
        $errors = [];
        InterfaceValidator::processEnumerable(
            $annotation,
            $annotation->getPropertyValueBindings(),
            'PropertyValueBindings',
            $followup,
            $errors
        );
        return $errors;
    }

    public function forType(): string
    {
        return ITypeAnnotation::class;
    }
}
