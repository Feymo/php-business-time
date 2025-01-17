<?php

namespace BusinessTime;

use Iterator;
use LengthException;

/**
 * Iterates until a limit is reached, then throws an exception.
 */
class LimitedIterator implements Iterator
{
    const DEFAULT_ITERATION_LIMIT = 10000;

    public function __construct(private int $iterationLimit = self::DEFAULT_ITERATION_LIMIT, private int $iterations = 0)
    {
    }

    /**
     * Return the current element.
     *
     * @link  https://php.net/manual/en/iterator.current.php
     *
     * @return mixed Can return any type.
     *
     * @since 5.0.0
     */
    public function current()
    {
        return $this->iterations;
    }

    /**
     * Move forward to next element.
     *
     * @link  https://php.net/manual/en/iterator.next.php
     *
     * @return void Any returned value is ignored.
     *
     * @since 5.0.0
     */
    public function next(): void
    {
        $this->iterations++;
        if ($this->iterations > $this->iterationLimit) {
            throw new LengthException(
                "Iteration limit of {$this->iterationLimit} reached."
            );
        }
    }

    /**
     * Return the key of the current element.
     *
     * @link  https://php.net/manual/en/iterator.key.php
     *
     * @return mixed scalar on success, or null on failure.
     *
     * @since 5.0.0
     */
    public function key(): ?int
    {
        return $this->iterations;
    }

    /**
     * Checks if current position is valid.
     *
     * @link  https://php.net/manual/en/iterator.valid.php
     *
     * @return bool The return value will be casted to boolean and then evaluated.
     *              Returns true on success or false on failure.
     *
     * @since 5.0.0
     */
    public function valid(): bool
    {
        return $this->iterations <= $this->iterationLimit;
    }

    /**
     * Rewind the Iterator to the first element.
     *
     * @link  https://php.net/manual/en/iterator.rewind.php
     *
     * @return void Any returned value is ignored.
     *
     * @since 5.0.0
     */
    public function rewind(): void
    {
        $this->iterations = 0;
    }
}
