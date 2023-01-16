<?php

namespace Laravelia\Autoposter\Services;

use Illuminate\Pipeline\Pipeline;
use Laravelia\Autoposter\Services\ShareTumblr;
use Laravelia\Autoposter\Services\ShareFacebook;

class SocialShareService
{   
    public function share($data = [])
    {   
        $response = app(Pipeline::class)
                        ->send($data)
                        ->through([
                            ShareFacebook::class,
                            ShareTumblr::class
                        ])
                        ->thenReturn();

        return $response;
    }
}