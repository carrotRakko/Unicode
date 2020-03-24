<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode;

use CarrotRakko\Unicode\Byte\Byte;
use CarrotRakko\Unicode\CodePoint\CodePoint;
use CarrotRakko\Unicode\CodePoint\CodePoints;
use CarrotRakko\Unicode\Converter\UTF8;

require_once './vendor/autoload.php';

if (!isset($argv) || !is_array($argv)) {
    throw new \RuntimeException('Unexpected Environment!!!!');
}

$code_point_strings = array_slice($argv, 1);

foreach ($code_point_strings  as $code_point_string) {
    if (preg_match('/\A(?:0|(?:[1-9]\d*))\z/', $code_point_string) === 0) {
        throw new \DomainException(
            sprintf(
                'Each $code_point_string of array_slice($argv, 1) must match pattern of /\A(?:0|(?:[1-9]\d*))\z/. $code_point_string = %s',
                $code_point_string
            )
        );
    }
}

$bytes = UTF8::encode(
    new CodePoints(
        array_map(
            function (string $code_point_string): CodePoint {
                return new CodePoint((int)$code_point_string);
            },
            $code_point_strings
        )
    )
);

echo implode(
    ' ',
    array_map(
        function (Byte $byte): string {
            return (string)($byte->getByte());
        },
        $bytes->getBytes()
    )
);
