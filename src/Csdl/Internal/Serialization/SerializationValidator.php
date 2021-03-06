<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Csdl\Internal\Serialization;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmValidator;
use AlgoWeb\ODataMetadata\Edm\Validation\Internal\ValidationHelper;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationRuleSet;
use AlgoWeb\ODataMetadata\Interfaces\IModel;

abstract class SerializationValidator
{
    private static function getSerializationRuleSet(): ValidationRuleSet
    {
        return new ValidationRuleSet([]);
    }

    /**
     * @param  IModel               $root
     * @throws \ReflectionException
     * @return array
     */
    public static function getSerializationErrors(IModel $root): array
    {
        $errors = [];
        EdmValidator::validate($root, self::getSerializationRuleSet(), $errors);
        $errors = array_filter($errors, [self::class, 'significantToSerialization']);
        return $errors;
    }

    /**
     * @param  EdmError $error
     * @return bool
     */
    private static function significantToSerialization(EdmError $error)
    {
        if (ValidationHelper::isInterfaceCritical($error)) {
            return true;
        }

        switch ($error->getErrorCode()) {
            case EdmErrorCode::InvalidName():
            case EdmErrorCode::NameTooLong():
            case EdmErrorCode::InvalidNamespaceName():
            case EdmErrorCode::SystemNamespaceEncountered():
            case EdmErrorCode::RowTypeMustNotHaveBaseType():
            case EdmErrorCode::ReferencedTypeMustHaveValidName():
            case EdmErrorCode::FunctionImportEntitySetExpressionIsInvalid():
            case EdmErrorCode::FunctionImportParameterIncorrectType():
            case EdmErrorCode::OnlyInputParametersAllowedInFunctions():
            case EdmErrorCode::InvalidFunctionImportParameterMode():
            case EdmErrorCode::TypeMustNotHaveKindOfNone():
            case EdmErrorCode::PrimitiveTypeMustNotHaveKindOfNone():
            case EdmErrorCode::PropertyMustNotHaveKindOfNone():
            case EdmErrorCode::TermMustNotHaveKindOfNone():
            case EdmErrorCode::SchemaElementMustNotHaveKindOfNone():
            case EdmErrorCode::EntityContainerElementMustNotHaveKindOfNone():
            case EdmErrorCode::BinaryValueCannotHaveEmptyValue():
            case EdmErrorCode::EnumMustHaveIntegerUnderlyingType():
            case EdmErrorCode::EnumMemberTypeMustMatchEnumUnderlyingType():
                return true;
        }

        return false;
    }
}
