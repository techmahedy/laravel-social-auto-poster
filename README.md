[![Latest Stable Version](https://poser.pugx.org/techmahedy/laravel-social-auto-poster/v/stable)](https://packagist.org/packages/techmahedy/laravel-social-auto-poster)
[![Total Downloads](https://img.shields.io/chocolatey/dt/laravel-social-auto-poster)](https://packagist.org/packages/techmahedy/laravel-social-auto-poster)
[![License](https://poser.pugx.org/techmahedy/laravel-social-auto-poster/license)](https://packagist.org/packages/techmahedy/laravel-social-auto-poster)

## Introduction

This package helps you to post automatically to your social site. 

## Compatibility

| Database                                          | Laravel |
|:--------------------------------------------------|:--------|
| MySQL 5.7+                                        | 5.5.29+ |
| MariaDB 10.2+                                     | 5.8+    |
| PostgreSQL 9.3+                                   | 5.5.29+ |
| [SQLite 3.18+](https://www.sqlite.org/json1.html) | 5.6.35+ |
| SQL Server 2016+                                  | 5.6.25+ |

## Installation

    composer require "laravelia/autoposter"

### Options 

You need to publish autoposter vendor to set social credentials like app_id app_secret etc.

    php artisan vendor:publish


## Usage

```php
class AutopostController extends Controller
{
   public function share()
    {   
        $data = [
            'link' => 'www.codecheef.com',
            'message' => 'Your message here'
        ];

        (new Laravelia\Autoposter\Services\Meta())->share($data);
    }
}