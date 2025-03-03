<?php

namespace Robodocxs\LaravelErpMiddleware\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class PublishApiControllerCommand extends Command
{
    protected $signature = 'laravel-erp-middleware:publish-api-controller';

    protected $description = 'Publish the Laravel ERP Middleware controller';

    protected $files;

    public function __construct(Filesystem $files)
    {
        parent::__construct();

        $this->files = $files;
    }

    public function handle()
    {
        $sourcePath = __DIR__ . '/../Http/Controllers/MiddlewareApiController.php';
        $destinationPath = app_path('Http/Controllers/LaravelErpMiddlewareController.php');

        if ($this->files->exists($destinationPath)) {
            if (!$this->confirm('The Laravel ERP Middleware Controller already exists. Do you want to overwrite it?')) {
                $this->info('Publishing cancelled.');
                return;
            }
        }

        $this->files->copy($sourcePath, $destinationPath);

        // Update the namespace
        $content = $this->files->get($destinationPath);
        $content = str_replace(
            'namespace Robodocxs\LaravelErpMiddleware\Http\Controllers;',
            'namespace App\Http\Controllers;',
            $content
        );
        $content = str_replace('class MiddlewareApiController', 'class LaravelErpMiddlewareController', $content);
        $this->files->put($destinationPath, $content);

        $this->info('Laravel ERP Middleware Controller published successfully.');
    }
}
