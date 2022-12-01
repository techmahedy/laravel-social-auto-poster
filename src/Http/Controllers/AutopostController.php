<?php


namespace Laravelia\Autoposter\Http\Controllers;

use App\Http\Controllers\Controller;
use Laravelia\Autoposter\Services\Meta;

class AutopostController extends Controller
{   
    protected $meta;

    public function __construct(Meta $meta)
    {
        $this->meta = $meta;
    }

    public function share()
    {   
        $data = [
            'link' => 'www.codecheef.com',
            'message' => 'Your message here'
        ];

        $this->meta->share($data);
    }
}