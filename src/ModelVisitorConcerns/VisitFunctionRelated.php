<?php

declare(strict_types=1);


namespace AlgoWeb\ODataMetadata\ModelVisitorConcerns;

use AlgoWeb\ODataMetadata\EdmModelVisitor;
use AlgoWeb\ODataMetadata\Interfaces\IFunctionParameter;

/**
 * Trait VisitFunctionRelated.
 * @package AlgoWeb\ODataMetadata\ModelVisitorConcerns
 * @mixin EdmModelVisitor
 */
trait VisitFunctionRelated
{
    /**
     * @param IFunctionParameter[] $parameters
     */
    public function VisitFunctionParameters(?array $parameters): void
    {
        self::VisitCollection($parameters, [$this, 'ProcessFunctionParameter']);
    }
    abstract public function ProcessFunctionParameter(IFunctionParameter $parameter): void;
}
