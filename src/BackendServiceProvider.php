<?php



namespace XRA\Backend;

use Illuminate\Support\ServiceProvider;
use XRA\Extend\Traits\ServiceProviderTrait;

class BackendServiceProvider extends ServiceProvider
{
    use ServiceProviderTrait;

     protected $defer = true;
}
