<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Helpers;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Edm\Validation\EdmErrorCode;
use AlgoWeb\ODataMetadata\EdmConstants;
use AlgoWeb\ODataMetadata\EdmUtil;
use AlgoWeb\ODataMetadata\Enums\PrimitiveTypeKind;
use AlgoWeb\ODataMetadata\Enums\TypeKind;
use AlgoWeb\ODataMetadata\Interfaces\IBinaryTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ICheckable;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionType;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IComplexType;
use AlgoWeb\ODataMetadata\Interfaces\IComplexTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IDecimalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEntityType;
use AlgoWeb\ODataMetadata\Interfaces\IEntityTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\IEnumTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveType;
use AlgoWeb\ODataMetadata\Interfaces\IPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IRowType;
use AlgoWeb\ODataMetadata\Interfaces\IRowTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\ISpatialTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStringTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\ITemporalTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\IType;
use AlgoWeb\ODataMetadata\Interfaces\ITypeReference;
use AlgoWeb\ODataMetadata\Library\EdmCollectionTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmComplexTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmEntityReferenceTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmEntityTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmEnumTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\EdmRowTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadBinaryTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadCollectionType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadComplexTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadDecimalTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityReferenceType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEntityTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadEnumType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadPrimitiveTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadRowType;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadSpatialTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadStringTypeReference;
use AlgoWeb\ODataMetadata\Library\Internal\Bad\BadTemporalTypeReference;
use AlgoWeb\ODataMetadata\StringConst;

/**
 * Class TypeReferenceHelpers.
 * @package AlgoWeb\ODataMetadata\Helpers
 */
trait TypeReferenceHelpers
{
    /**
     * Gets the type kind of the type references definition.
     *
     * @return TypeKind the type kind of the reference
     */
    public function typeKind(): TypeKind
    {
        $typeDefinition = $this->getDefinition();
        return $typeDefinition !== null ? $typeDefinition->getTypeKind() : TypeKind::None();
    }

    /**
     * Gets the full name of the definition referred to by the type reference.
     *
     * @return string|null the full name of this references definition
     */
    public function fullName(): ?string
    {
        $namedDefinition = $this->getDefinition();
        return $namedDefinition instanceof ISchemaElement ? $namedDefinition->fullName() : null;
    }

    /**
     * Returns the primitive kind of the definition of this reference.
     *
     * @return PrimitiveTypeKind the primitive kind of the definition of this reference
     */
    public function primitiveKind(): PrimitiveTypeKind
    {
        $typeDefinition = $this->getDefinition();
        if (null === $typeDefinition || !$typeDefinition->getTypeKind()->isPrimitive()) {
            return PrimitiveTypeKind::None();
        }
        assert($typeDefinition instanceof IPrimitiveType);
        return $typeDefinition->getPrimitiveKind();
    }

    /**
     * Returns true if this reference refers to a collection.
     *
     * @return bool this reference refers to a collection
     */
    public function isCollection(): bool
    {
        return $this->typeKind()->isCollection();
    }

    /**
     * Returns true if this reference refers to an entity type.
     *
     * @return bool this reference refers to an entity type
     */
    public function isEntity(): bool
    {
        return $this->typeKind()->isEntity();
    }

    /**
     * Returns true if this reference refers to an entity type.
     *
     * @return bool This reference refers to an entity type.<
     */
    public function isEntityReference(): bool
    {
        return $this->typeKind()->isEntityReference();
    }

    /**
     * Returns true if this reference refers to a complex type.
     *
     * @return bool this reference refers to a complex type
     */
    public function isComplex(): bool
    {
        return $this->typeKind()->isComplex();
    }

    /**
     * Returns true if this reference refers to an enumeration type.
     *
     * @return bool this reference refers to an enumeration type
     */
    public function isEnum(): bool
    {
        return $this->typeKind()->isEnum();
    }

    /**
     * Returns true if this reference refers to a row type.
     *
     * @return bool this reference refers to a row type
     */
    public function isRow(): bool
    {
        return $this->typeKind()->isRow();
    }

    /**
     * Returns true if this reference refers to a structured type.
     *
     * @return bool this reference refers to a structured type
     */
    public function isStructured(): bool
    {
        return $this->typeKind()->IsStructured();
        /*switch ($this->TypeKind()) {
            case TypeKind::Entity():
            case TypeKind::Complex():
            case TypeKind::Row():
                return true;
        }
        return false;*/
    }

