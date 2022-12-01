[![Issues](https://img.shields.io/github/issues/techmahedy/laravel-social-auto-poster.svg?style=flat-square)](https://github.com/techmahedy/laravel-social-auto-poster/issues)
[![Stars](https://img.shields.io/github/stars/techmahedy/laravel-social-auto-poster.svg?style=flat-square)](https://github.com/techmahedy/laravel-social-auto-poster/stargazers)

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