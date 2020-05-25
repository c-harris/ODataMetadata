<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TBinaryConstantExpressionType.
 *
 *
 * XSD Type: TBinaryConstantExpression
 */
class TBinaryConstantExpressionType
{

    /**
     * @property mixed $__value
     */
    private $__value = null;

    /**
     * Construct.
     *
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  mixed ...$value
     * @return mixed
     */
    public function value(...$value)
    {
        if (0 < count($value)) {
            $this->__value = $value[0];
        }
        return $this->__value;
    }

    /**
     * Gets a string value.
     *
     * @return string
     */
    public function __toString()
    {
        return strval($this->__value);
    }
}
