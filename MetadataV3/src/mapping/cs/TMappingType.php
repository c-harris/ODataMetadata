<?php

namespace MetadataV3\mapping\cs;

/**
 * Class representing TMappingType
 *
 *
 * XSD Type: TMapping
 */
class TMappingType
{

    /**
     * @property string $space
     */
    private $space = null;

    /**
     * @property \MetadataV3\mapping\cs\TAliasType[] $alias
     */
    private $alias = array(
        
    );

    /**
     * @property \MetadataV3\mapping\cs\TEntityContainerMappingType
     * $entityContainerMapping
     */
    private $entityContainerMapping = null;

    /**
     * Gets as space
     *
     * @return string
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Sets a new space
     *
     * @param string $space
     * @return self
     */
    public function setSpace($space)
    {
        $this->space = $space;
        return $this;
    }

    /**
     * Adds as alias
     *
     * @return self
     * @param \MetadataV3\mapping\cs\TAliasType $alias
     */
    public function addToAlias(\MetadataV3\mapping\cs\TAliasType $alias)
    {
        $this->alias[] = $alias;
        return $this;
    }

    /**
     * isset alias
     *
     * @param scalar $index
     * @return boolean
     */
    public function issetAlias($index)
    {
        return isset($this->alias[$index]);
    }

    /**
     * unset alias
     *
     * @param scalar $index
     * @return void
     */
    public function unsetAlias($index)
    {
        unset($this->alias[$index]);
    }

    /**
     * Gets as alias
     *
     * @return \MetadataV3\mapping\cs\TAliasType[]
     */
    public function getAlias()
    {
        return $this->alias;
    }

    /**
     * Sets a new alias
     *
     * @param \MetadataV3\mapping\cs\TAliasType[] $alias
     * @return self
     */
    public function setAlias(array $alias)
    {
        $this->alias = $alias;
        return $this;
    }

    /**
     * Gets as entityContainerMapping
     *
     * @return \MetadataV3\mapping\cs\TEntityContainerMappingType
     */
    public function getEntityContainerMapping()
    {
        return $this->entityContainerMapping;
    }

    /**
     * Sets a new entityContainerMapping
     *
     * @param \MetadataV3\mapping\cs\TEntityContainerMappingType
     * $entityContainerMapping
     * @return self
     */
    public function setEntityContainerMapping(\MetadataV3\mapping\cs\TEntityContainerMappingType $entityContainerMapping)
    {
        $this->entityContainerMapping = $entityContainerMapping;
        return $this;
    }
}