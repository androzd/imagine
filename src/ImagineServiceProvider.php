<?php

namespace Androzd\Imagine;

use Illuminate\Support\ServiceProvider;

class ImagineServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/imagine.php' => config_path('imagine.php'),
        ]);
        \Blade::directive('imagine', function($argument) {
            list($rule, $expression) = explode(',', trim($argument, '()'));
            $url = route('cache.imagine', [trim($rule), '']);
            return "<?php echo '$url'.$expression?>";
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $dir = config('imagine.directory');
        \Route::get('/'.$dir.'/{rule}/{image}', [
            'uses' => 'Androzd\Imagine\ImagineController@index',
            'as' => 'cache.imagine',
        ])->where('image', '[a-zA-Z0-9\-/_\.]+');
    }
}
