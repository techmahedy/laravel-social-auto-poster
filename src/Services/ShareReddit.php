<?php

namespace Laravelia\Autoposter\Services;

use Illuminate\Support\Facades\Log;
use Laravelia\Autoposter\Services\Share;

class ShareReddit extends Share
{
    public function applyShare($data)
    {   
        $params = [
            'grant_type' => 'password',
            'username' => config('autoposter.redit.REDDIT_USERNAME'),
            'password' => config('autoposter.redit.REDDIT_PASSWORD')
        ];
        
        $clientId = config('autoposter.redit.CLIENT_ID');
        $clientSecret = config('autoposter.redit.CLIENT_SECRET');
        
        try {
            $ch = curl_init( 'https://www.reddit.com/api/v1/access_token' );
            curl_setopt( $ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
            
            $response_raw = curl_exec( $ch );
            $response = json_decode( $response_raw );
            curl_close($ch);
            
            $accessToken = $response->access_token;
            $accessTokenType = $response->token_type;
            $username = config('autoposter.redit.REDDIT_USERNAME');
            $subredditName = config('autoposter.redit.SUBREDDIT_NAME');
            $subredditDisplayName = config('autoposter.redit.SUBREDDIT_DISPLAY_NAME');
            $subredditPostTitle = $data['message'];
            $subredditUrl = $data['link'];
            $apiCallEndpoint = 'https://oauth.reddit.com/api/submit';
            
            $postData = [
                'url' => $subredditUrl,
                'title' => $subredditPostTitle,
                'sr' => $subredditName,
                'kind' => 'link'
            ];
            
            $ch = curl_init( $apiCallEndpoint );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            curl_setopt( $ch, CURLOPT_USERAGENT, $subredditDisplayName . ' by /u/' . $username . ' (Phapper 1.0)' );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, array( "Authorization: " . $accessTokenType . " " . $accessToken ) );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $postData );
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
            
            $response_raw = curl_exec( $ch );
            $response = json_decode( $response_raw );
            curl_close( $ch );
        } catch (\Throwable $th) {
            Log::info($th->getTrace()[0]['args']);
            return $th->getTrace()[0]['args'];
        }
    }
}