    /**
     * Returns true if this reference refers to a primitive type.
     *
     * @return bool this reference refers to a primitive type
     */
    public function isPrimitive(): bool
    {
        return $this->typeKind()->isPrimitive();
    }
    /**
     * Returns true if this reference refers to a binary type.
     *
     * @return bool this reference refers to a binary type
     */
    public function isBinary(): bool
    {
        return $this->primitiveKind()->isBinary();
    }
    /**
     * Returns true if this reference refers to a boolean type.
     *
     * @return bool this reference refers to a boolean type
     */
    public function isBoolean(): bool
    {
        return $this->primitiveKind()->equals(PrimitiveTypeKind::Boolean());
    }

    /**
     * Returns true if this reference refers to a temporal type.
     *
     * @return bool this reference refers to a temporal type
     */
    public function isTemporal(): bool
    {
        return $this->primitiveKind()->isTemporal();
    }
    /**
     * Returns true if this reference refers to a DateTime type.
     *
     * @return bool this reference refers to a DateTime type
     */
    public function isDateTime(): bool
    {
        return $this->primitiveKind()->isDateTime();
    }

    /**
     * Returns true if this reference refers to a time type.
     *
     * @return bool this reference refers to a time type
     */
    public function isTime(): bool
    {
        return $this->primitiveKind()->isTime();
    }

    /**
     * Returns true if this reference refers to a DateTimeOffset type.
     *
     * @return bool this reference refers to a DateTimeOffset type
     */
    public function isDateTimeOffset(): bool
    {
        return $this->primitiveKind()->isDateTimeOffset();
    }

    /**
     * Returns true if this reference refers to a decimal type.
     *
     * @return bool this reference refers to a decimal type
     */
    public function isDecimal(): bool
    {
        return $this->primitiveKind()->isDecimal();
    }

    /**
     * Returns true if this reference refers to a floating type.
     *
     * @return bool this reference refers to a floating type
     */
    public function isFloating(): bool
    {
        return $this->primitiveKind()->isAnyOf(
            PrimitiveTypeKind::Double(),
            PrimitiveTypeKind::Single()
        );
    }
    /**
     * Returns true if this reference refers to a single type.
     *
     * @return bool this reference refers to a single type
     */
    public function isSingle(): bool
    {
        return $this->primitiveKind()->isSingle();
    }
    /**
     * Returns true if this reference refers to a double type.
     *
     * @return bool this reference refers to a double type
     */
    public function isDouble(): bool
    {
        return $this->primitiveKind()->isDouble();
    }

    /**
     * Returns true if this reference refers to a GUID type.
     *
     * @return bool this reference refers to a GUID type
     */
    public function isGuid(): bool
    {
        return $this->primitiveKind()->isGuid();
    }

    /**
     * Returns true if this reference refers to a signed integral type.
     *
     * @return bool this reference refers to a signed integral type
     */
    public function isSignedIntegral(): bool
    {
        return $this->primitiveKind()->isSignedIntegral();
    }

    /**
     * Returns true if this reference refers to a SByte type.
     *
     * @return bool this reference refers to a SByte type
     */
    public function isSByte(): bool
    {
        return $this->primitiveKind()->isSByte();
    }


    /**
     * Returns true if this reference refers to a Int16 type.
     *
     * @return bool this reference refers to a Int16 type
     */
    public function isInt16(): bool
    {
        return $this->primitiveKind()->isInt16();
    }
    /**
     * Returns true if this reference refers to a Int32 type.
     *
     * @return bool this reference refers to a Int32 type
     */
    public function isInt32(): bool
    {
        return $this->primitiveKind()->isInt32();
    }

    /**
     * Returns true if this reference refers to a Int64 type.
     *
     * @return bool this reference refers to a Int64 type
     */
    public function isInt64(): bool
    {
        return $this->primitiveKind()->isInt64();
    }

    /**
     * Returns true if this reference refers to an integer type.
     *
     * @return bool this reference refers to an integer type
     */
    public function isIntegral(): bool
    {
        return $this->primitiveKind()->isIntegral();
    }

    /**
     * Returns true if this reference refers to a byte type.
     *
     * @return bool this reference refers to a byte type
     */
    public function isByte(): bool
    {
        return $this->primitiveKind()->isByte();
    }
    /**
     * Returns true if this reference refers to a string type.
     *
     * @return bool this reference refers to a string type
     */
    public function isString(): bool
    {
        return $this->primitiveKind()->isString();
    }

