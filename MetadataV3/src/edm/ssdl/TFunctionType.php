<?php

namespace AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl;

/**
 * Class representing TFunctionType.
 *
 *
 * XSD Type: TFunction
 */
class TFunctionType
{

    /**
     * @property string $name
     */
    private $name = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionReturnTypeType[] $returnType
     */
    private $returnType = array(
        
    );

    /**
     * @property bool $aggregate
     */
    private $aggregate = null;

    /**
     * @property bool $builtIn
     */
    private $builtIn = null;

    /**
     * @property string $storeFunctionName
     */
    private $storeFunctionName = null;

    /**
     * @property bool $niladicFunction
     */
    private $niladicFunction = null;

    /**
     * @property bool $isComposable
     */
    private $isComposable = null;

    /**
     * @property string $parameterTypeSemantics
     */
    private $parameterTypeSemantics = null;

    /**
     * @property string $schema
     */
    private $schema = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     */
    private $documentation = null;

    /**
     * @property \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TParameterType[] $parameter
     */
    private $parameter = array(
        
    );

    /**
     * @property string[] $commandText
     */
    private $commandText = array(
        
    );

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
        $this->name = $name;
        return $this;
    }

    /**
     * Adds as returnType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionReturnTypeType $returnType
     * @return self
     */
    public function addToReturnType(TFunctionReturnTypeType $returnType)
    {
        $this->returnType[] = $returnType;
        return $this;
    }

    /**
     * isset returnType.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetReturnType($index)
    {
        return isset($this->returnType[$index]);
    }

    /**
     * unset returnType.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetReturnType($index)
    {
        unset($this->returnType[$index]);
    }

    /**
     * Gets as returnType.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionReturnTypeType[]
     */
    public function getReturnType()
    {
        return $this->returnType;
    }

    /**
     * Sets a new returnType.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TFunctionReturnTypeType[] $returnType
     * @return self
     */
    public function setReturnType(array $returnType)
    {
        $this->returnType = $returnType;
        return $this;
    }

    /**
     * Gets as aggregate.
     *
     * @return bool
     */
    public function getAggregate()
    {
        return $this->aggregate;
    }

    /**
     * Sets a new aggregate.
     *
     * @param  bool $aggregate
     * @return self
     */
    public function setAggregate($aggregate)
    {
        $this->aggregate = $aggregate;
        return $this;
    }

    /**
     * Gets as builtIn.
     *
     * @return bool
     */
    public function getBuiltIn()
    {
        return $this->builtIn;
    }

    /**
     * Sets a new builtIn.
     *
     * @param  bool $builtIn
     * @return self
     */
    public function setBuiltIn($builtIn)
    {
        $this->builtIn = $builtIn;
        return $this;
    }

    /**
     * Gets as storeFunctionName.
     *
     * @return string
     */
    public function getStoreFunctionName()
    {
        return $this->storeFunctionName;
    }

    /**
     * Sets a new storeFunctionName.
     *
     * @param  string $storeFunctionName
     * @return self
     */
    public function setStoreFunctionName($storeFunctionName)
    {
        $this->storeFunctionName = $storeFunctionName;
        return $this;
    }

    /**
     * Gets as niladicFunction.
     *
     * @return bool
     */
    public function getNiladicFunction()
    {
        return $this->niladicFunction;
    }

    /**
     * Sets a new niladicFunction.
     *
     * @param  bool $niladicFunction
     * @return self
     */
    public function setNiladicFunction($niladicFunction)
    {
        $this->niladicFunction = $niladicFunction;
        return $this;
    }

    /**
     * Gets as isComposable.
     *
     * @return bool
     */
    public function getIsComposable()
    {
        return $this->isComposable;
    }

    /**
     * Sets a new isComposable.
     *
     * @param  bool $isComposable
     * @return self
     */
    public function setIsComposable($isComposable)
    {
        $this->isComposable = $isComposable;
        return $this;
    }

    /**
     * Gets as parameterTypeSemantics.
     *
     * @return string
     */
    public function getParameterTypeSemantics()
    {
        return $this->parameterTypeSemantics;
    }

    /**
     * Sets a new parameterTypeSemantics.
     *
     * @param  string $parameterTypeSemantics
     * @return self
     */
    public function setParameterTypeSemantics($parameterTypeSemantics)
    {
        $this->parameterTypeSemantics = $parameterTypeSemantics;
        return $this;
    }

    /**
     * Gets as schema.
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->schema;
    }

    /**
     * Sets a new schema.
     *
     * @param  string $schema
     * @return self
     */
    public function setSchema($schema)
    {
        $this->schema = $schema;
        return $this;
    }

    /**
     * Gets as documentation.
     *
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType
     */
    public function getDocumentation()
    {
        return $this->documentation;
    }

    /**
     * Sets a new documentation.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TDocumentationType $documentation
     * @return self
     */
    public function setDocumentation(TDocumentationType $documentation)
    {
        $this->documentation = $documentation;
        return $this;
    }

    /**
     * Adds as parameter.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TParameterType $parameter
     * @return self
     */
    public function addToParameter(TParameterType $parameter)
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
     * @return \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TParameterType[]
     */
    public function getParameter()
    {
        return $this->parameter;
    }

    /**
     * Sets a new parameter.
     *
     * @param  \AlgoWeb\ODataMetadata\MetadataV3\edm\ssdl\TParameterType[] $parameter
     * @return self
     */
    public function setParameter(array $parameter)
    {
        $this->parameter = $parameter;
        return $this;
    }

    /**
     * Adds as commandText.
     *
     * @param  string $commandText
     * @return self
     */
    public function addToCommandText($commandText)
    {
        $this->commandText[] = $commandText;
        return $this;
    }

    /**
     * isset commandText.
     *
     * @param  scalar $index
     * @return bool
     */
    public function issetCommandText($index)
    {
        return isset($this->commandText[$index]);
    }

    /**
     * unset commandText.
     *
     * @param  scalar $index
     * @return void
     */
    public function unsetCommandText($index)
    {
        unset($this->commandText[$index]);
    }

    /**
     * Gets as commandText.
     *
     * @return string[]
     */
    public function getCommandText()
    {
        return $this->commandText;
    }

    /**
     * Sets a new commandText.
     *
     * @param  string $commandText
     * @return self
     */
    public function setCommandText(array $commandText)
    {
        $this->commandText = $commandText;
        return $this;
    }
}
