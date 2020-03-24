<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\CodePoint;

/**
 * Represents Unicode's Single Code Point.
 *
 * @package CarrotRakko\Unicode\CodePoint
 */
final class CodePoint
{
    /**
     * @var int Internal Slot for Unicode Code Point.
     */
    private $code_point;

    /**
     * CodePoint constructor.
     *
     * @param int $code_point
     * @throws \DomainException
     */
    public function __construct(int $code_point)
    {
        $this->validate($code_point);

        $this->code_point = $code_point;
    }

    /**
     * Simple Getter.
     *
     * @return int
     */
    public function getCodePoint(): int
    {
        return $this->code_point;
    }

    /**
     * Laziest Validator.
     *
     * @param int $code_point
     * @return void
     * @throws \DomainException
     */
    private function validate(int $code_point): void
    {
        if ((0x0000 <= $code_point) && ($code_point <= 0x10FFFF)) {
            return;
        }
        throw new \DomainException(
            sprintf(
                '$code_point must be between 0x0000 and 0x10FFFF. $code_point = 0x%s',
                str_pad(
                    dechex($code_point),
                    4,
                    '0',
                    STR_PAD_LEFT
                )
            )
        );
    }
}
