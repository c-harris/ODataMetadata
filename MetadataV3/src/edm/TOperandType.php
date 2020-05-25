<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TOperandType.
 *
 *
 * XSD Type: TOperand
 */
class TOperandType
{

    /**
     * @property string $string
     */
    private $string = null;

    /**
     * @property mixed $binary
     */
    private $binary = null;

    /**
     * @property int $int
     */
    private $int = null;

    /**
     * @property float $float
     */
    private $float = null;

    /**
     * @property string $guid
     */
    private $guid = null;

    /**
     * @property float $decimal
     */
    private $decimal = null;

    /**
     * @property bool $bool
     */
    private $bool = null;

    /**
     * @property \DateTime $dateTime
     */
    private $dateTime = null;

    /**
     * @property \DateTime $dateTimeOffset
     */
    private $dateTimeOffset = null;

    /**
     * @property string $enum
     */
    private $enum = null;

    /**
     * @property string $path
     */
    private $path = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType $if
     */
    private $if = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType $record
     */
    private $record = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType $collection
     */
    private $collection = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     */
    private $typeAssert = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType $typeTest
     */
    private $typeTest = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     */
    private $functionReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     */
    private $entitySetReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     */
    private $anonymousFunction = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     */
    private $parameterReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType $apply
     */
    private $apply = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     */
    private $propertyReference = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     */
    private $valueTermReference = null;

    /**
     * Gets as string.
     *
     * @return string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Sets a new string.
     *
     * @param  string $string
     * @return self
     */
    public function setString($string)
    {
        $this->string = $string;
        return $this;
    }

    /**
     * Gets as binary.
     *
     * @return mixed
     */
    public function getBinary()
    {
        return $this->binary;
    }

    /**
     * Sets a new binary.
     *
     * @param  mixed $binary
     * @return self
     */
    public function setBinary($binary)
    {
        $this->binary = $binary;
        return $this;
    }

    /**
     * Gets as int.
     *
     * @return int
     */
    public function getInt()
    {
        return $this->int;
    }

    /**
     * Sets a new int.
     *
     * @param  int  $int
     * @return self
     */
    public function setInt($int)
    {
        $this->int = $int;
        return $this;
    }

    /**
     * Gets as float.
     *
     * @return float
     */
    public function getFloat()
    {
        return $this->float;
    }

    /**
     * Sets a new float.
     *
     * @param  float $float
     * @return self
     */
    public function setFloat($float)
    {
        $this->float = $float;
        return $this;
    }

    /**
     * Gets as guid.
     *
     * @return string
     */
    public function getGuid()
    {
        return $this->guid;
    }

    /**
     * Sets a new guid.
     *
     * @param  string $guid
     * @return self
     */
    public function setGuid($guid)
    {
        $this->guid = $guid;
        return $this;
    }

    /**
     * Gets as decimal.
     *
     * @return float
     */
    public function getDecimal()
    {
        return $this->decimal;
    }

    /**
     * Sets a new decimal.
     *
     * @param  float $decimal
     * @return self
     */
    public function setDecimal($decimal)
    {
        $this->decimal = $decimal;
        return $this;
    }

    /**
     * Gets as bool.
     *
     * @return bool
     */
    public function getBool()
    {
        return $this->bool;
    }

    /**
     * Sets a new bool.
     *
     * @param  bool $bool
     * @return self
     */
    public function setBool($bool)
    {
        $this->bool = $bool;
        return $this;
    }

