<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Facades\App\Http\Services\Spotify;

class SpotifyController extends Controller
{
    public function login(Request $request)
    {
        $state = Str::random(16);

        $spotifyUrl = $this->qs_url('https://accounts.spotify.com/authorize', [
            'client_id' => config('app.spotify_client_id'),
            'redirect_uri' => route('spotify.callback'),
            'response_type' => 'code',
            'state' => $state
        ]);

        return Redirect($spotifyUrl);
    }

    public function callback(Request $request)
    {
        $response = Http::asForm()->withBasicAuth(config('app.spotify_client_id'), config('app.spotify_client_secret'))
            ->post('https://accounts.spotify.com/api/token', [
                'redirect_uri' => route('spotify.callback'),
                'code' => $request->query('code'),
                'grant_type' => 'authorization_code'
            ]);

        $user = User::find(1);

        $user->spotify_access_token = $response->json()['access_token'];
        $user->spotify_refresh_token = $response->json()['refresh_token'];
        $user->save();

        return Redirect(route('home'));
    }

    public function getPlaylist(Request $request)
    {
        return response()->json(Spotify::GetPlaylistTracks());
    }

    public function addSong()
    {
    }

    public function searchSongs()
    {
    }

    function qs_url($path = null, $qs = array(), $secure = null)
    {
        $url = app('url')->to($path, $secure);
        if (count($qs)) {

            foreach ($qs as $key => $value) {
                $qs[$key] = sprintf('%s=%s', $key, urlencode($value));
            }
            $url = sprintf('%s?%s', $url, implode('&', $qs));
        }
        return $url;
    }
}
