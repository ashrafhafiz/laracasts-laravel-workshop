<?php

use App\Models\Follow;
use App\Models\Profile;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('profile cannot follow itself', function () {
    $profile = Profile::factory()->create();

    expect(fn() => Follow::createFollow($profile, $profile))
        ->toThrow(InvalidArgumentException::class, 'A profile cannot follow itself');
});

test('can follow a profile', function () {
    $follower = Profile::factory()->create();
    $following = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $following);

    expect($follower->followings->contains($following))->toBeTrue()
        ->and($following->followers->contains($follower))->toBeTrue()
        ->and($follow->follower->id)->toBe($follower->id)
        ->and($follow->following->id)->toBe($following->id);
});

test('can unfollow a profile', function () {
    $follower = Profile::factory()->create();
    $following = Profile::factory()->create();

    $follow = Follow::createFollow($follower, $following);
    $success = Follow::removeFollow($follower, $following);

    expect($follower->followings->contains($following))->toBeFalse()
        ->and($following->followers->contains($follower))->toBeFalse()
        ->and($success)->toBeTrue()
        ->and($follow->fresh())->toBeNull();
});