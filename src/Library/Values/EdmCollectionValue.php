<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Values;

use AlgoWeb\ODataMetadata\Enums\ValueKind;
use AlgoWeb\ODataMetadata\Helpers\ValueHelpers;
use AlgoWeb\ODataMetadata\Interfaces\ICollectionTypeReference;
use AlgoWeb\ODataMetadata\Interfaces\Values\ICollectionValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IDelayedValue;
use AlgoWeb\ODataMetadata\Interfaces\Values\IValue;

/**
 * Represents an EDM collection value.
 *
 * @package AlgoWeb\ODataMetadata\Library\Values
 */
class EdmCollectionValue extends EdmValue implements ICollectionValue
{
    use ValueHelpers;
    /**
     * @var IDelayedValue[]
     */
    private $elements;

    /**
     *  Initializes a new instance of the EdmCollectionValue class.
     *
     * @param ICollectionTypeReference $type     A reference to a collection type that describes this collection value
     * @param IDelayedValue[]          $elements The collection of values stored in this collection value
     */
    public function __construct(ICollectionTypeReference $type, array $elements)
    {
        parent::__construct($type);
        $this->elements = $elements;
    }

    /**
     * @return ValueKind gets the kind of this value
     */
    public function getValueKind(): ValueKind
    {
        return ValueKind::Collection();
    }

    /**
     * @return IDelayedValue[] gets the values stored in this collection
     */
    public function getElements(): array
    {
        return $this->elements;
    }

    /**
     * @return IValue gets the data stored in this value
     */
    public function getValue()
    {
        return $this;
    }
}
