<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Bool Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait BoolTrait
{
    /**
     * @property bool[] $bool
     */
    private $bool = array(
        
    );
    
    /**
     * Adds as bool.
     *
     * @param  bool $bool
     * @return self
     */
    public function addToBool($bool)
    {
        $this->bool[] = $bool;
        return $this;
    }

    /**
     * isset bool.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetBool($index)
    {
        return isset($this->bool[$index]);
    }

    /**
     * unset bool.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetBool($index)
    {
        unset($this->bool[$index]);
    }

    /**
     * Gets as bool.
     *
     * @return bool[]
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
    public function setBool(array $bool)
    {
        $this->bool = $bool;
        return $this;
    }
}
