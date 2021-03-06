<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Edm\Validation;

use AlgoWeb\ODataMetadata\Asserts;
use AlgoWeb\ODataMetadata\Interfaces\IEdmElement;
use AlgoWeb\ODataMetadata\Interfaces\ILocation;
use AlgoWeb\ODataMetadata\Interfaces\IModel;
use ReflectionFunction;
use ReflectionMethod;
use ReflectionNamedType;

/**
 * Context that records errors reported by validation rules.
 *
 * @package AlgoWeb\ODataMetadata\Edm\Validation
 */
final class ValidationContext
{
    /**
     * @var EdmError[]
     */
    private $errors = [];
    /**
     * @var IModel
     */
    private $model;
    /**
     * @var callable(object): bool
     */
    private $isBad;
    /** @noinspection PhpDocMissingThrowsInspection  throws only in assert*/

    /**
     * ValidationContext constructor.
     * @param IModel                      $model
     * @param callable(IEdmElement): bool $isBad
     *
     * @throws \ReflectionException
     */
    public function __construct(IModel $model, callable $isBad)
    {
        assert(
            Asserts::assertSignatureMatches(
                function (/** @scrutinizer ignore-unused */IEdmElement $one): bool {
                    return false;
                },
                $isBad,
                '$isBad'
            )
        );

        $stem           = is_array($isBad) ? new ReflectionMethod(...$isBad) : new ReflectionFunction($isBad);
        $stemReturnType = $stem->getReturnType();
        $stemName       = $stemReturnType instanceof ReflectionNamedType ?
            $stemReturnType->getName() :
            strval($stemReturnType);
        $stemParmType = $stem->getParameters()[0]->getType();
        $stemParmName = $stemParmType instanceof ReflectionNamedType ?
            $stemParmType->getName() :
            strval($stemParmType);

        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts. */
        assert(
            IEdmElement::class === $stemParmName,
            '$isBad should be a callable taking one parameter of Type IEdmElement'
        );
        /* @noinspection PhpUnhandledExceptionInspection suppressing exceptions for asserts. */
        assert(
            'bool' === $stemName,
            '$isBad should be a callable returning a boolean'
        );
        $this->model = $model;
        $this->isBad = $isBad;
    }

    /**
     * @return IModel gets the model being validated
     */
    public function getModel(): IModel
    {
        return $this->model;
    }

    /**
     * @return EdmError[]
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    /**
     * Method returns true if the element is known to have structural errors associated with it.
     *
     * @param  IEdmElement $element the element to test
     * @return bool        true if the element has structural errors associated with it
     */
    public function checkIsBad(IEdmElement $element): bool
    {
        $callable = $this->isBad;
        return $callable($element);
    }
    /**
     * Register an error with the validation context.
     *
     * @param ILocation    $location     location of the error
     * @param EdmErrorCode $errorCode    value representing the error
     * @param string       $errorMessage message text describing the error
     */
    public function addError(ILocation $location, EdmErrorCode $errorCode, string $errorMessage): void
    {
        $this->addRawError(new EdmError($location, $errorCode, $errorMessage));
    }

    /**
     * Register an error with the validation context.
     *
     * @param EdmError $error error to register
     */
    public function addRawError(EdmError $error): void
    {
        $this->errors[] = $error;
    }
}
