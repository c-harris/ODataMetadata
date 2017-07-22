<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm;

use AlgoWeb\ODataMetadata\IsOK;
use AlgoWeb\ODataMetadata\IsOKTraits\IsOKToolboxTrait;
use AlgoWeb\ODataMetadata\MetadataV3\edm\IsOKTraits\TSimpleIdentifierTrait;

/**
 * An Association element defines a relationship between two entity types. An association must specify the entity types that are involved in the relationship and the possible number of entity types at each end of the relationship, which is known as the multiplicity. The multiplicity of an association end can have a value of one (1), zero or one (0..1), or many (*). This information is specified in two child End elements.
 * Entity type instances at one end of an association can be accessed through navigation properties or foreign keys, if they are exposed on an entity type.
 * In an application, an instance of an association represents a specific association between instances of entity types. Association instances are logically grouped in an association set.
 *
 * An Association element can have the following child elements (in the order listed):
 * - Documentation (zero or one element)
 *  - End (exactly 2 elements)
 *  - ReferentialConstraint (zero or one element)
 *  - Annotation elements (zero or more elements)
 *
 * TODO: Annotation elements (zero or more elements) are currently MIA?
 * XSD Type: TAssociation
 */
class TAssociationType extends IsOK
{
    use IsOKToolboxTrait, TSimpleIdentifierTrait;
    /**
     * The name of the association.
     *
     *
     * Attribute NameIs Required
     * @property string $name
     */
    private $name = null;

    /**
     * Documentation (zero or one elements allowed).
     *
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * End (exactly 2 elements).
     *
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType[] $end
     */
    private $end = [];

    /**
     * ReferentialConstraint (zero or one element).
     *
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType $referentialConstraint
     */
    private $referentialConstraint = null;

    /**
     * Gets as name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Sets a new name.
     *
     * @param  string $name
     * @return self
     */
    public function setName($name)
    {
        if (!$this->isTSimpleIdentifierValid($name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            throw new \InvalidArgumentException($msg);
        }
        $this->name = $name;
        return $this;
    }

    /**
     * Gets as documentation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $msg = null;
        if (!$documentation->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as end.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType $end
     * @return self
     */
    public function addToEnd(TAssociationEndType $end)
    {
        $msg = null;
        if (!$end->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->end[] = $end;
        return $this;
    }

    /**
     * isset end.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetEnd($index)
    {
        return isset($this->end[$index]);
    }

    /**
     * unset end.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetEnd($index)
    {
        unset($this->end[$index]);
    }

    /**
     * Gets as end.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType[]
     */
    public function getEnd()
    {
        return $this->end;
    }

    /**
     * Sets a new end.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType[] $end
     * @return self
     */
    public function setEnd(array $end)
    {
        if (!$this->isValidArrayOK(
            $end,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType',
            $msg,
            2,
            2
        )
        ) {
            throw new \InvalidArgumentException($msg);
        }
        $this->end = $end;
        return $this;
    }

    /**
     * Gets as referentialConstraint.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType
     */
    public function getReferentialConstraint()
    {
        return $this->referentialConstraint;
    }

    /**
     * Sets a new referentialConstraint.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\TConstraintType $referentialConstraint
     * @return self
     */
    public function setReferentialConstraint(TConstraintType $referentialConstraint)
    {
        $msg = null;
        if (!$referentialConstraint->isOK($msg)) {
            throw new \InvalidArgumentException($msg);
        }
        $this->referentialConstraint = $referentialConstraint;
        return $this;
    }
    
    public function isOK(&$msg = null)
    {
        if (!$this->isTSimpleIdentifierValid($this->name)) {
            $msg = 'Name must be a valid TSimpleIdentifier';
            return false;
        }
        if (!$this->isObjectNullOrOK($this->documentation, $msg)) {
            return false;
        }
        if (!$this->isObjectNullOrOK($this->referentialConstraint, $msg)) {
            return false;
        }
        if (!$this->isValidArrayOK(
            $this->end,
            '\AlgoWeb\ODataMetadata\MetadataV3\edm\TAssociationEndType',
            $msg,
            2,
            2
        )
        ) {
            return false;
        }
        
        return true;
    }
}
/*
 * Example
 * The following example shows an Association element that defines the CustomerOrders association when foreign keys have
 * not been exposed on the Customer and Order entity types. The Multiplicity values for each End of the association
 * indicate that many Orders can be associated with a Customer, but only one Customer can be associated with an Order.
 * Additionally, the OnDelete element indicates that all Orders that are related to a particular Customer and have been
 * loaded into the ObjectContext will be deleted if the Customer is deleted.
 *
 * <Association Name="CustomerOrders">
 *     <End Type="ExampleModel.Customer" Role="Customer" Multiplicity="1" >
 *         <OnDelete Action="Cascade" />
 *     </End>
 *     <End Type="ExampleModel.Order" Role="Order" Multiplicity="*" />
 * </Association>
 * The following example shows an Association element that defines the CustomerOrders association when foreign keys
 * have been exposed on the Customer and Order entity types. With foreign keys exposed, the relationship between the
 * entities is managed with a ReferentialConstraint element. A corresponding AssociationSetMapping element is not
 * necessary to map this association to the data source.
 *
 * <Association Name="CustomerOrders">
 *     <End Type="ExampleModel.Customer" Role="Customer" Multiplicity="1" >
 *         <OnDelete Action="Cascade" />
 *     </End>
 *     <End Type="ExampleModel.Order" Role="Order" Multiplicity="*" />
 *     <ReferentialConstraint>
 *         <Principal Role="Customer">
 *             <PropertyRef Name="Id" />
 *         </Principal>
 *         <Dependent Role="Order">
 *             <PropertyRef Name="CustomerId" />
 *         </Dependent>
 *     </ReferentialConstraint>
 * </Association>
 */
