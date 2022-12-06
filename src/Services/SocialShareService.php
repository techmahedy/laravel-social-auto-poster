<?php

namespace Laravelia\Autoposter\Services;

use Illuminate\Pipeline\Pipeline;
use Laravelia\Autoposter\Services\ShareTumblr;
use Laravelia\Autoposter\Services\ShareReddit;
use Laravelia\Autoposter\Services\ShareFacebook;
use Laravelia\Autoposter\Services\ShareLinkedin;

class SocialShareService
{   
    public function share($data = [])
    {   
    
        $response = app(Pipeline::class)
                        ->send($data)
                        ->through([
                            //ShareFacebook::class,
                            //ShareLinkedin::class,
                            //ShareReddit::class,
                            ShareTumblr::class
                        ])
                        ->thenReturn();

        return $response;
    }
}