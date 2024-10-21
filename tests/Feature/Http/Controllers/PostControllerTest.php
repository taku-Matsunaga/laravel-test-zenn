<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostControllerTest extends TestCase
{
    public function test_公開の投稿は表示され、非公開の投稿は表示されない()
    {
        Post::factory()->create(['title' => '公開中のブログタイトル！']);
        Post::factory()->closed()->create(['title' => '非公開のブログタイトル！']);

        $response = $this->get('posts');

        $response->assertOk()
            ->assertSee('公開中のブログタイトル！')
            ->assertDontSee('非公開のブログタイトル！');
    }
}
