<?php 

namespace Laravelia\Autoposter\Services;

use Tumblr\API\Client;
use Illuminate\Support\Facades\Log;
use Laravelia\Autoposter\Services\Share;

require_once __DIR__.'../../../vendor/autoload.php';

class ShareTumblr extends Share
{
    public function applyShare($data)
    {   
        if(!config('autoposter.tumblr.ENABLE_TUMBLR_SHARE')) {
            return;
        }

        $consumerKey = config('autoposter.tumblr.CONSUMER_KEY');
        $consumerSecret = config('autoposter.tumblr.SECRET_KEY');
        $token = config('autoposter.tumblr.TOKEN');
        $tokenSecret = config('autoposter.tumblr.TOKEN_SECRET');
        $blogName = config('autoposter.tumblr.BLOG_NAME');

        $client = new Client($consumerKey,$consumerSecret,$token,$tokenSecret);

        try {
            $data = [
                'type' =>  "link",
                'tags' =>  isset($data['tags']) ? $data['tags'] : '',
                'title' => $data['title'],
                'url' => $data["link"],
                'description' => isset($data['excerpt']) ? $data['excerpt'] : '',
                'thumbnail' => isset($data['attachment_url']) ? $data['attachment_url'] : '',
            ];
            $client->createPost($blogName, $data);

        } catch (\Throwable $e) {
            Log::info('Returned an error: '.$e->getMessage());
        }
    }
}