<?php 

namespace Manzoli2122\AAL;


use Illuminate\Support\ServiceProvider;

class AALServiceProvider extends ServiceProvider
{
    
    protected $defer = false;

    protected $namespace = 'Manzoli2122\AAL\Http\Controllers'  ;
    
    public function boot()
    {
        // Publish config files
        $this->publishes([
            __DIR__.'/../config/config.php' =>  config_path('aal.php'), 
        ]);

        // Register commands
        $this->commands('command.aal.migration');

        // Register blade directives
        $this->bladeDirectives();


        $this->loadRoutesFrom(__DIR__.'/Http/routes.php');


        $this->loadViewsFrom(__DIR__.'/Views', 'autorizacao');

/*
        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/autorizacao'),
        ]);
*/

    }

   




    public function register()
    {
        $this->registerAAL();

        $this->registerCommands();

        $this->mergeConfig();
    }

   
    






    private function bladeDirectives()
    {
        if (!class_exists('\Blade')) return;

       
        \Blade::directive('perfil', function($expression) {
            return "<?php if (\\AAL::hasPerfil({$expression})) : ?>";
        });

        \Blade::directive('endperfil', function($expression) {
            return "<?php endif; // AAL::hasPerfil ?>";
        });

        
        
        
        \Blade::directive('permissao', function($expression) {
            return "<?php if (\\AAL::can({$expression})) : ?>";
        });

        \Blade::directive('endpermissao', function($expression) {
            return "<?php endif; // AAL::can ?>";
        });

        

/*
        \Blade::directive('ability', function($expression) {
            return "<?php if (\\AAL::ability({$expression})) : ?>";
        });

        \Blade::directive('endability', function($expression) {
            return "<?php endif; // AAL::ability ?>";
        });

*/


    }

    






    private function registerAAL()
    {
        $this->app->bind('aal', function ($app) {
            return new AAL($app);
        });

        $this->app->alias('aal', ' Manzoli2122\AAL\AAL');
    }

   





    private function registerCommands()
    {
        $this->app->singleton('command.aal.migration', function ($app) {
            return new MigrationCommand();
        });
    }

   




    private function mergeConfig()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/config.php', 'aal'
        );
    }

   



    public function provides()
    {
        return [
            'command.aal.migration'
        ];
    }
}
