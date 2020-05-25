<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the String Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait StringTrait
{

    /**
     * @property string[] $string
     */
    private $string = array(
        
    );

    /**
     * Adds as string.
     *
     * @param  string $string
     * @return self
     */
    public function addToString($string)
    {
        $this->string[] = $string;
        return $this;
    }

    /**
     * isset string.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetString($index)
    {
        return isset($this->string[$index]);
    }

    /**
     * unset string.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetString($index)
    {
        unset($this->string[$index]);
    }

    /**
     * Gets as string.
     *
     * @return string[]
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
    public function setString(array $string)
    {
        $this->string = $string;
        return $this;
    }
}
