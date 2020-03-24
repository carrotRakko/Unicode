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
     * @var Byte[] Internal Slot for Sequence of Big Endian Bytes.
     */
    private $bytes;

    /**
     * Bytes constructor.
     *
     * @param array $bytes
     * @throws \DomainException
     */
    public function __construct(array $bytes)
    {
        $this->validate($bytes);

        $this->bytes = $bytes;
    }

    /**
     * Simple Getter.
     *
     * @return Byte[]
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
            if (!is_object($byte)) {
                throw new \DomainException(
                    sprintf(
                        'Each $byte in $bytes must be type of object. gettype($byte) = %s.',
                        gettype($byte)
                    )
                );
            }
            if (!($byte instanceof Byte)) {
                throw new \DomainException(
                    sprintf(
                        'Each $byte in $bytes must be instance of Byte. get_class($byte) = %s.',
                        get_class($byte)
                    )
                );
            }
        }
    }
}
