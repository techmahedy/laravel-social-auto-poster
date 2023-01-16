<?php 

namespace Laravelia\Autoposter\Services;

use Facebook\Facebook;
use Illuminate\Support\Facades\Log;
use Laravelia\Autoposter\Services\Share;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

require_once __DIR__.'../../Facebook/autoload.php';

class ShareFacebook extends Share
{
    public function applyShare($data)
    {   
        if(!config('autoposter.facebook.ENABLE_FACEBOOK_PAGE_SHARE')) {       
            return;
        }

        $facebook = new Facebook([
            'app_id' => config('autoposter.facebook.APP_ID'),
            'app_secret' => config('autoposter.facebook.APP_SECRET'),
            'default_graph_version' => 'v15.0'
        ]);
        
        $content = [
            'link' => isset($data['link']) ? $data['link'] : '',
            'message' => isset($data['excerpt']) ? $data['excerpt'] : '',
        ];

        try {
            $pageAccessToken = config('autoposter.facebook.PAGE_ACCESS_TOKEN');
            $response = $facebook->post(
                '/'.
                config('autoposter.facebook.FACEBOOK_PAGE_ID').
                '/feed', 
                $content, 
                $pageAccessToken
            );
        } catch(FacebookResponseException $e) {
            Log::info('Graph returned an error: '.$e->getMessage());
            return 'Graph returned an error: '.$e->getMessage();
        } catch(FacebookSDKException $e) {
            Log::info('Facebook SDK returned an error: '.$e->getMessage());
            return 'Facebook SDK returned an error: '.$e->getMessage();
        }
        $graphNode = $response->getGraphNode();
    }
}