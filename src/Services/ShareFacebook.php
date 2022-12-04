<?php 

namespace Laravelia\Autoposter\Services;

use Facebook\Facebook;
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

        $fb = new Facebook([
            'app_id' => config('autoposter.facebook.APP_ID'),
            'app_secret' => config('autoposter.facebook.APP_SECRET'),
            'default_graph_version' => 'v15.0'
        ]);
        
        $_token = config('autoposter.facebook.ACCESS_TOKEN');
        
        try {
            $response = $fb->post('/'.config('autoposter.facebook.PAGE_ID').'/feed', $data, $_token);
        } catch(FacebookResponseException $e) {
            return 'Graph returned an error: '.$e->getMessage();
        } catch(FacebookSDKException $e) {
            return 'Facebook SDK returned an error: '.$e->getMessage();
        }
        $graphNode = $response->getGraphNode();
    }
}