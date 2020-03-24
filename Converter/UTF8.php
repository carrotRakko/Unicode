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

    /**
     * Convert Code Point into Sequence of Bytes.
     *
     * @param CodePoint $code_point
     * @return Bytes
     */
    private static function encodeCodePoint(CodePoint $code_point): Bytes
    {
        // `1 Byte` Letter.
        if ($code_point->getCodePoint() <= 0x007F) {
            return new Bytes([
                new Byte($code_point->getCodePoint()), // 0xxx xxxx
            ]);
        }

        // `2 Byte` Letter.
        if ($code_point->getCodePoint() <= 0x07FF) {
            return new Bytes([
                new Byte(($code_point->getCodePoint() >> 6) & 0b00011111 | 0b11000000), // 110x xxxx
                new Byte(($code_point->getCodePoint() >> 0) & 0b00111111 | 0b10000000), // 10xx xxxx
            ]);
        }

        // `3 Byte` Letter.
        if ($code_point->getCodePoint() <= 0xFFFF) {
            return new Bytes([
                new Byte(($code_point->getCodePoint() >> 12) & 0b00001111 | 0b11100000), // 1110 xxxx
                new Byte(($code_point->getCodePoint() >> 6)  & 0b00111111 | 0b10000000), // 10xx xxxx
                new Byte(($code_point->getCodePoint() >> 0)  & 0b00111111 | 0b10000000), // 10xx xxxx
            ]);
        }

        // `4 Byte` Letter.
        return new Bytes([
            new Byte(($code_point->getCodePoint() >> 18) & 0b00000111 | 0b11110000), // 1111 0xxx
            new Byte(($code_point->getCodePoint() >> 12) & 0b00111111 | 0b10000000), // 10xx xxxx
            new Byte(($code_point->getCodePoint() >> 6)  & 0b00111111 | 0b10000000), // 10xx xxxx
            new Byte(($code_point->getCodePoint() >> 0)  & 0b00111111 | 0b10000000), // 10xx xxxx
        ]);
    }
}
