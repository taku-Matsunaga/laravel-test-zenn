<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Post;
use App\Models\User;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    public function test_factoryのテスト()
    {
        $users = User::factory(3)->create();
        Post::factory(10)->random()->recycle($users)->create();

        $this->dumpdb();
    }
}
