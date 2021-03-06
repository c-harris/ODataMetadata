<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Validates that a row type does not have a base type.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation\ValidationRules\IRowType
 */
class RowTypeBaseTypeMustBeNull extends RowTypeRule
{
    public function __invoke(ValidationContext $context, ?IEdmElement $rowType)
    {
        assert($rowType instanceof IRowType);
        if (null !== $rowType->getBaseType()) {
            EdmUtil::checkArgumentNull($rowType->location(), 'rowType->Location');
            $context->addError(
                $rowType->location(),
                EdmErrorCode::RowTypeMustNotHaveBaseType(),
                StringConst::EdmModel_Validator_Semantic_RowTypeMustNotHaveBaseType()
            );
        }
    }
}
