<?php

declare(strict_types=1);

namespace AlgoWeb\ODataMetadata\Structure;

use Iterator;

/**
 * @implements \Iterator<string|int, mixed>
 */
class HashSetInternal implements Iterator, \Countable
{
    /** @var array<mixed> */
    private $wrappedDictionary = [];

    /**
     * HashSetInternal constructor.
     * @param iterable<mixed>|null $wrappedDictionary
     */
    public function __construct(iterable $wrappedDictionary = null)
    {
        if (null !== $wrappedDictionary) {
            foreach ($wrappedDictionary as $item) {
                $this->wrappedDictionary[] = $item;
            }
        }
    }

    /**
     * @param mixed $value
     * @return bool
     */
    public function add($value): bool
    {
        if (in_array($value, $this->wrappedDictionary)) {
            return false;
        }
        $this->wrappedDictionary[] = $value;
        return true;
    }

    /**
     * @param mixed $value
     * @return void
     */
    public function remove($value): void
    {
        $index = array_search($value, $this->wrappedDictionary);
        unset($this->wrappedDictionary[$index]);
    }

    /**
     * @param string|int $key
     * @param mixed|null $output
     * @return bool
     */
    public function tryGetValue($key, &$output): bool
    {
        if (isset($this->wrappedDictionary[$key])) {
            $output = $this->wrappedDictionary[$key];
            return true;
        }
        return false;
    }

    /**
     * @param mixed $item
     * @return bool
     */
    public function contains($item): bool
    {
        return in_array($item, $this->wrappedDictionary);
    }

    /**
     * Return the current element.
     * @see https://php.net/manual/en/iterator.current.php
     * @return mixed can return any type
     * @since 5.0.0
     */
    public function current()
    {
        return current($this->wrappedDictionary);
    }

    /**
     * Move forward to next element.
     * @see https://php.net/manual/en/iterator.next.php
     * @return void any returned value is ignored
     * @since 5.0.0
     */
    public function next()
    {
        next($this->wrappedDictionary);
    }

    /**
     * Return the key of the current element.
     * @see https://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure
     * @since 5.0.0
     */
    public function key()
    {
        return key($this->wrappedDictionary);
    }

    /**
     * Checks if current position is valid.
     * @see https://php.net/manual/en/iterator.valid.php
     * @return bool The return value will be casted to boolean and then evaluated.
     *              Returns true on success or false on failure.
     * @since 5.0.0
     */
    public function valid()
    {
        return key($this->wrappedDictionary) !== null;
    }

    /**
     * Rewind the Iterator to the first element.
     * @see https://php.net/manual/en/iterator.rewind.php
     * @return void any returned value is ignored
     * @since 5.0.0
     */
    public function rewind()
    {
        reset($this->wrappedDictionary);
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->wrappedDictionary);
    }
}
