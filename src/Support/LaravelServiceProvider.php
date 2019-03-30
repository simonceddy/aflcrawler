<?php
namespace AflCrawler\Support;

use Illuminate\Support\ServiceProvider;

/**
 * Service Provider for Laravel 5
 * 
 * WIP - Currently more for testing than anything else
 * 
 * @category Support
 * @package  AflCrawler
 * @author   Simon Eddy <simon@simoneddy.com.au>
 * @license  MIT
 * @link     http://github.com/simonceddy/aflcrawler
*/
class LaravelServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // try with dir?
        $this->publishes([
            dirname(__DIR__, 2).'/config/afl/' => config_path('afl'),
        ]);
    }

    public function register()
    {
        
    }
}