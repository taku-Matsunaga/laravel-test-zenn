<?php

namespace App;

use Illuminate\Support\Str;

class StrRandom
{
    public function get(int $length)
    {
        if ($length < 1 || $length > 100) {
            throw new \OutOfRangeException('文字数は1から100の間で指定してください');
        }

        return Str::random($length);
    }
}
