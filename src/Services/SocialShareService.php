<?php

namespace Laravelia\Autoposter\Services;

use Illuminate\Pipeline\Pipeline;
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
                            ShareReddit::class
                        ])
                        ->thenReturn();

        return $response;
    }
}