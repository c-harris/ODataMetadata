<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IEntitySet;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that if a navigation property is traversed to another entity set, and then the navigation properties
 * partner is traversed, the destination will be the source entity set.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IEntitySet
 */
class EntitySetNavigationMappingMustBeBidirectional extends EntitySetRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $set)
    {
        assert($set instanceof IEntitySet);
        $mappings = $set->getNavigationTargets();
        foreach ($mappings as $mapping) {
            $property = $mapping->getNavigationProperty();

            $opposingTarget = $mapping->getTargetEntitySet()->findNavigationTarget($property->getPartner());

            // If the navigation property is not silent, or if it is silent but is still mapped, it must be mapped correctly.
            if ((
                $opposingTarget != null ||
                $property->getPartner()->declaringEntityType()->findProperty($property->getPartner()->getName()) === $property->getPartner()
            ) &&
                $opposingTarget !== $set) {
                EdmUtil::checkArgumentNull($set->location(), 'set->Location');
                $context->addError(
                    $set->location(),
                    EdmErrorCode::EntitySetNavigationMappingMustBeBidirectional(),
                    StringConst::EdmModel_Validator_Semantic_EntitySetNavigationMappingMustBeBidirectional($set->getContainer()->fullName() . '.' . $set->getName(), $property->getName())
                );
            }
        }
    }
}
