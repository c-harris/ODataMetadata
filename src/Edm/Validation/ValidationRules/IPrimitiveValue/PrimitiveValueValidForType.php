<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveValue;

use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Util\ExpressionTypeChecker;

/**
 * Validates that if a primitive value declares a type, the value is acceptable for the type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IPrimitiveValue
 */
class PrimitiveValueValidForType extends PrimitiveValueRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $value)
    {
        assert($value instanceof IPrimitiveValue);
        if (null !== $value->getType() && !$context->checkIsBad($value) && !$context->checkIsBad($value->getType())) {
            $discoveredErrors = null;
            ExpressionTypeChecker::tryAssertPrimitiveAsType($value, $value->getType(), $discoveredErrors);
            foreach ($discoveredErrors as $error) {
                $context->addRawError($error);
            }
        }
    }
}
