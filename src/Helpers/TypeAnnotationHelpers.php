<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\Annotations\IPropertyValueBinding;
use AlgoWeb\ODataMetadata\Interfaces\IProperty;

/**
 * Trait TypeAnnotationHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait TypeAnnotationHelpers
{
    /**
     * Gets the binding of a property of the type term of a type annotation.
     *
     * @param  IProperty|string           $property property (Or Property Name) to search for
     * @return IPropertyValueBinding|null the binding of the property in the type annotation, or null if no binding
     *                                             exists
     */
    public function findPropertyBinding($property): ?IPropertyValueBinding
    {
        assert(
            $property instanceof IProperty || is_string($property), /** @phpstan-ignore-line */
            'The property to search for must either be a string representing the name or IProperty' .
            ' representing the property'
        );
        /** @var string $nuProperty */
        $nuProperty = $property instanceof IProperty ? $property->getName() : $property;
        foreach ($this->getPropertyValueBindings() as $propertyBinding) {
            $prop = $propertyBinding->getBoundProperty();
            if ($prop->getName() == $nuProperty) {
                return $propertyBinding;
            }
        }
        return null;
    }

    /**
     * @return IPropertyValueBinding[] gets the value annotations for the properties of the type
     */
    abstract public function getPropertyValueBindings(): array;
}
