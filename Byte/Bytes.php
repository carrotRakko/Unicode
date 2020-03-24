<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\Byte;

/**
 * Represents Big Endian Byte Sequence
 *
 * @package CarrotRakko\Unicode\Byte
 */
final class Bytes
{
    /**
     * @var int[] Internal Slot for Big Endian Byte Sequence.
     */
    private $bytes = [];

    /**
     * Bytes constructor.
     *
     * @param array $bytes
     */
    public function __construct(array $bytes)
    {
        $this->validate($bytes);

        foreach ($bytes as $byte) {
            $this->bytes[] = new Byte($byte);
        }
    }

    /**
     * Simple Getter.
     *
     * @return int[]
     */
    public function getBytes(): array
    {
        return $this->bytes;
    }

    /**
     * Simple Validator.
     *
     * @param array $bytes
     */
    private function validate(array $bytes): void
    {
        foreach ($bytes as $byte) {
            if (!is_int($byte)) {
                throw new \DomainException(
                    sprintf(
                        'Each $byte in $bytes must be type of integer. gettype($byte) = %s.',
                        gettype($byte)
                    )
                );
            }
        }
    }
}
