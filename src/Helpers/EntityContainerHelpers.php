<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Interfaces\IEntityContainerElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionImport;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDelayedValue;

/**
 * Trait EntityContainerHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait EntityContainerHelpers
{
    /**
     * Returns entity sets belonging to an IEdmEntityContainer.
     *
     * @return IEntitySet[] entity sets belonging to an IEdmEntityContainer
     */
    public function entitySets(): array
    {
        return array_filter($this->getElements(), function (IEntityContainerElement $item) {
            return $item instanceof IEntitySet;
        });
    }

    /**
     * Returns function imports belonging to an IEdmEntityContainer.
     *
     * @return IFunctionImport[] function imports belonging to an IEdmEntityContainer
     */
    public function functionImports(): array
    {
        return array_filter($this->getElements(), function (IEntityContainerElement $item) {
            return $item instanceof IFunctionImport;
        });
    }

    /**
     * @return IDelayedValue[] gets the values stored in this collection
     */
    abstract public function getElements(): array;
}
