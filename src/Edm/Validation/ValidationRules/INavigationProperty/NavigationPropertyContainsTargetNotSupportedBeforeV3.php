<?php


namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty;

use AlgoWeb\ODataMetadata\CsdlConstants;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\INavigationProperty;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that INavigationProperty::getContainsTarget() is not set prior to V3.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\INavigationProperty
 */
class NavigationPropertyContainsTargetNotSupportedBeforeV3 extends NavigationPropertyRule
{

    public function __invoke(ValidationContext $context, ?IEdmElement $property)
    {
        assert($property instanceof INavigationProperty);
        if ($property->containsTarget() != CsdlConstants::Default_ContainsTarget)
        {
            $context->AddError(
                $property->Location(),
                EdmErrorCode::NavigationPropertyContainsTargetNotSupportedBeforeV3(),
                StringConst::EdmModel_Validator_Semantic_NavigationPropertyContainsTargetNotSupportedBeforeV3()
            );
        }
    }
}