<?php

namespace App\Http\Services;

use App\User;
use SpotifyWebAPI\SpotifyWebAPI;

class Spotify
{
    private $api;
    function __construct()
    {
        $this->api = new SpotifyWebAPI();
        $this->api->setAccessToken(User::find(1)->spotify_access_token);
    }

    public function GetPlaylistTracks()
    {
        return $this->api->getPlaylistTracks(config('app.spotify_playlist_id'));
    }

    public function AddSongToPlaylist($trackId)
    {
        $this->api->addPlaylistTracks(config('app.spotify_playlist_id'), [
            $trackId
        ]);
    }

    public function SearchSongs($songName)
    {
        return $this->api->search($songName, 'track', ['limit' => 10]);
    }
}
