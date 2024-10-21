<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    public function test_Userへの挨拶文()
    {
        $user = User::factory()->make(['name' => '与太郎']);

        $sentence = $user->greeting();

        $this->assertSame('与太郎さん、こんにちは！', $sentence);
    }

    public function test_UserのhasManyPosts()
    {
        $user = User::factory()->create();
        $post = Post::factory()->for($user)->create();

        $this->assertInstanceOf(Collection::class, $user->posts);
        $this->assertInstanceOf(Post::class, $user->posts->get(0));
    }
}
