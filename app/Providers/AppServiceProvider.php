<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
        //
//        $headerServices = Service::select('name_en','name_ar', 'slug')->where('active', '1')->where('id', '!=', 2)->get()->toArray();
//        $lastNews = Article::with('media')->orderBy('id', 'desc')->take(3)->get();
//        $data = [
//            'headerServices'=>$headerServices,
//            'lastNews'=>$lastNews,
//        ];
//        View::share([
//            'siteSettings'=> Setting::find(1),
//            'data'=>$data,
//            ]);
    }
}
