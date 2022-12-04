<?php

namespace Laravelia\Autoposter\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravelia\Autoposter\Services\SocialShareService;

class AutopostController extends Controller
{   
    public function share(SocialShareService $socialShareService)
    {   
        $data = [
            'link' => 'www.codecheef.com',
            'message' => 'Your message here'
        ];

        $socialShareService->share($data);

        return "success";
    }
}