<?php

namespace Tests\Unit;

use App\StrRandom;
use PHPUnit\Framework\TestCase;

class StrRandomTest extends TestCase
{
    public function test_strrandom、指定の文字数を返す()
    {
        $random = new StrRandom();

        $str5 = $random->get(5);
        $str10 = $random->get(10);

        $this->assertSame(5, strlen($str5));
        $this->assertSame(10, strlen($str10));
    }

    public function test_strrandom、ランダムな文字列を返す()
    {
        $random = new StrRandom();

        $str1 = $random->get(10);
        $str2 = $random->get(10);

        $this->assertFalse($str1 === $str2);
    }

    public function test_strrandom、文字数範囲外の為、例外発生()
    {
        $this->expectException(\OutOfRangeException::class);
        $this->expectExceptionMessage('文字数は1から100の間で指定してください');

        $random = new StrRandom();
        $random->get(999);
    }
}
