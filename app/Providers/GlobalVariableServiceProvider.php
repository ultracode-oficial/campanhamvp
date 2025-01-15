<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;

class GlobalVariableServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (is_dir('/filestoragestalento')) {
            $path_file_storage = Storage::disk('arquivos')->url('/');
            view()->share('path_file_storage', $path_file_storage);
        }else{
            $path_file_storage = 'a';
            view()->share('path_file_storage', $path_file_storage);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
