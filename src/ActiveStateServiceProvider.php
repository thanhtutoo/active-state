<?php

namespace Pyaesone17\ActiveState;

use Illuminate\Support\ServiceProvider;

class ActiveStateServiceProvider extends ServiceProvider
{
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {  
        \Blade::directive('activeCheck', function($expression) {
            return "<?php echo Active::check{$expression} ;  ?>";
        });
        \Blade::directive('ifActiveUrl', function($expression) {
            return "<?php if(Active::check{$expression}): ?>";
        });
        \Blade::directive('endIfActiveUrl', function($expression) {
            return '<?php endif; ?>';
        });
        $this->publishes([
            __DIR__.'/config/active.php' => config_path('active.php'),
        ]);        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('active', function ($app) {
            return new \Pyaesone17\ActiveState\Active();
        });
    }
}
