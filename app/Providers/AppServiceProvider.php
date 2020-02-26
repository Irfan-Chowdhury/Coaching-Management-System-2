<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\HeaderFooter;
use View;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view::composer('admin.includes.header',function($view){
            $user = Auth::user();
            $view->with('user',$user);
        });
        
        view::composer('admin.includes.header',function($view){  //header.blade.php- file access the $header variable
            $header = HeaderFooter::find(1);
            $view->with('header',$header);
        });
        
        view::composer('admin.includes.footer',function($view){  //footer.blade.php- file access the $footer variable
            $footer = HeaderFooter::find(1);
            $view->with('footer',$footer);
        });
    }
}
