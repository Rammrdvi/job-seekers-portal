<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use ReflectionClass;

class ListMiddleware extends Command
{
    protected $signature = 'middleware:list';
    protected $description = 'List all middleware classes (global and route)';

    public function handle()
    {
        $kernel = App::make(\App\Http\Kernel::class);

        // Get global middleware
        $globalMiddleware = $this->getGlobalMiddleware($kernel);

        // Get route middleware
        $routeMiddleware = $kernel->getRouteMiddleware();

        // Display Global Middleware
        $this->info('Registered Global Middleware:');
        foreach ($globalMiddleware as $middleware) {
            $this->line($middleware);
        }

        $this->line(''); // Add space between lists

        // Display Route Middleware
        $this->info('Registered Route Middleware:');
        foreach ($routeMiddleware as $key => $middleware) {
            $this->line("{$key} => {$middleware}");
        }

        return 0;
    }

    /**
     * Get the global middleware.
     *
     * @param  \App\Http\Kernel  $kernel
     * @return array
     */
    protected function getGlobalMiddleware($kernel)
    {
        $reflection = new ReflectionClass($kernel);
        $property = $reflection->getProperty('middleware');
        $property->setAccessible(true);

        return $property->getValue($kernel);
    }
}
