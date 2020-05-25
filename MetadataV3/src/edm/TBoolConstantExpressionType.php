<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

/**
 * Class representing TBoolConstantExpressionType.
 *
 *
 * XSD Type: TBoolConstantExpression
 */
class TBoolConstantExpressionType
{

    /**
     * @property bool $__value
     */
    private $__value = null;

    /**
     * Construct.
     *
     * @param bool $value
     */
    public function __construct($value)
    {
        $this->value($value);
    }

    /**
     * Gets or sets the inner value.
     *
     * @param  bool ...$value
     * @return bool
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
