<?php

namespace App\View\Components;

use App\Models\Profile;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ArtistsToFollow extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        // $artists = [
        //     ['img' => 'alessia.png', 'name' => 'alessia_draws'],
        //     ['img' => 'anne.png', 'name' => 'just_anne'],
        //     ['img' => 'mr-anderson.png', 'name' => 'Mr. Anderson'],
        //     ['img' => 'michael.png', 'name' => 'Michael']
        // ];
        // return view('components.artists-to-follow', compact('artists'));

        if (Auth::check()) {
            $profile = Auth::user()->profile;

            $query = Profile::whereDoesntHave('followers', fn($q) => $q->where('follower_profile_id', $profile->id))
                ->where('id', '!=', $profile->id);
        } else {
            $query = Profile::query();
        }

        $profiles = $query->inRandomOrder()->limit(4)->get();

        return view('components.artists-to-follow', compact('profiles'));
    }
}