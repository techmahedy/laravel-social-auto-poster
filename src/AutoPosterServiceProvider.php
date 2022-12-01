<?php

namespace Laravelia\Autoposter;

use Illuminate\Support\ServiceProvider;

class AutoPosterServiceProvider extends ServiceProvider
{
  public function boot()
  {  
    $this->loadRoutesFrom(__DIR__.'/routes/web.php');

    $this->mergeConfigFrom(
      __DIR__ . '/config/autoposter.php',
      'autoposter'
    );

    $this->publishes([
        __DIR__ . '/config/autoposter.php' => config_path('autoposter.php'),
    ]);

  }

  public function register()
  {
    
  }
}