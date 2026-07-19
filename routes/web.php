<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/feed', function () {
    $feedItems = json_decode(json_encode([
        [
            'postedDateTime' => '3h',
            'content' => <<<str
            <p>
                I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a>
            </p>
            <img src="/images/simon-chilling.png" alt="" />
            str,
            'likeCount' => 23,
            'replyCount' => 10,
            'repostCount' => 15,
            'profile' => [
                'avatar' => '/images/michael.png',
                'displayName' => 'Michael',
                'handle' => '@mmich_jj',
            ],
            'replies' => [
                [
                    'postedDateTime' => '1h',
                    'likeCount' => 12,
                    'replyCount' => 11,
                    'repostCount' => 10,
                    'profile' => [
                        'avatar' => '/images/simon-chilling.png',
                        'displayName' => 'Simon',
                        'handle' => '@simonswiss',
                    ],
                ]
            ],
        ]
    ]));

    return view('feed', compact('feedItems'));
});

Route::get('/profile', function () {
    $feedItems = json_decode(json_encode([
        [
            'postedDateTime' => '3h',
            'content' => <<<str
            <p>
                I made this! <a href="#">#myartwork</a> <a href="#">#pixl</a>
            </p>
            <img src="/images/simon-chilling.png" alt="" />
            str,
            'likeCount' => 23,
            'replyCount' => 10,
            'repostCount' => 15,
            'profile' => [
                'avatar' => '/images/michael.png',
                'displayName' => 'Michael',
                'handle' => '@mmich_jj',
            ],
            'replies' => [
                [
                    'postedDateTime' => '1h',
                    'likeCount' => 12,
                    'replyCount' => 11,
                    'repostCount' => 10,
                    'profile' => [
                        'avatar' => '/images/simon-chilling.png',
                        'displayName' => 'Simon',
                        'handle' => '@simonswiss',
                    ],
                ]
            ],
        ]
    ]));

    return view('profile', compact('feedItems'));
});
