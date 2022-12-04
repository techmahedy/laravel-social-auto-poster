<?php 

namespace Laravelia\Autoposter\Services;

use Closure;

abstract class Share 
{
    public function handle($request, Closure $next)
    {  
        $builder = $next($request);

        return $this->applyShare($builder);
    }

    protected abstract function applyShare($builder);
}