<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Interfaces;

use AlgoWeb\ODataMetadata\Helpers\EntityTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\Interfaces\IEntityTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\StructuredTypeHelpers;
use AlgoWeb\ODataMetadata\Helpers\TypeHelpers;

/**
 * Interface IEdmEntityType.
 *
 * Represents a definition of an EDM entity type.
 *
 * @package AlgoWeb\ODataMetadata\MetadataV3\Interfaces
 */
interface IEntityType extends IStructuredType, ISchemaType, ITerm, IEntityTypeHelpers
{
    /**
     * @return array|IStructuralProperty[]|null gets the structural properties of the entity type that make up the entity key
     */
    public function getDeclaredKey(): ?array;
}
