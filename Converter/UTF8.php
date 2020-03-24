<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode\Converter;

use CarrotRakko\Unicode\Byte\Byte;
use CarrotRakko\Unicode\Byte\Bytes;
use CarrotRakko\Unicode\CodePoint\CodePoint;
use CarrotRakko\Unicode\CodePoint\CodePoints;

/**
 * UTF8 Tools.
 *
 * @package CarrotRakko\Unicode\Converter
 */
final class UTF8
{
    /**
     * Convert Sequence of Code Points into Sequence of Bytes.
     *
     * @param CodePoints $code_points
     * @return Bytes
     */
    public static function encode(CodePoints $code_points): Bytes
    {
        return new Bytes(
            array_merge(
                [],
                ...array_map(
                    function (CodePoint $code_point): array {
                        return self::encodeCodePoint($code_point)->getBytes();
                    },
                    $code_points->getCodePoints()
                )
            )
        );
    }

    private static function encodeCodePoint(CodePoint $code_point): Bytes
    {
        // `1 Byte` Letter.
        if ($code_point->getCodePoint() <= 0x007F) {
            return new Bytes([
                new Byte($code_point->getCodePoint()),
            ]);
        }

        // `2 Byte` Letter.
        if ($code_point->getCodePoint() <= 0x07FF) {
            return new Bytes([
                new Byte(
                    ($code_point->getCodePoint() >> 6)
                    & 0b00011111
                    | 0b11000000
                ),
                new Byte(
                    ($code_point->getCodePoint() >> 0)
                    & 0b00111111
                    | 0b10000000
                ),
            ]);
        }

        // `3 Byte` Letter.
        if ($code_point->getCodePoint() <= 0xFFFF) {
            return new Bytes([
                new Byte(
                    ($code_point->getCodePoint() >> 12)
                    & 0b00001111
                    | 0b11100000
                ),
                new Byte(
                    ($code_point->getCodePoint() >> 6)
                    & 0b00111111
                    | 0b10000000
                ),
                new Byte(
                    ($code_point->getCodePoint() >> 0)
                    & 0b00111111
                    | 0b10000000
                ),
            ]);
        }

        // `4 Byte` Letter.
        return new Bytes([
            new Byte(
                ($code_point->getCodePoint() >> 18)
                & 0b00000111
                | 0b11110000
            ),
            new Byte(
                ($code_point->getCodePoint() >> 12)
                & 0b00111111
                | 0b10000000
            ),
            new Byte(
                ($code_point->getCodePoint() >> 6)
                & 0b00111111
                | 0b10000000
            ),
            new Byte(
                ($code_point->getCodePoint() >> 0)
                & 0b00111111
                | 0b10000000
            ),
        ]);
    }
}
