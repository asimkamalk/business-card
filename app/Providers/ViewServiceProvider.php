<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\Engines\PhpEngine;
use Illuminate\View\Engines\CompilerEngine;
use Illuminate\View\Engines\EngineResolver;
use Illuminate\View\Compilers\BladeCompiler;
use Illuminate\View\FileViewFinder;
use Illuminate\View\Factory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ViewErrorBag;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerViewFinder();
        $this->registerEngineResolver();
        $this->registerBladeCompiler();
        $this->registerViewFactory();
    }

    public function boot()
    {
        // Ensure $errors is always available to views
        // Use a view composer that runs when views are rendered (after middleware)
        // This complements the ShareErrorsFromSession middleware
        View::composer('*', function ($view) {
            // Get errors from session if available (set by ShareErrorsFromSession middleware)
            // Otherwise use an empty ViewErrorBag
            $errors = session()->get('errors');
            if ($errors instanceof ViewErrorBag) {
                $view->with('errors', $errors);
            } elseif (!isset($view->errors)) {
                $view->with('errors', new ViewErrorBag());
            }
        });
    }

    protected function registerViewFinder()
    {
        $this->app->bind('view.finder', function ($app) {
            $paths = [
                resource_path('views'),
                resource_path('views/vendor'),
            ];

            return new FileViewFinder($app['files'], $paths);
        });
    }

    protected function registerEngineResolver()
    {
        $this->app->bind('view.engine.resolver', function ($app) {
            $resolver = new EngineResolver;

            $resolver->register('php', function () {
                return new PhpEngine;
            });

            $resolver->register('blade', function () use ($app) {
                return new CompilerEngine($app['blade.compiler']);
            });

            return $resolver;
        });
    }

    protected function registerBladeCompiler()
    {
        $this->app->bind('blade.compiler', function ($app) {
            $cachePath = storage_path('framework/views');

            return new BladeCompiler($app['files'], $cachePath);
        });
    }

    protected function registerViewFactory()
    {
        $this->app->bind('view', function ($app) {
            $factory = new Factory(
                $app['view.engine.resolver'],
                $app['view.finder'],
                $app['events']
            );

            $factory->setContainer($app);
            
            // Ensure errors is always available
            $factory->share('errors', new ViewErrorBag());

            return $factory;
        });
    }
}
