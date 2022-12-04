<?php

namespace Laravelia\Autoposter\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravelia\Autoposter\Services\SocialShareService as SocialShare;

class AutopostController extends Controller
{   
    public function share(SocialShare $socialShare)
    {   
        $data = [
            'link' => 'www.codecheef.com',
            'message' => 'Your message here'
        ];

        $socialShare->share($data);

        return "success";
    }
}