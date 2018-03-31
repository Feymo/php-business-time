<?php

namespace BusinessTime\Constraint\Composite;

use BusinessTime\Constraint\BusinessTimeConstraint;
use BusinessTime\Tests\Unit\Constraint\Composite\CompositeAllTest;
use DateTime;

/**
 * A set of constraints that matches if all of the included constraints match.
 *
 * This is equivalent to logical AND.
 *
 * @see CompositeAllTest
 */
class All implements BusinessTimeConstraint
{
    use Combinations;

    /** @var BusinessTimeConstraint[] */
    private $constraints;

    /**
     * @param BusinessTimeConstraint[] $constraints
     */
    public function __construct(BusinessTimeConstraint ...$constraints)
    {
        $this->constraints = $constraints;
    }

    /**
     * @param DateTime $time
     *
     * @return bool
     */
    public function isBusinessTime(DateTime $time): bool
    {
        foreach ($this->constraints as $constraint) {
            if (!$constraint->isBusinessTime($time)) {
                return false;
            }
        }

        return true;
    }
}