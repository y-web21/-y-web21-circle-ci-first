<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Article;
use App\Models\UploadImage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PosterPagesControllerTest extends TestCase
{
    use RefreshDatabase;
    private $user;
    private $image;
    private $poster_home = '/post';
    private $table_name = 'articles';

    public function setup(): void
    {
        parent::setUp();
        // $this->withoutExceptionHandling();
        $this->seed('UploadImageSeeder');
        $this->image = UploadImage::first();
        $this->article = Article::factory()->create();
        $this->user = User::factory()->create();
        Auth::login($this->user);
    }

    public function test_index()
    {
        $response = $this->get(route('post.index'));
        $response->assertStatus(200)
            ->assertViewIs('poster.my_posts');

        Auth::logout($this->user);
        $response = $this->get(route('post.index'));
        $response->assertRedirect('login');

        Auth::login($this->user);
    }

    public function test_create()
    {
        $response = $this->withSession([
            'editing_title' => 'test',
            'editing_content' => 'test',
            'editing_status' => 'test',
            'transition_source' => 'test',
        ])
            ->get(route('post.new_post'));

        $response->assertStatus(200)
            ->assertViewIs('poster.article_new_post')
            ->assertDontSeeText('投稿画像')
            ->assertSessionMissing('editing_title')
            ->assertSessionMissing('editing_content')
            ->assertSessionMissing('editing_status')
            ->assertSessionMissing('transition_source');
    }

    public function test_store()
    {
        $post_data = [
            'title' => 'test_title',
            'content' => 'test_content',
            'status_id' => '1',
            'image_id' => '1',
        ];

        $this->post(route('post.store'), $post_data)
            ->assertRedirect($this->poster_home);

        $this->assertDatabaseHas($this->table_name, [
            'title' => $post_data['title'],
            'content' => $post_data['content'],
            'author' => Auth::user()->id,
            'status' => $post_data['status_id'],
            'featured_image_id' => $post_data['image_id'],
        ]);

        $record = Article::find(Article::all()->count());

        $this->get($this->poster_home)
            ->assertSee($post_data['title'])
            ->assertSee($post_data['content'])
            ->assertSee($record->status_name);

        $record->delete();
    }

    public function test_edit()
    {
        $response = $this->withSession([
            'editing_title' => 'test',
            'editing_content' => 'test',
            'editing_status' => 'test',
            'transition_source' => 'test',
        ])
            ->get(route('post.edit',  ['post' => 1]));

        $response->assertViewIs('poster.article_edit')
            ->assertSessionMissing('editing_title')
            ->assertSessionMissing('editing_content')
            ->assertSessionMissing('editing_status')
            ->assertSessionMissing('transition_source');
    }

    public function test_update()
    {
        $record = Article::factory()->create();

        $post_data = [
            'title' => 'test_title',
            'content' => 'test_content',
            'status_id' => '1',
            'image_id' => '1',
        ];

        $this->patch(route('post.update', ['post' => $record->id]), $post_data)
            ->assertRedirect($this->poster_home);

        $this->assertDatabaseHas($this->table_name, [
            'title' => $post_data['title'],
            'content' => $post_data['content'],
            'status' => $post_data['status_id'],
            'featured_image_id' => $post_data['image_id'],
        ]);

        $record->delete();
    }

    public function test_destroy()
    {
        $record = Article::factory()->create();
        $response = $this->delete(route('post.destroy', ['post' => $record->id]));
        $response->assertRedirect($this->poster_home);
        $this->assertDeleted($record);
    }
}