    /**
     * Gets as dateTime.
     *
     * @return \DateTime
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * Sets a new dateTime.
     *
     * @param  \DateTime $dateTime
     * @return self
     */
    public function setDateTime(\DateTime $dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * Gets as dateTimeOffset.
     *
     * @return \DateTime
     */
    public function getDateTimeOffset()
    {
        return $this->dateTimeOffset;
    }

    /**
     * Sets a new dateTimeOffset.
     *
     * @param  \DateTime $dateTimeOffset
     * @return self
     */
    public function setDateTimeOffset(\DateTime $dateTimeOffset)
    {
        $this->dateTimeOffset = $dateTimeOffset;
        return $this;
    }

    /**
     * Gets as enum.
     *
     * @return string
     */
    public function getEnum()
    {
        return $this->enum;
    }

    /**
     * Sets a new enum.
     *
     * @param  string $enum
     * @return self
     */
    public function setEnum($enum)
    {
        $this->enum = $enum;
        return $this;
    }

    /**
     * Gets as path.
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Sets a new path.
     *
     * @param  string $path
     * @return self
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * Gets as if.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType
     */
    public function getIf()
    {
        return $this->if;
    }

    /**
     * Sets a new if.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TIfExpressionType $if
     * @return self
     */
    public function setIf(TIfExpressionType $if)
    {
        $this->if = $if;
        return $this;
    }

    /**
     * Gets as record.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType
     */
    public function getRecord()
    {
        return $this->record;
    }

    /**
     * Sets a new record.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TRecordExpressionType $record
     * @return self
     */
    public function setRecord(TRecordExpressionType $record)
    {
        $this->record = $record;
        return $this;
    }

    /**
     * Gets as collection.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType
     */
    public function getCollection()
    {
        return $this->collection;
    }

    /**
     * Sets a new collection.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TCollectionExpressionType $collection
     * @return self
     */
    public function setCollection(TCollectionExpressionType $collection)
    {
        $this->collection = $collection;
        return $this;
    }

    /**
     * Gets as typeAssert.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType
     */
    public function getTypeAssert()
    {
        return $this->typeAssert;
    }

    /**
     * Sets a new typeAssert.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAssertExpressionType $typeAssert
     * @return self
     */
    public function setTypeAssert(TTypeAssertExpressionType $typeAssert)
    {
        $this->typeAssert = $typeAssert;
        return $this;
    }

    /**
     * Gets as typeTest.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType $typeTest
     * @return self
     */
    public function setTypeTest(TTypeTestExpressionType $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }

    /**
     * Gets as functionReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType
     */
    public function getFunctionReference()
    {
        return $this->functionReference;
    }

    /**
     * Sets a new functionReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType $functionReference
     * @return self
     */
    public function setFunctionReference(TFunctionReferenceExpressionType $functionReference)
    {
        $this->functionReference = $functionReference;
        return $this;
    }

    /**
     * Gets as entitySetReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     * @return self
     */
    public function setEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }

    /**
     * Gets as anonymousFunction.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType
     */
    public function getAnonymousFunction()
    {
        return $this->anonymousFunction;
    }

    /**
     * Sets a new anonymousFunction.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAnonymousFunctionExpressionType $anonymousFunction
     * @return self
     */
    public function setAnonymousFunction(TAnonymousFunctionExpressionType $anonymousFunction)
    {
        $this->anonymousFunction = $anonymousFunction;
        return $this;
    }

    /**
     * Gets as parameterReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType
     */
    public function getParameterReference()
    {
        return $this->parameterReference;
    }

    /**
     * Sets a new parameterReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TParameterReferenceExpressionType $parameterReference
     * @return self
     */
    public function setParameterReference(TParameterReferenceExpressionType $parameterReference)
    {
        $this->parameterReference = $parameterReference;
        return $this;
    }

    /**
     * Gets as apply.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType
     */
    public function getApply()
    {
        return $this->apply;
    }

    /**
     * Sets a new apply.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TApplyExpressionType $apply
     * @return self
     */
    public function setApply(TApplyExpressionType $apply)
    {
        $this->apply = $apply;
        return $this;
    }

    /**
     * Gets as propertyReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType
     */
    public function getPropertyReference()
    {
        return $this->propertyReference;
    }

    /**
     * Sets a new propertyReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyReferenceExpressionType $propertyReference
     * @return self
     */
    public function setPropertyReference(TPropertyReferenceExpressionType $propertyReference)
    {
        $this->propertyReference = $propertyReference;
        return $this;
    }

    /**
     * Gets as valueTermReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType
     */
    public function getValueTermReference()
    {
        return $this->valueTermReference;
    }

    /**
     * Sets a new valueTermReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueTermReferenceExpressionType $valueTermReference
     * @return self
     */
    public function setValueTermReference(TValueTermReferenceExpressionType $valueTermReference)
    {
        $this->valueTermReference = $valueTermReference;
        return $this;
    }
}
