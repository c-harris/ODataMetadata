<?php
namespace AlgoWeb\ODataMetadata\MetadataV3\edm\GExpressionGroupTraits;

/**
 * Trait representing the EntitySetReference Component of  MetadataV3\edm\TCollectionExpressionType.
 *
 *
 * XSD Type: GExpression
 */
trait EntitySetReferenceTrait
{
    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType[]
     * $entitySetReference
     */
    private $entitySetReference = array(
        
    );

    
    /**
     * Adds as entitySetReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType $entitySetReference
     * @return self
     */
    public function addToEntitySetReference(TEntitySetReferenceExpressionType $entitySetReference)
    {
        $this->entitySetReference[] = $entitySetReference;
        return $this;
    }

    /**
     * isset entitySetReference.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetEntitySetReference($index)
    {
        return isset($this->entitySetReference[$index]);
    }

    /**
     * unset entitySetReference.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEntitySetReference($index)
    {
        unset($this->entitySetReference[$index]);
    }

    /**
     * Gets as entitySetReference.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType[]
     */
    public function getEntitySetReference()
    {
        return $this->entitySetReference;
    }

    /**
     * Sets a new entitySetReference.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TEntitySetReferenceExpressionType[] $entitySetReference
     * @return self
     */
    public function setEntitySetReference(array $entitySetReference)
    {
        $this->entitySetReference = $entitySetReference;
        return $this;
    }
}
