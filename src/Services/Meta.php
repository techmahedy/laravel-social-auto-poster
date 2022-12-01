<?php

namespace Laravelia\Autoposter\Services;

use Facebook\Facebook;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Exceptions\FacebookResponseException;

require_once __DIR__.'../../Facebook/autoload.php';

class Meta
{
    public function share($data)
    {
        $fb = new Facebook([
            'app_id' => config('autoposter.facebook.APP_ID'),
            'app_secret' => config('autoposter.facebook.APP_SECRET'),
            'default_graph_version' => 'v12.0'
        ]);

        $_token = config('autoposter.facebook.ACCESS_TOKEN');
        
        try {
            $response = $fb->post('/codecheef/feed', $data, $_token);
        } catch(FacebookResponseException $e) {
            return 'Graph returned an error: '.$e->getMessage();
        } catch(FacebookSDKException $e) {
            return 'Facebook SDK returned an error: '.$e->getMessage();
        }
        $graphNode = $response->getGraphNode();

        return true;
    }
}