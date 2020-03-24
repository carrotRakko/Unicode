<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\Byte;

/**
 * Represents Single Byte.
 *
 * @package CarrotRakko\Unicode\Byte
 */
final class Byte
{
    /**
     * @var int Internal Slot for Byte.
     */
    private $byte;

    /**
     * Byte constructor.
     *
     * @param int $byte
     */
    public function __construct(int $byte)
    {
        $this->validate($byte);

        $this->byte = $byte;
    }

    /**
     * Simple Getter.
     *
     * @return int
     */
    public function getByte(): int
    {
        return $this->byte;
    }

    /**
     * Simple Validator.
     *
     * @param int $byte
     */
    private function validate(int $byte): void
    {
        if ((0x00 <= $byte) && ($byte <= 0xFF)) {
            return;
        }
        throw new \DomainException(
            sprintf(
                '$byte must be between 0x00 and 0xFF. $byte = 0x%s',
                str_pad(
                    dechex($byte),
                    2,
                    '0',
                    STR_PAD_LEFT
                )
            )
        );
    }
}
