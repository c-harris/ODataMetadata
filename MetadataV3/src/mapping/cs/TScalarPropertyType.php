<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\mapping\cs;

/**
 * Class representing TScalarPropertyType.
 *
 *
 * XSD Type: TScalarProperty
 */
class TScalarPropertyType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property string $columnName
     */
    private $columnName = null;

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
     * Gets as columnName.
     *
     * @return string
     */
    public function getColumnName()
    {
        return $this->columnName;
    }

    /**
     * Sets a new columnName.
     *
     * @param  string $columnName
     * @return self
     */
    public function setColumnName($columnName)
    {
        $this->columnName = $columnName;
        return $this;
    }
}
