<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Int Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait IntTrait
{
    /**
     * @property int[] $int
     */
    private $int = array(
        
    );

    
    /**
     * Adds as int.
     *
     * @param  int  $int
     * @return self
     */
    public function addToInt($int)
    {
        $this->int[] = $int;
        return $this;
    }

    /**
     * isset int.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetInt($index)
    {
        return isset($this->int[$index]);
    }

    /**
     * unset int.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetInt($index)
    {
        unset($this->int[$index]);
    }

    /**
     * Gets as int.
     *
     * @return int[]
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
    public function setInt(array $int)
    {
        $this->int = $int;
        return $this;
    }
}
