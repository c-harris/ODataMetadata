<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\Edm\Validation\Internal;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\Edm\Validation\ValidationContext;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IFunction;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\INamedElement;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuralProperty;
use AlgoWeb\ODataMetadata\Interfaces\Values\IStringValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;
use AlgoWeb\ODataMetadata\StringConst;
use Exception;
use SplObjectStorage;
use XMLReader;

abstract class ValidationHelper
{
    public static function IsEdmSystemNamespace(string $namespaceName): bool
    {
        return ($namespaceName == EdmConstants::TransientNamespace ||
        $namespaceName == EdmConstants::EdmNamespace);
    }

    public static function AddMemberNameToHashSet(INamedElement $item, array $memberNameList, ValidationContext $context, EdmErrorCode $errorCode, string $errorString, bool $suppressError)
    {
        $name = $item instanceof ISchemaElement ? $item->FullName() : $item->getName();
        if (!array_key_exists($name, $memberNameList)) {
            $memberNameList[$name] = true;
            if (!$suppressError) {
                $context->AddError($item->Location(), $errorCode, $errorString);
            }

            return false;
        }

        return true;
    }

    /**
     * @param  IStructuralProperty[] $properties
     * @return bool
     */
    public static function AllPropertiesAreNullable(array $properties): bool
    {
        return count(array_filter($properties, function (IStructuralProperty $item) {
            try {
                return $item->getType()->getNullable();
            } catch (\Throwable $e) {
                throw new InvalidOperationException($e->getMessage());
            }
        })) === count($properties);
    }

    /**
     * @param  IStructuralProperty[] $properties
     * @return bool
     */
    public static function HasNullableProperty(array $properties): bool
    {
        return count(array_filter($properties, function (IStructuralProperty $item) {
            try {
                return $item->getType()->getNullable();
            } catch (\Throwable $e) {
                throw new InvalidOperationException($e->getMessage());
            }
        })) > 0;
    }

    /**
     * @param  IStructuralProperty[] $set
     * @param  IStructuralProperty[] $subset
     * @return bool
     */
    public static function PropertySetIsSubset(array $set, array $subset): bool
    {
        return count(array_diff($subset, $set)) === 0;
    }

    /**
     * @param  IStructuralProperty[] $set1
     * @param  IStructuralProperty[] $set2
     * @return bool
     */
    public static function PropertySetsAreEquivalent(array $set1, array $set2): bool
    {
        if (count($set1) != count($set2)) {
            return false;
        }
        for ($i = count($set1) -1; $i > -1; --$i) {
            if ($set1[$i] !== $set2[$i]) {
                return false;
            }
        }
        return true;
    }

    public static function ValidateValueCanBeWrittenAsXmlElementAnnotation(IValue $value, string $annotationNamespace, string $annotationName, EdmError &$error): bool
    {
        if (!($value instanceof IStringValue)) {
            $error = new EdmError($value->Location(), EdmErrorCode::InvalidElementAnnotation(), StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationNotIEdmStringValue());
            return false;
        }

        $rawString = $value->getValue();
        $reader    = new XMLReader();
        $reader->XML($rawString);
        try {
            $eof = true;
            // Skip to root element.
            if ($reader->nodeType != XMLReader::ELEMENT) {
                while ($reader->read() && $reader->nodeType != XMLReader::ELEMENT) {
                    if ($reader->nodeType == XMLReader::ELEMENT) {
                        $eof = false;
                        break;
                    }
                }
            }

            // The annotation must be an element.
            if ($eof) {
                $error = new EdmError($value->Location(), EdmErrorCode::InvalidElementAnnotation(), StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationValueInvalidXml());
                return false;
            }

            // The root element must corespond to the term of the annotation
            $elementNamespace = $reader->namespaceURI;
            $elementName      = $reader->localName;

            if (EdmUtil::IsNullOrWhiteSpaceInternal($elementNamespace) || EdmUtil::IsNullOrWhiteSpaceInternal($elementName)) {
                $error = new EdmError($value->Location(), EdmErrorCode::InvalidElementAnnotation(), StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationNullNamespaceOrName());
                return false;
            }

            if (!(($annotationNamespace == null || $elementNamespace == $annotationNamespace) && ($annotationName == null || $elementName == $annotationName))) {
                $error = new EdmError($value->Location(), EdmErrorCode::InvalidElementAnnotation(), StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationMismatchedTerm());
                return false;
            }

            // Parse the entire fragment to determine if the XML is valid
            /* @noinspection PhpStatementHasEmptyBodyInspection */
            while ($reader->read());


            $error = null;
            return true;
        } catch (Exception $e) {
            $error = new EdmError($value->Location(), EdmErrorCode::InvalidElementAnnotation(), StringConst::EdmModel_Validator_Semantic_InvalidElementAnnotationValueInvalidXml());
            return false;
        }
    }

    public static function IsInterfaceCritical(EdmError $error): bool
    {
        return $error->getErrorCode()->getValue() >= EdmErrorCode::InterfaceCriticalPropertyValueMustNotBeNull()->getValue() && $error->getErrorCode()->getValue() <= EdmErrorCode::InterfaceCriticalCycleInTypeHierarchy()->getValue();
    }

    public static function ItemExistsInReferencedModel(IModel $model, string $fullName, bool $checkEntityContainer): bool
    {
        foreach ($model->getReferencedModels() as $referenced) {
            if ($referenced->findDeclaredType($fullName) != null ||
                    $referenced->findDeclaredValueTerm($fullName) != null ||
                    ($checkEntityContainer && $referenced->findDeclaredEntityContainer($fullName) != null) ||
                    (count($referenced->findDeclaredFunctions($fullName) ?? [])!= 0)) {
                return true;
            }
        }

        return false;
    }

    // Take function name to avoid recomputing it
    public static function FunctionOrNameExistsInReferencedModel(IModel $model, IFunction $function, string $functionFullName, bool $checkEntityContainer): bool
    {
        foreach ($model->getReferencedModels() as $referenced) {
            if ($referenced->findDeclaredType($functionFullName) != null ||
                    $referenced->findDeclaredValueTerm($functionFullName) != null ||
                    ($checkEntityContainer && $referenced->findDeclaredEntityContainer($functionFullName) != null)) {
                return true;
            } else {
                $functionList = $referenced->findDeclaredFunctions($functionFullName) ?? [];
                if (count(array_filter($functionList, [$function, 'IsFunctionSignatureEquivalentTo'])) > 0) {
                    return true;
                }
            }
        }

        return false;
    }

    public static function TypeIndirectlyContainsTarget(IEntityType $source, IEntityType $target, SplObjectStorage $visited, IModel $context): bool
    {
        if (!$visited->offsetExists($source)) {
            $visited->offsetSet($source, true);
            $visited[$source] = true;
            if ($source->IsOrInheritsFrom($target)) {
                return true;
            }

            foreach ($source->NavigationProperties() as $navProp) {
                if ($navProp->containsTarget() && self::TypeIndirectlyContainsTarget($navProp->ToEntityType(), $target, $visited, $context)) {
                    return true;
                }
            }

            foreach ($context->FindAllDerivedTypes($source) as $derived) {
                if ($derived instanceof IEntityType && self::TypeIndirectlyContainsTarget($derived, $target, $visited, $context)) {
                    return true;
                }
            }
        }

        return false;
    }
}
