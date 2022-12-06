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
        $consumerKey = config('autoposter.tumblr.CONSUMER_KEY');
        $consumerSecret = config('autoposter.tumblr.SECRET_KEY');
        $token = config('autoposter.tumblr.TOKEN');
        $tokenSecret = config('autoposter.tumblr.TOKEN_SECRET');
        $blogName = config('autoposter.tumblr.BLOG_NAME');

        $client = new Client($consumerKey,$consumerSecret,$token,$tokenSecret);

        try {
            // $data = $client->getBlogPosts('itsmetacentric.tumblr.com');
            // dd($data);

            // $data = ['type'     =>  "photo",
            //  'tags'     =>  "test2, soir",
            //  'source'   =>  "https://www.google.fr/images/srpr/logo11w.png"];

            $data = [
                'type'     =>  "text",
                'tags'     =>  "",
                'summary'   =>  $data['message'],
                'body' => $data['link']
            ];
            $client->createPost($blogName, $data);
        } catch (\Throwable $e) {
            Log::info('Returned an error: '.$e->getMessage());
            return 'Returned an error: '.$e->getMessage();
        }
        
    }
}