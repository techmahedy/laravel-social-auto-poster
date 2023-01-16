<?php

namespace Laravelia\Autoposter\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravelia\Autoposter\Services\SocialShareService as SocialShare;

class AutopostController extends Controller
{   
    public function share(SocialShare $socialShare)
    {   
        $data = [
            'link' => 'https://www.example.com', //your content link
            'title' => 'Your example content title!', //your content title
            'excerpt' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', //your content short text
            'tags' => 'php, laravel', //your contect tags ex: test, test2, test3
            'attachment_url' => 'https://media.istockphoto.com/id/177131518/photo/ice-cubes.jpg?s=1024x1024&w=is&k=20&c=nsTlwm_2mFXmvL-XZ1vZjVvKvzbUmSTo1D9JPYehR0E=' //your contect attachment link
        ];

        $socialShare->share($data);

        return "success";
    }
}