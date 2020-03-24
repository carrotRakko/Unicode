<?php

declare(strict_types=1);

namespace CarrotRakko\Unicode;

require_once './vendor/autoload.php';

use CarrotRakko\Unicode\Byte\Byte;
use CarrotRakko\Unicode\CodePoint\CodePoint;
use CarrotRakko\Unicode\CodePoint\CodePoints;
use CarrotRakko\Unicode\Converter\UTF8;

foreach (range(0x0000, 0x10FFFF) as $code_point) {
    var_dump($code_point);

    if ((0xD800 <= $code_point) && ($code_point <= 0xDFFF)) {
        continue;
    }

    if (
        array_map(
            function (Byte $byte): int {
                return $byte->getByte();
            },
            UTF8::encode(new CodePoints([new CodePoint($code_point)]))->getBytes()
        ) === array_map(
            function (string $byte): int {
                return ord($byte);
            },
            str_split(mb_chr($code_point, 'UTF-8'))
        )
    ) {
        continue;
    }

    echo 'バゴーン: ' . $code_point;

    exit;
}

