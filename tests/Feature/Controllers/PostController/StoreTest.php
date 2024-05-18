<?php

use App\Models\Post;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\post;

beforeEach(function () {
    $this->validData = [
        'title' => 'Hello World',
        'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque commodo tortor eros, vel auctor dolor scelerisque nec. Nam fermentum, lorem vel auctor venenatis, felis ante ullamcorper risus, ultrices ultrices magna turpis ac elit. Nullam sit amet hendrerit neque. Fusce id volutpat ex. Maecenas in nunc metus. Pellentesque aliquet, enim sit amet ornare tincidunt, justo neque cursus metus, in laoreet tortor lectus eget lectus. Vestibulum vulputate massa eget neque tristique mattis vitae id ante. Praesent velit risus, vehicula vitae auctor ut, pellentesque at justo. Sed quis orci felis. In luctus lacinia molestie. In volutpat semper dapibus. Vestibulum quis massa nulla. Maecenas.',
    ];
});

it('requires authentication', function () {
    post(route('posts.store'))->assertRedirect(route('login'));
});

it('stores a post', function () {
    $user = User::factory()->create();

    actingAs($user)->post(route('posts.store'), $this->validData);

    $this->assertDatabaseHas(Post::class, [
        ...$this->validData,
        'user_id' => $user->id,
    ]);
});

it('redirects to the post show page', function () {
    $user = User::factory()->create();

    actingAs($user)
        ->post(route('posts.store'), $this->validData)
        ->assertRedirect(Post::latest('id')->first()->showRoute());
});

it('requires valid data', function (array $badData, array|string $errors) {
    actingAs(User::factory()->create())
        ->post(route('posts.store'), [...$this->validData, ...$badData])
        ->assertInvalid($errors);
})->with([
    [['title' => null], 'title'],
    [['title' => true], 'title'],
    [['title' => 1], 'title'],
    [['title' => 1.5], 'title'],
    [['title' => str_repeat('a', 121)], 'title'],
    [['title' => str_repeat('a', 9)], 'title'],
    [['body' => null], 'body'],
    [['body' => true], 'body'],
    [['body' => 1], 'body'],
    [['body' => 1.5], 'body'],
    [['body' => str_repeat('a', 10_001)], 'body'],
    [['body' => str_repeat('a', 99)], 'body'],
]);


