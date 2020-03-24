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
     * @var CodePoint[] Internal Slot for Sequence of Code Points.
     */
    private $code_points;

    /**
     * CodePoints constructor.
     *
     * @param array $code_points
     * @throws \DomainException
     */
    public function __construct(array $code_points)
    {
        $this->validate($code_points);

        $this->code_points = $code_points;
    }

    /**
     * Simple Getter.
     *
     * @return CodePoint[]
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
            if (!is_object($code_point)) {
                throw new \DomainException(
                    sprintf(
                        'Each $code_point in $code_points must be type of object. gettype($code_point) = %s.',
                        gettype($code_point)
                    )
                );
            }
            if (!($code_point instanceof CodePoint)) {
                throw new \DomainException(
                    sprintf(
                        'Each $code_point in $code_points must be instance of CodePoint. get_class($code_point) = %s.',
                        get_class($code_point)
                    )
                );
            }
        }
    }
}
