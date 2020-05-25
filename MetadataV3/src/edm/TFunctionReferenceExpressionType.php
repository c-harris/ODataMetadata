<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TFunctionReferenceExpressionType.
 *
 *
 * XSD Type: TFunctionReferenceExpression
 */
class TFunctionReferenceExpressionType
{

    /**
     * @property string $function
     */
    private $function = null;

    /**
     * @property
     * \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     * $parameter
     */
    private $parameter = array(
        
    );

    /**
     * Gets as function.
     *
     * @return string
     */
    public function getFunction()
    {
        return $this->function;
    }

    /**
     * Sets a new function.
     *
     * @param  string $function
     * @return self
     */
    public function setFunction($function)
    {
        $this->function = $function;
        return $this;
    }

    /**
     * Adds as parameter.
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType
     * $parameter
     * @return self
     */
    public function addToParameter(TFunctionReferenceExpressionType\ParameterAnonymousType $parameter)
    {
        $this->parameter[] = $parameter;
        return $this;
    }

    /**
     * isset parameter.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetParameter($index)
    {
        return isset($this->parameter[$index]);
    }

    /**
     * unset parameter.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetParameter($index)
    {
        unset($this->parameter[$index]);
    }

    /**
     * Gets as parameter.
     *
     * @return
     * \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter.
     *
     * @param \AlgoWeb\ODataMetadata\MetadataV3\edm\TFunctionReferenceExpressionType\ParameterAnonymousType[]
     * $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }
}
