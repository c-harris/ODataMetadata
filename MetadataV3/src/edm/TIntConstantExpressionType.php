<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TIntConstantExpressionType.
 *
 *
 * XSD Type: TIntConstantExpression
 */
class TIntConstantExpressionType
{

    /**
     * @property int $__value
     */
    private $__value = null;

    /**
     * Construct.
     *
     * @param int $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  int ...$value
     * @return int
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
