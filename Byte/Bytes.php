<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\Byte;

/**
 * Represents Sequence of Big Endian Bytes
 *
 * @package CarrotRakko\Unicode\Byte
 */
final class Bytes
{
    /**
     * @var int[] Internal Slot for Sequence of Big Endian Bytes.
     */
    private $bytes = [];

    /**
     * Bytes constructor.
     *
     * @param array $bytes
     * @throws \DomainException
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
     * @return void
     * @throws \DomainException
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
