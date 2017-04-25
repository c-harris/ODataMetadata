<?php

namespace MetadataV3\edm;

/**
 * Class representing TConstraintType
 *
 *
 * XSD Type: TConstraint
 */
class TConstraintType
{

    /**
     * @property \MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \MetadataV3\edm\TReferentialConstraintRoleElementType $principal
     */
    private $principal = null;

    /**
     * @property \MetadataV3\edm\TReferentialConstraintRoleElementType $dependent
     */
    private $dependent = null;

    /**
     * Gets as documentation
     *
     * @return \MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation
     *
     * @param \MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(\MetadataV3\edm\TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Gets as principal
     *
     * @return \MetadataV3\edm\TReferentialConstraintRoleElementType
     */
    public function getPrincipal()
    {
        return $this->principal;
    }

    /**
     * Sets a new principal
     *
     * @param \MetadataV3\edm\TReferentialConstraintRoleElementType $principal
     * @return self
     */
    public function setPrincipal(\MetadataV3\edm\TReferentialConstraintRoleElementType $principal)
    {
        $this->principal = $principal;
        return $this;
    }

    /**
     * Gets as dependent
     *
     * @return \MetadataV3\edm\TReferentialConstraintRoleElementType
     */
    public function getDependent()
    {
        return $this->dependent;
    }

    /**
     * Sets a new dependent
     *
     * @param \MetadataV3\edm\TReferentialConstraintRoleElementType $dependent
     * @return self
     */
    public function setDependent(\MetadataV3\edm\TReferentialConstraintRoleElementType $dependent)
    {
        $this->dependent = $dependent;
        return $this;
    }
}
