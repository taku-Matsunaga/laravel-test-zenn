<?php

namespace Tests\Feature\Http\Controllers;

use App\Http\Middleware\IpLimit;
use App\Mail\BlogPosted;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Depends;
use PHPUnit\Framework\Attributes\TestWith;
use Tests\TestCase;

class PostManageControllerTest extends TestCase
{
    public function test_自分の投稿一覧のみ表示()
    {
        $me = $this->login();

        Post::factory()->for($me)->create(['title' => '私のブログタイトル']);
        Post::factory()->create(['title' => '他人様のブログタイトル']);

        $response = $this->get('members/posts');

        $response
            ->assertOk()
            ->assertSee('私のブログタイトル')
            ->assertDontSee('他人様のブログタイトル');
    }

    public function test_自分の新規ブログ投稿ができる()
    {
        Mail::fake();

        $me = User::factory()->create([
            'name' => '織田信長',
            'email' => 'oda@example.net',
        ]);

        $this->login($me);

        $validData = [
            'title' => '私のブログタイトル',
            'body' => '私のブログ本文',
            'status' => '1',
        ];

        $response = $this->post(route('posts.store'), $validData);

        $response->assertRedirect(route('posts.edit', Post::first()));

        // コントローラでメール送信処理がなされた事を確認
        Mail::assertSent(BlogPosted::class);

        $this->assertDatabaseHas(Post::class,
            [...$validData, 'user_id' => $me->id]
        );

        return [$me, Post::first()];
    }

    public function test_自分のブログの編集画面は開ける()
    {
        $post = Post::factory()->create();

        $this->login($post->user);

        $this->get(route('posts.edit', $post))
            ->assertOk();
    }

    public function test_他人様のブログの編集画面は開けない()
    {
        $post = Post::factory()->create();

        $this->login();

        $this->get(route('posts.edit', $post))
            ->assertForbidden();
    }

    #[TestWith(["0"])]
    #[TestWith(["1"])]
    public function test_自分のブログは更新できますよ(string $status)
    {
        $validData = $this->validData([
            'status' => $status,
        ]);

        $post = Post::factory()->create();

        $this->login($post->user);

        $this->put(route('posts.update', $post), $validData)
            ->assertRedirect(route('posts.edit', $post));

        $this->get(route('posts.edit', $post))
            ->assertSee('ブログを更新しました');

        $this->assertDatabaseHas('posts', $validData);
        $this->assertDatabaseCount('posts', 1);
    }

    public function test_他人様のブログは更新できない()
    {
        $validData = $this->validData();

        $post = Post::factory()->create(['title' => '元のブログタイトル']);

        $this->login();

        $this->put(route('posts.update', $post), $validData)
            ->assertForbidden();

        $this->assertSame('元のブログタイトル', $post->fresh()->title);
    }

    public function test_自分のブログは削除できる()
    {
        $this->withoutMiddleware(IpLimit::class);

        $post = Post::factory()->create();

        $this->login($post->user);

        $this->delete(route('posts.destroy', $post))
            ->assertRedirect(route('posts.index'));

        $this->assertModelMissing($post);
    }

    public function test_他人様のブログを削除はできない()
    {
        $post = Post::factory()->create();

        $this->login();

        $this->delete(route('posts.destroy', $post))
            ->assertForbidden();

        $this->assertModelExists($post);
    }

    private function validData(array $overrides = [])
    {
        return array_merge([
            'title' => '新タイトル',
            'body' => '新本文',
            'status' => '1',
        ], $overrides);
    }

    public function test_投稿一覧、本文でヒット()
    {
        $me = $this->login();

        Post::factory()->for($me)->createMany([
            ['title' => '信長のタイトル', 'body' => '信長の本文'],
            ['title' => '家康のタイトル', 'body' => '家康の本文'],
        ]);

        $response = $this->get('members/posts?kword=信長の本');

        $response
            ->assertOk()
            ->assertSee('信長のタイトル')
            ->assertDontSee('家康のタイトル');
    }

    public function test_投稿一覧、本文でヒットその2()
    {
        $me = $this->login();

        Post::factory()->for($me)->createMany([
            ['body' => '信長の本文'],
            ['body' => '家康の本文'],
        ]);

        $response = $this->get('members/posts?kword=信長の本');

        // パターン1
        $response->assertViewHas('posts',
            Post::where('body', 'LIKE', '%信長の本%')->get()
        );

        // パターン2
        $response->assertviewHas('posts.0.body', '信長の本文');
        $response->assertviewHas('posts', fn ($posts) => $posts->count() === 1);

        // パターン3
        $this->assertTrue($response['posts']->contains('body', '信長の本文'));
        $this->assertFalse($response['posts']->contains('body', '家康の本文'));
    }

    public function test_ブログ登録時の入力チェック()
    {
        $url = route('posts.store');

        $this->login();

        app()->setLocale('testing');

        // 何も入力しないで送信した際は、リダイレクトされるのをまずは確認
        $this->post($url, [])->assertRedirect('/');

        // タイトルの入力チェック
        $this->post($url, ['title' => ''])->assertInvalid('title');
        $this->post($url, ['title' => ['aa' => 'bb']])->assertInvalid('title');
        $this->post($url, ['title' => str_repeat('a', 256)])->assertInvalid('title');

        // status の入力チェック
        $this->post($url, ['status' => ''])->assertInvalid('status');
        $this->post($url, ['status' => 'aa'])->assertInvalid('status');
        $this->post($url, ['status' => '3'])->assertInvalid('status');
    }

    #[Depends('test_自分の新規ブログ投稿ができる')]
    public function test_ブログ新規登録時のメール本文等の確認($args)
    {
        [$me, $post] = $args;

        $mailable = new BlogPosted($me, $post);
        $mailable->assertTo($me->email);
        $mailable->assertSeeInText('タイトル：'.$post->title);
    }
}
