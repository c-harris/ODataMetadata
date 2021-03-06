<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Library;

use AlgoWeb\ODataMetadata\Exception\InvalidOperationException;
use AlgoWeb\ODataMetadata\Interfaces\Annotations\IVocabularyAnnotation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use AlgoWeb\ODataMetadata\Interfaces\ISchemaElement;
use AlgoWeb\ODataMetadata\Interfaces\IStructuredType;
use AlgoWeb\ODataMetadata\Interfaces\IVocabularyAnnotatable;
use AlgoWeb\ODataMetadata\Library\Annotations\EdmDirectValueAnnotationsManager;
use AlgoWeb\ODataMetadata\StringConst;
use SplObjectStorage;

/**
 * Represents an EDM model.
 *
 * @package AlgoWeb\ODataMetadata\Library
 */
class EdmModel extends EdmModelBase
{
    /**
     * @var ISchemaElement[]
     */
    private $elements = [];
    /**
     * @var SplObjectStorage|array<IVocabularyAnnotatable, IVocabularyAnnotation[]>
     */
    private $vocabularyAnnotationsDictionary;
    /**
     * @var SplObjectStorage|array<IStructuredType, IStructuredType[]>
     */
    private $derivedTypeMappings;

    public function __construct(array $referencedModels = [], EdmDirectValueAnnotationsManager $annotationsManager = null)
    {
        $annotationsManager = $annotationsManager ?? new EdmDirectValueAnnotationsManager();
        parent::__construct($referencedModels, $annotationsManager);
        $this->vocabularyAnnotationsDictionary = new SplObjectStorage();
        $this->derivedTypeMappings             = new SplObjectStorage();
    }

    /**
     * @return ISchemaElement[] gets the collection of schema elements that are contained in this model
     */
    public function getSchemaElements(): array
    {
        return $this->elements;
    }
    /**
     * @return IVocabularyAnnotation[] gets the collection of vocabulary annotations that are contained in this model
     */
    public function getVocabularyAnnotations(): array
    {
        $values = [];
        foreach ($this->vocabularyAnnotationsDictionary as $annotation) {
            $values[] = $annotation;
        }
        return $values;
    }
    /**
     * Adds a model reference to this model.
     *
     * @param IModel $model the model to reference
     */
    public function addReferencedModel(IModel $model): void
    {
        parent::addReferencedModel($model);
    }
    /**
     * Finds a list of types that derive directly from the supplied type.
     *
     * @param  IStructuredType   $baseType the base type that derived types are being searched for
     * @return IStructuredType[] a list of types from this model that derive directly from the given type
     */
    public function findDirectlyDerivedTypes(IStructuredType $baseType): array
    {
        if ($this->derivedTypeMappings->offsetExists($baseType)) {
            return $this->derivedTypeMappings->offsetGet($baseType);
        }
        return [];
    }

    /**
     * Adds a schema element to this model.
     *
     * @param ISchemaElement $element element to be added
     */
    public function addElement(ISchemaElement $element): void
    {
        $this->elements[] = $element;
        if ($element instanceof IStructuredType && $element->getBaseType() !== null) {
            if (!$this->derivedTypeMappings->offsetExists($element->getBaseType())) {
                $this->derivedTypeMappings->offsetSet($element, []);
            }
            $derivedTypes = $this->derivedTypeMappings->offsetGet($element);
            $this->derivedTypeMappings->offsetSet($element, $derivedTypes);
        }
        $this->registerElement($element);
    }

    /**
     *  Adds a collection of schema elements to this model.
     *
     * @param ISchemaElement[] $newElements elements to be added
     */
    public function addElements(array $newElements): void
    {
        foreach ($newElements as $element) {
            $this->addElement($element);
        }
    }

    /**
     * Adds a vocabulary annotation to this model.
     *
     * @param IVocabularyAnnotation $annotation the annotation to be added
     */
    public function addVocabularyAnnotation(IVocabularyAnnotation $annotation)
    {
        if (null === $annotation->getTarget()) {
            throw new InvalidOperationException(StringConst::Constructable_VocabularyAnnotationMustHaveTarget());
        }

        $elementAnnotations = [];
        if ($this->vocabularyAnnotationsDictionary->offsetExists($annotation->getTarget())) {
            $elementAnnotations = $this->vocabularyAnnotationsDictionary->offsetGet($annotation->getTarget());
        }
        $elementAnnotations[] = $annotation;

        $this->vocabularyAnnotationsDictionary->offsetSet($annotation->getTarget(), $elementAnnotations);
    }
}
