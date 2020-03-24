<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\CodePoint;

/**
 * Represent Sequence of Code Points.
 *
 * @package CarrotRakko\Unicode\CodePoint
 */
final class CodePoints
{
    /**
     * @var int[] Internal Slot for Sequence of Code Points.
     */
    private $code_points = [];

    /**
     * CodePoints constructor.
     *
     * @param array $code_points
     * @throws \DomainException
     */
    public function __construct(array $code_points)
    {
        $this->validate($code_points);

        foreach ($code_points as $code_point) {
            $this->code_points[] = new CodePoint($code_point);
        }
    }

    /**
     * Simple Getter.
     *
     * @return int[]
     */
    public function getCodePoints(): array
    {
        return $this->code_points;
    }

    /**
     * Simple Validator.
     *
     * @param array $code_points
     * @return void
     * @throws \DomainException
     */
    private function validate(array $code_points): void
    {
        foreach ($code_points as $code_point) {
            if (!is_int($code_point)) {
                throw new \DomainException(
                    sprintf(
                        'Each $code_point in $code_points must be type of integer. gettype($code_point) = %s.',
                        gettype($code_point)
                    )
                );
            }
        }
    }
}
