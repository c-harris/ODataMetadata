<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TTypeTestExpressionType.
 *
 *
 * XSD Type: TTypeTestExpression
 */
class TTypeTestExpressionType
{

    /**
     * @property string $type
     */
    private $type = null;

    /**
     * @property bool $nullable
     */
    private $nullable = null;

    /**
     * @property string $defaultValue
     */
    private $defaultValue = null;

    /**
     * @property string $maxLength
     */
    private $maxLength = null;

    /**
     * @property bool $fixedLength
     */
    private $fixedLength = null;

    /**
     * @property int $precision
     */
    private $precision = null;

    /**
     * @property int $scale
     */
    private $scale = null;

    /**
     * @property bool $unicode
     */
    private $unicode = null;

    /**
     * @property string $collation
     */
    private $collation = null;

    /**
     * @property string $sRID
     */
    private $sRID = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[] $operand
     */
    private $operand = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[] $collectionType
     */
    private $collectionType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[] $referenceType
     */
    private $referenceType = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     */
    private $rowType = null;

    /**
     * Gets as type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Sets a new type.
     *
     * @param  string $type
     * @return self
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Gets as nullable.
     *
     * @return bool
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * Sets a new nullable.
     *
     * @param  bool $nullable
     * @return self
     */
    public function setNullable($nullable)
    {
        $this->nullable = $nullable;
        return $this;
    }

    /**
     * Gets as defaultValue.
     *
     * @return string
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * Sets a new defaultValue.
     *
     * @param  string $defaultValue
     * @return self
     */
    public function setDefaultValue($defaultValue)
    {
        $this->defaultValue = $defaultValue;
        return $this;
    }

    /**
     * Gets as maxLength.
     *
     * @return string
     */
    public function getMaxLength()
    {
        return $this->maxLength;
    }

    /**
     * Sets a new maxLength.
     *
     * @param  string $maxLength
     * @return self
     */
    public function setMaxLength($maxLength)
    {
        $this->maxLength = $maxLength;
        return $this;
    }

    /**
     * Gets as fixedLength.
     *
     * @return bool
     */
    public function getFixedLength()
    {
        return $this->fixedLength;
    }

    /**
     * Sets a new fixedLength.
     *
     * @param  bool $fixedLength
     * @return self
     */
    public function setFixedLength($fixedLength)
    {
        $this->fixedLength = $fixedLength;
        return $this;
    }

    /**
     * Gets as precision.
     *
     * @return int
     */
    public function getPrecision()
    {
        return $this->precision;
    }

    /**
     * Sets a new precision.
     *
     * @param  int  $precision
     * @return self
     */
    public function setPrecision($precision)
    {
        $this->precision = $precision;
        return $this;
    }

    /**
     * Gets as scale.
     *
     * @return int
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Sets a new scale.
     *
     * @param  int  $scale
     * @return self
     */
    public function setScale($scale)
    {
        $this->scale = $scale;
        return $this;
    }

    /**
     * Gets as unicode.
     *
     * @return bool
     */
    public function getUnicode()
    {
        return $this->unicode;
    }

    /**
     * Sets a new unicode.
     *
     * @param  bool $unicode
     * @return self
     */
    public function setUnicode($unicode)
    {
        $this->unicode = $unicode;
        return $this;
    }

    /**
     * Gets as collation.
     *
     * @return string
     */
    public function getCollation()
    {
        return $this->collation;
    }

    /**
     * Sets a new collation.
     *
     * @param  string $collation
     * @return self
     */
    public function setCollation($collation)
    {
        $this->collation = $collation;
        return $this;
    }

    /**
     * Gets as sRID.
     *
     * @return string
     */
    public function getSRID()
    {
        return $this->sRID;
    }

    /**
     * Sets a new sRID.
     *
     * @param  string $sRID
     * @return self
     */
    public function setSRID($sRID)
    {
        $this->sRID = $sRID;
        return $this;
    }

    /**
     * Adds as operand.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType $operand
     * @return self
     */
    public function addToOperand(TOperandType $operand)
    {
        $this->operand[] = $operand;
        return $this;
    }

    /**
     * isset operand.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetOperand($index)
    {
        return isset($this->operand[$index]);
    }

    /**
     * unset operand.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetOperand($index)
    {
        unset($this->operand[$index]);
    }

    /**
     * Gets as operand.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[]
     */
    public function getOperand()
    {
        return $this->operand;
    }

    /**
     * Sets a new operand.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TOperandType[] $operand
     * @return self
     */
    public function setOperand(array $operand)
    {
        $this->operand = $operand;
        return $this;
    }

    /**
     * Adds as collectionType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType $collectionType
     * @return self
     */
    public function addToCollectionType(TCollectionTypeType $collectionType)
    {
        $this->collectionType[] = $collectionType;
        return $this;
    }

    /**
     * isset collectionType.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetCollectionType($index)
    {
        return isset($this->collectionType[$index]);
    }

    /**
     * unset collectionType.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCollectionType($index)
    {
        unset($this->collectionType[$index]);
    }

    /**
     * Gets as collectionType.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[]
     */
    public function getCollectionType()
    {
        return $this->collectionType;
    }

    /**
     * Sets a new collectionType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionTypeType[] $collectionType
     * @return self
     */
    public function setCollectionType(array $collectionType)
    {
        $this->collectionType = $collectionType;
        return $this;
    }

    /**
     * Adds as referenceType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType $referenceType
     * @return self
     */
    public function addToReferenceType(TReferenceTypeType $referenceType)
    {
        $this->referenceType[] = $referenceType;
        return $this;
    }

    /**
     * isset referenceType.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetReferenceType($index)
    {
        return isset($this->referenceType[$index]);
    }

    /**
     * unset referenceType.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReferenceType($index)
    {
        unset($this->referenceType[$index]);
    }

    /**
     * Gets as referenceType.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[]
     */
    public function getReferenceType()
    {
        return $this->referenceType;
    }

    /**
     * Sets a new referenceType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TReferenceTypeType[] $referenceType
     * @return self
     */
    public function setReferenceType(array $referenceType)
    {
        $this->referenceType = $referenceType;
        return $this;
    }

    /**
     * Adds as property.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType $property
     * @return self
     */
    public function addToRowType(TPropertyType $property)
    {
        $this->rowType[] = $property;
        return $this;
    }

    /**
     * isset rowType.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetRowType($index)
    {
        return isset($this->rowType[$index]);
    }

    /**
     * unset rowType.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetRowType($index)
    {
        unset($this->rowType[$index]);
    }

    /**
     * Gets as rowType.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[]
     */
    public function getRowType()
    {
        return $this->rowType;
    }

    /**
     * Sets a new rowType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyType[] $rowType
     * @return self
     */
    public function setRowType(array $rowType)
    {
        $this->rowType = $rowType;
        return $this;
    }
}
