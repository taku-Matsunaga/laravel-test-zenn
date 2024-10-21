<?php

namespace Tests\Feature;

use App\StrRandom;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Tests\TestCase;

class WelcomePageTest extends TestCase
{
    public function test_welcomeページで例外が起こる()
    {
        $this->withoutExceptionHandling();

        $this->expectException(\OutOfRangeException::class);

        $this->get('/');
    }

    public function test_秘密鍵が出力される()
    {
        $mock = \Mockery::mock(StrRandom::class);
        $mock->shouldReceive('get')->once()->with(10)->andReturn('HELLOWORLD');
        $this->instance(StrRandom::class, $mock);

        $response = $this->get('/');

        $response
            ->assertOk()
            ->assertSee('あなたの秘密キーは、HELLOWORLDです。');
    }

    public function test_クリスマスの日は、メリークリスマス！と表示される()
    {
        Carbon::setTestNow('2020-12-25');

        $this->get('')
            ->assertOk()
            ->assertSee('メリークリスマス！');
    }

    public function test_クリスマス以外の日は、メリークリスマス！とは表示されない()
    {
        Carbon::setTestNow('2020-12-20');

        $this->get('')
            ->assertOk()
            ->assertDontSee('メリークリスマス！');
    }
}
