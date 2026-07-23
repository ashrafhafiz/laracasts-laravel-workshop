<?php

use App\Models\Post;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('allows a profile to publish a post', function () {
    $profile = Profile::factory()->create();
    $post = Post::publish($profile, 'Hello, world!');

    expect($post->exists)->toBeTrue()
        ->and($post->profile->is($profile))->toBeTrue()
        ->and($post->parent_id)->toBeNull()
        ->and($post->repost_of_id)->toBeNull();
});

test('can reply to post', function () {
    $originalPost = Post::factory()->create();
    $replier = Profile::factory()->create();
    $reply = Post::reply($replier, $originalPost, 'Hello, world!');

    expect($reply->parent->is($originalPost))->toBeTrue()
        ->and($originalPost->replies)->toHaveCount(1);
});

test('can have many replies', function () {
    $originalPost = Post::factory()->create();
    $replies = Post::factory()->count(4)->reply($originalPost)->create();
    expect($replies->first()->parent->is($originalPost))->toBeTrue()
        ->and($originalPost->replies)->toHaveCount(4)
        ->and($originalPost->replies->contains($replies->first()))->toBeTrue();
});

test('can reply to a reply', function () {
    $originalPost = Post::factory()->create();
    $replier = Profile::factory()->create();
    $reply = Post::reply($replier, $originalPost, 'Hello, world!');
    $post = Post::reply($reply->profile, $reply, 'Hello, world!');

    expect($post->parent->is($reply))->toBeTrue()
        ->and($reply->parent->is($originalPost))->toBeTrue()
        ->and($originalPost->replies)->toHaveCount(1);
    expect($reply->parent->is($originalPost))->toBeTrue()
        ->and($originalPost->replies)->toHaveCount(1);
});

test('can create plain repost', function () {
    $originalPost = Post::factory()->create();
    $reposter = Profile::factory()->create();
    $repost = Post::repost($reposter, $originalPost);

    expect($repost->repostOf->is($originalPost))->toBeTrue()
        ->and($originalPost->reposts)->toHaveCount(1)
        ->and($repost->content)->toBeNull();
});

test('can have many reposts', function () {
    $originalPost = Post::factory()->create();
    $reposts = Post::factory()->count(4)->repost($originalPost)->create();
    expect($reposts->first()->repostOf->is($originalPost))->toBeTrue()
        ->and($originalPost->reposts)->toHaveCount(4)
        ->and($originalPost->reposts->contains($reposts->first()))->toBeTrue();
});

test('can create quoted repost', function () {
    $originalPost = Post::factory()->create();
    $reposter = Profile::factory()->create();
    $repost = Post::repost($reposter, $originalPost, 'Hello, world!');

    expect($repost->repostOf->is($originalPost))->toBeTrue()
        ->and($originalPost->reposts)->toHaveCount(1)
        ->and($repost->content)->toBe('Hello, world!');
});

test('prevent duplicate reposts', function () {
    $originalPost = Post::factory()->create();
    $reposter = Profile::factory()->create();
    $post = Post::repost($reposter, $originalPost);
    $repost2 = Post::repost($reposter, $originalPost);

    expect($post->exists)->toBeTrue()
        ->and($repost2->exists)->toBeTrue()
        ->and($post->is($repost2))->toBeTrue();
});

test('remove a repost', function () {
    $originalPost = Post::factory()->create();
    $reposter = Post::factory()->repost($originalPost)->create()->profile;

    $success = Post::removeRepost($originalPost, $reposter);

    expect($originalPost->reposts)->toHaveCount(0)
        ->and($success)->toBeTrue();
});
