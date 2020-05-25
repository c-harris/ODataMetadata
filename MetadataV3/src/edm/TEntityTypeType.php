<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TEntityTypeType.
 *
 *
 * XSD Type: TEntityType
 */
class TEntityTypeType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $baseType
     */
    private $baseType = null;

    /**
     * @property bool $abstract
     */
    private $abstract = null;

    /**
     * @property bool $openType
     */
    private $openType = null;

    /**
     * @property string $typeAccess
     */
    private $typeAccess = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $key
     */
    private $key = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[] $property
     */
    private $property = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[] $navigationProperty
     */
    private $navigationProperty = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     */
    private $valueAnnotation = array(
        
    );

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     */
    private $typeAnnotation = array(
        
    );

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as baseType.
     *
     * @return string
     */
    public function getBaseType()
    {
        return $this->baseType;
    }

    /**
     * Sets a new baseType.
     *
     * @param  string $baseType
     * @return self
     */
    public function setBaseType($baseType)
    {
        $this->baseType = $baseType;
        return $this;
    }

    /**
     * Gets as abstract.
     *
     * @return bool
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * Sets a new abstract.
     *
     * @param  bool $abstract
     * @return self
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
        return $this;
    }

    /**
     * Gets as openType.
     *
     * @return bool
     */
    public function getOpenType()
    {
        return $this->openType;
    }

    /**
     * Sets a new openType.
     *
     * @param  bool $openType
     * @return self
     */
    public function setOpenType($openType)
    {
        $this->openType = $openType;
        return $this;
    }

    /**
     * Gets as typeAccess.
     *
     * @return string
     */
    public function getTypeAccess()
    {
        return $this->typeAccess;
    }

    /**
     * Sets a new typeAccess.
     *
     * @param  string $typeAccess
     * @return self
     */
    public function setTypeAccess($typeAccess)
    {
        $this->typeAccess = $typeAccess;
        return $this;
    }

    /**
     * Gets as documentation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as propertyRef.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType $propertyRef
     * @return self
     */
    public function addToKey(TPropertyRefType $propertyRef)
    {
        $this->key[] = $propertyRef;
        return $this;
    }

    /**
     * isset key.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetKey($index)
    {
        return isset($this->key[$index]);
    }

    /**
     * unset key.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetKey($index)
    {
        unset($this->key[$index]);
    }

    /**
     * Gets as key.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[]
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Sets a new key.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TPropertyRefType[] $key
     * @return self
     */
    public function setKey(array $key)
    {
        $this->key = $key;
        return $this;
    }

    /**
     * Adds as property.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType $property
     * @return self
     */
    public function addToProperty(TEntityPropertyType $property)
    {
        $this->property[] = $property;
        return $this;
    }

    /**
     * isset property.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetProperty($index)
    {
        return isset($this->property[$index]);
    }

    /**
     * unset property.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetProperty($index)
    {
        unset($this->property[$index]);
    }

    /**
     * Gets as property.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[]
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Sets a new property.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntityPropertyType[] $property
     * @return self
     */
    public function setProperty(array $property)
    {
        $this->property = $property;
        return $this;
    }

    /**
     * Adds as navigationProperty.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType $navigationProperty
     * @return self
     */
    public function addToNavigationProperty(TNavigationPropertyType $navigationProperty)
    {
        $this->navigationProperty[] = $navigationProperty;
        return $this;
    }

    /**
     * isset navigationProperty.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetNavigationProperty($index)
    {
        return isset($this->navigationProperty[$index]);
    }

    /**
     * unset navigationProperty.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetNavigationProperty($index)
    {
        unset($this->navigationProperty[$index]);
    }

    /**
     * Gets as navigationProperty.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[]
     */
    public function getNavigationProperty()
    {
        return $this->navigationProperty;
    }

    /**
     * Sets a new navigationProperty.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TNavigationPropertyType[] $navigationProperty
     * @return self
     */
    public function setNavigationProperty(array $navigationProperty)
    {
        $this->navigationProperty = $navigationProperty;
        return $this;
    }

    /**
     * Adds as valueAnnotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType $valueAnnotation
     * @return self
     */
    public function addToValueAnnotation(TValueAnnotationType $valueAnnotation)
    {
        $this->valueAnnotation[] = $valueAnnotation;
        return $this;
    }

    /**
     * isset valueAnnotation.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetValueAnnotation($index)
    {
        return isset($this->valueAnnotation[$index]);
    }

    /**
     * unset valueAnnotation.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetValueAnnotation($index)
    {
        unset($this->valueAnnotation[$index]);
    }

    /**
     * Gets as valueAnnotation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[]
     */
    public function getValueAnnotation()
    {
        return $this->valueAnnotation;
    }

    /**
     * Sets a new valueAnnotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TValueAnnotationType[] $valueAnnotation
     * @return self
     */
    public function setValueAnnotation(array $valueAnnotation)
    {
        $this->valueAnnotation = $valueAnnotation;
        return $this;
    }

    /**
     * Adds as typeAnnotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType $typeAnnotation
     * @return self
     */
    public function addToTypeAnnotation(TTypeAnnotationType $typeAnnotation)
    {
        $this->typeAnnotation[] = $typeAnnotation;
        return $this;
    }

    /**
     * isset typeAnnotation.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetTypeAnnotation($index)
    {
        return isset($this->typeAnnotation[$index]);
    }

    /**
     * unset typeAnnotation.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetTypeAnnotation($index)
    {
        unset($this->typeAnnotation[$index]);
    }

    /**
     * Gets as typeAnnotation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[]
     */
    public function getTypeAnnotation()
    {
        return $this->typeAnnotation;
    }

    /**
     * Sets a new typeAnnotation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeAnnotationType[] $typeAnnotation
     * @return self
     */
    public function setTypeAnnotation(array $typeAnnotation)
    {
        $this->typeAnnotation = $typeAnnotation;
        return $this;
    }
}
