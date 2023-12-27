<?php

namespace App\Helpers;

use Illuminate\Support\Str;

final class RandomHelper
{
    /**
     * Возвращает случайную строку длиной $size.
     *
     * @param  int  $size Длина случайной строки
     * @param  bool  $onlyNumbers Только цифры участвуют в случайной строке
     */
    public static function string(int $size, bool $onlyNumbers = false): string
    {
        if ($size < 1) {
            $size = 1;
        }

        return $onlyNumbers
            ? substr(str_shuffle('0123456789'), 0, $size)
            : Str::random($size);
    }
}
