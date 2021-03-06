<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library\Internal\Bad;

use AlgoWeb\ODataMetadata\Edm\Validation\EdmError;
use AlgoWeb\ODataMetadata\Helpers\EnumMemberHelpers;
use AlgoWeb\ODataMetadata\Interfaces\IEnumMember;
use AlgoWeb\ODataMetadata\Interfaces\IEnumType;
use AlgoWeb\ODataMetadata\Interfaces\Values\IPrimitiveValue;
use AlgoWeb\ODataMetadata\Library\EdmPrimitiveTypeReference;

/**
 * Represents a semantically invalid EDM enumeration type member.
 *
 * @package AlgoWeb\ODataMetadata\Library\Internal\Bad
 */
class BadEnumMember extends BadElement implements IEnumMember
{
    use EnumMemberHelpers;

    /**
     * @var string|null
     */
    private $name;
    /**
     * @var IEnumType
     */
    private $declaringType;

    /**
     * BadEnumMember constructor.
     * @param IEnumType   $declaringType
     * @param string|null $name
     * @param EdmError[]  $errors
     */
    public function __construct(IEnumType $declaringType, ?string $name, array $errors)
    {
        parent::__construct($errors);
        $this->name          = $name ?? '';
        $this->declaringType = $declaringType;
    }

    /**
     * @return IPrimitiveValue gets the value of this enumeration type member
     */
    public function getValue(): IPrimitiveValue
    {
        return new BadPrimitiveValue(
            new EdmPrimitiveTypeReference(
                $this->declaringType->getUnderlyingType(),
                false
            ),
            iterable_to_array($this->getErrors())
        );
    }

    /**
     * @return IEnumType gets the type that this member belongs to
     */
    public function getDeclaringType(): IEnumType
    {
        return $this->declaringType;
    }

    /**
     * @return string|null gets the name of this element
     */
    public function getName(): ?string
    {
        return $this->name;
    }
}
