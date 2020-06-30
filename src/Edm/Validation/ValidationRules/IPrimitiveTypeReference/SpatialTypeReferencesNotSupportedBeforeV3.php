<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * References to EDM spatial types are not supported before version 3.0.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveTypeReference
 */
class SpatialTypeReferencesNotSupportedBeforeV3 extends PrimitiveTypeReferenceRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $type)
    {
        assert($type instanceof IPrimitiveTypeReference);
        if ($type->IsSpatial())
        {
            $context->AddError(
                $type->Location(),
                EdmErrorCode::SpatialTypeReferencesNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_SpatialTypeReferencesNotSupportedBeforeV3());
        }    }
}