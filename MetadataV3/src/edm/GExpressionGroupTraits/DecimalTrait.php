<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Decimal Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait DecimalTrait
{
    /**
     * @property float[] $decimal
     */
    private $decimal = array(
        
    );
    
    /**
     * Adds as decimal.
     *
     * @param  float $decimal
     * @return self
     */
    public function addToDecimal($decimal)
    {
        $this->decimal[] = $decimal;
        return $this;
    }

    /**
     * isset decimal.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetDecimal($index)
    {
        return isset($this->decimal[$index]);
    }

    /**
     * unset decimal.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetDecimal($index)
    {
        unset($this->decimal[$index]);
    }

    /**
     * Gets as decimal.
     *
     * @return float[]
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
    public function setDecimal(array $decimal)
    {
        $this->decimal = $decimal;
        return $this;
    }
}
