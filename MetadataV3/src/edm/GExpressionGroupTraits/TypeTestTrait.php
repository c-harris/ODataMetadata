<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the Type Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait TypeTestTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType[] $typeTest
     */
    private $typeTest = array(
        
    );

    
    /**
     * Adds as typeTest.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType $typeTest
     * @return self
     */
    public function addToTypeTest(TTypeTestExpressionType $typeTest)
    {
        $this->typeTest[] = $typeTest;
        return $this;
    }

    /**
     * isset typeTest.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetTypeTest($index)
    {
        return isset($this->typeTest[$index]);
    }

    /**
     * unset typeTest.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetTypeTest($index)
    {
        unset($this->typeTest[$index]);
    }

    /**
     * Gets as typeTest.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType[]
     */
    public function getTypeTest()
    {
        return $this->typeTest;
    }

    /**
     * Sets a new typeTest.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TTypeTestExpressionType[] $typeTest
     * @return self
     */
    public function setTypeTest(array $typeTest)
    {
        $this->typeTest = $typeTest;
        return $this;
    }
}