    /**
     * Returns true if this reference refers to a stream type.
     *
     * @return bool this reference refers to a stream type
     */
    public function isStream(): bool
    {
        return $this->primitiveKind()->isStream();
    }

    /**
     * Returns true if this reference refers to a spatial type.
     *
     * @return bool this reference refers to a spatial type
     */
    public function isSpatial(): bool
    {
        $primitiveTypeKind = $this->primitiveKind();
        return null === $primitiveTypeKind ? false : $primitiveTypeKind->IsSpatial();
    }

    // The As*** functions never return null -- if the supplied type does not have the appropriate shape, an encoding
    // of a bad type is returned.

    /**
     * If this reference is of a primitive type, this will return a valid primitive type reference to the type
     * definition. Otherwise, it will return a bad primitive type reference.
     *
     * @return IPrimitiveTypeReference A valid primitive type reference if the definition of the reference is of a
     *                                 primitive type. Otherwise a bad primitive type reference.
     */
    public function asPrimitive(): IPrimitiveTypeReference
    {
        if ($this instanceof IPrimitiveTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if (null !== $typeDefinition && $typeDefinition->getTypeKind()->isPrimitive()) {
            if ($typeDefinition instanceof IPrimitiveType) {
                switch ($typeDefinition->getPrimitiveKind()) {
                    case PrimitiveTypeKind::Boolean():
                    case PrimitiveTypeKind::Byte():
                    case PrimitiveTypeKind::Double():
                    case PrimitiveTypeKind::Guid():
                    case PrimitiveTypeKind::Int16():
                    case PrimitiveTypeKind::Int32():
                    case PrimitiveTypeKind::Int64():
                    case PrimitiveTypeKind::SByte():
                    case PrimitiveTypeKind::Single():
                    case PrimitiveTypeKind::Stream():
                        return new EdmPrimitiveTypeReference($typeDefinition, $this->getNullable());
                    case PrimitiveTypeKind::Binary():
                        return $this->asBinary();
                    case PrimitiveTypeKind::Decimal():
                        return $this->asDecimal();
                    case PrimitiveTypeKind::String():
                        return $this->asString();
                    case PrimitiveTypeKind::Time():
                    case PrimitiveTypeKind::DateTime():
                    case PrimitiveTypeKind::DateTimeOffset():
                        return $this->asTemporal();
                    case PrimitiveTypeKind::Geography():
                    case PrimitiveTypeKind::GeographyPoint():
                    case PrimitiveTypeKind::GeographyLineString():
                    case PrimitiveTypeKind::GeographyPolygon():
                    case PrimitiveTypeKind::GeographyCollection():
                    case PrimitiveTypeKind::GeographyMultiPoint():
                    case PrimitiveTypeKind::GeographyMultiLineString():
                    case PrimitiveTypeKind::GeographyMultiPolygon():
                    case PrimitiveTypeKind::Geometry():
                    case PrimitiveTypeKind::GeometryPoint():
                    case PrimitiveTypeKind::GeometryLineString():
                    case PrimitiveTypeKind::GeometryPolygon():
                    case PrimitiveTypeKind::GeometryCollection():
                    case PrimitiveTypeKind::GeometryMultiPolygon():
                    case PrimitiveTypeKind::GeometryMultiLineString():
                    case PrimitiveTypeKind::GeometryMultiPoint():
                        return $this->asSpatial();
                    case PrimitiveTypeKind::None():
                        break;
                }
            }
        }

        $typeFullName = $this->fullName();
        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }
        //if (count($errors) == 0)
        {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Primitive
                )
            );
        }

        return new BadPrimitiveTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a collection type, this will return a valid collection type reference to the type
     * definition. Otherwise, it will return a bad collection type reference.
     *
     * @return ICollectionTypeReference A valid collection type reference if the definition of the reference is of a
     *                                  collection type. Otherwise a bad collection type reference.
     */
    public function asCollection(): ICollectionTypeReference
    {
        if ($this instanceof ICollectionTypeReference) {
            return $this;
        }
        $type = $this;

        $typeDefinition = $type->getDefinition();
        if ($typeDefinition->getTypeKind()->isCollection()) {
            assert($typeDefinition instanceof ICollectionType);
            return new EdmCollectionTypeReference($typeDefinition, $type->getNullable());
        }
        $errors = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $type->location(),
                    $type->fullName(),
                    EdmConstants::Type_Collection
                )
            );
        }

        return new EdmCollectionTypeReference(new BadCollectionType($errors), $type->getNullable());
    }

    /**
     * If this reference is of a structured type, this will return a valid structured type reference to the type
     * definition. Otherwise, it will return a bad structured type reference.
     *
     * @return IStructuredTypeReference A valid structured type reference if the definition of the reference is of a
     *                                  structured type. Otherwise a bad structured type reference.
     */
    public function asStructured(): IStructuredTypeReference
    {
        if ($this instanceof IStructuredTypeReference) {
            return $this;
        }

        switch ($this->typeKind()) {
            case TypeKind::Entity():
                return $this->asEntity();
            case TypeKind::Complex():
                return $this->asComplex();
            case TypeKind::Row():
                return $this->asRow();
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Structured
                )
            );
        }

        return new BadEntityTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of an enumeration type, this will return a valid enumeration type reference to the type
     * definition. Otherwise, it will return a bad enumeration type reference.
     *
     * @return IEnumTypeReference A valid enumeration type reference if the definition of the reference is of an
     *                            enumeration type. Otherwise a bad enumeration type reference.
     */
    public function asEnum(): IEnumTypeReference
    {
        if ($this instanceof IEnumTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if ($typeDefinition->getTypeKind()->isEnum()) {
            assert($typeDefinition instanceof IEnumType);
            return new EdmEnumTypeReference($typeDefinition, $this->getNullable());
        }

        $typeFullName = $this->fullName();
        return new EdmEnumTypeReference(
            new BadEnumType(
                $typeFullName,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Enum
                )
            ),
            $this->getNullable()
        );
    }

    /**
     * If this reference is of an entity type, this will return a valid entity type reference to the type definition.
     * Otherwise, it will return a bad entity type reference.
     *
     * @return IEntityTypeReference A valid entity type reference if the definition of the reference is of an entity
     *                              type. Otherwise a bad entity type reference.
     */
    public function asEntity(): IEntityTypeReference
    {
        if ($this instanceof IEntityTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if ($typeDefinition->getTypeKind()->isEntity()) {
            assert($typeDefinition instanceof IEntityType);
            return new EdmEntityTypeReference($typeDefinition, $this->getNullable());
        }
        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Entity
                )
            );
        }

        return new BadEntityTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of an entity reference type, this will return a valid entity reference type reference to
     * the type definition. Otherwise, it will return a bad entity reference type reference.
     *
     * @return IEntityReferenceTypeReference A valid entity reference type reference if the definition of the reference
     *                                       is of an entity reference type. Otherwise a bad entity reference type
     *                                       reference.
     */
    public function asEntityReference(): IEntityReferenceTypeReference
    {
        if ($this instanceof IEntityReferenceTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if ($typeDefinition->getTypeKind()->isEntityReference()) {
            assert($typeDefinition instanceof IEntityReferenceType);
            return new EdmEntityReferenceTypeReference($typeDefinition, $this->getNullable());
        }

        $errors = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $this->fullName(),
                    EdmConstants::Type_EntityReference
                )
            );
        }

        return new EdmEntityReferenceTypeReference(new BadEntityReferenceType($errors), $this->getNullable());
    }

    /**
     * If this reference is of a complex type, this will return a valid complex type reference to the type definition.
     * Otherwise, it will return a bad complex type reference.
     *
     * @return IComplexTypeReference A valid complex type reference if the definition of the reference is of a complex
     *                               type. Otherwise a bad complex type reference.
     */
    public function asComplex(): IComplexTypeReference
    {
        if ($this instanceof IComplexTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if ($typeDefinition->getTypeKind()->isComplex()) {
            assert($typeDefinition instanceof IComplexType);
            return new EdmComplexTypeReference($typeDefinition, $this->getNullable());
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $this->fullName(),
                    EdmConstants::Type_Complex
                )
            );
        }

        return new BadComplexTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a row type, this will return a valid row type reference to the type definition.
     * Otherwise, it will return a bad row type reference.
     *
     * @return IRowTypeReference A valid row type reference if the definition of the reference is of a row type.
     *                           Otherwise a bad row type reference.
     */
    public function asRow(): IRowTypeReference
    {
        if ($this instanceof IRowTypeReference) {
            return $this;
        }

        $typeDefinition = $this->getDefinition();
        if ($typeDefinition->getTypeKind()->isRow()) {
            assert($typeDefinition instanceof IRowType);
            return new EdmRowTypeReference($typeDefinition, $this->getNullable());
        }

        $errors = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $this->fullName(),
                    EdmConstants::Type_Row
                )
            );
        }

        return new EdmRowTypeReference(new BadRowType($errors), $this->getNullable());
    }

    /**
     * If this reference is of a spatial type, this will return a valid spatial type reference to the type definition.
     * Otherwise, it will return a bad spatial type reference.
     *
     * @return ISpatialTypeReference A valid spatial type reference if the definition of the reference is of a spatial
     *                               type. Otherwise a bad spatial type reference.
     */
    public function asSpatial(): ISpatialTypeReference
    {
        if ($this instanceof ISpatialTypeReference) {
            return $this;
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $this->fullName(),
                    EdmConstants::Type_Spatial
                )
            );
        }

        return new BadSpatialTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a temporal type, this will return a valid temporal type reference to the type definition.
     * Otherwise, it will return a bad temporal type reference.
     *
     * @return ITemporalTypeReference A valid temporal type reference if the definition of the reference is of a
     *                                temporal type. Otherwise a bad temporal type reference.
     */
    public function asTemporal(): ITemporalTypeReference
    {
        if ($this instanceof ITemporalTypeReference) {
            return $this;
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $this->fullName(),
                    EdmConstants::Type_Temporal
                )
            );
        }

        return new BadTemporalTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a decimal type, this will return a valid decimal type reference to the type definition.
     * Otherwise, it will return a bad decimal type reference.
     *
     * @return IDecimalTypeReference A valid decimal type reference if the definition of the reference is of a decimal
     *                               type. Otherwise a bad decimal type reference.</returns>
     */
    public function asDecimal(): IDecimalTypeReference
    {
        if ($this instanceof IDecimalTypeReference) {
            return $this;
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Decimal
                )
            );
        }

        return new BadDecimalTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a string type, this will return a valid string type reference to the type definition.
     * Otherwise, it will return a bad string type reference.
     *
     * @return IStringTypeReference A valid string type reference if the definition of the reference is of a string
     *                              type. Otherwise a bad string type reference.
     */
    public function asString(): IStringTypeReference
    {
        if ($this instanceof IStringTypeReference) {
            return $this;
        }

        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_String
                )
            );
        }

        return new BadStringTypeReference($typeFullName, $this->getNullable(), $errors);
    }

    /**
     * If this reference is of a binary type, this will return a valid binary type reference to the type definition.
     * Otherwise, it will return a bad binary type reference.
     *
     * @return IBinaryTypeReference A valid binary type reference if the definition of the reference is of a binary
     *                              type. Otherwise a bad binary type reference.
     */
    public function asBinary(): IBinaryTypeReference
    {
        if ($this instanceof IBinaryTypeReference) {
            return $this;
        }
        $typeFullName = $this->fullName();
        EdmUtil::checkArgumentNull($typeFullName, 'typeFullName');

        $errors       = [];
        if ($this instanceof ICheckable) {
            $errors = $this->getErrors();
            $errors = iterable_to_array($errors);
        }

        if (count($errors) == 0) {
            $errors = array_merge(
                $errors,
                self::conversionError(
                    $this->location(),
                    $typeFullName,
                    EdmConstants::Type_Binary
                )
            );
        }

        return new BadBinaryTypeReference($typeFullName, $this->getNullable(), $errors);
    }


    /**
     * @param  ILocation|null $location
     * @param  string         $typeName
     * @param  string         $typeKindName
     * @return EdmError[]
     */
    private static function conversionError(?ILocation $location, ?string $typeName, string $typeKindName): array
    {
        return [
            new EdmError(
                $location,
                EdmErrorCode::TypeSemanticsCouldNotConvertTypeReference(),
                StringConst::TypeSemantics_CouldNotConvertTypeReference(
                    $typeName ?? EdmConstants::Value_UnnamedType,
                    $typeKindName
                )
            )
        ];
    }

    abstract public function getDefinition(): ?IType;

    abstract public function getNullable(): bool;

    abstract public function location(): ?ILocation;
}
