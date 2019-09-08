<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ServiceMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:service {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a service and corresponding interface';

    protected function getStub($type) 
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function service($name)
    {
        $serviceTemplate = str_replace(
            ['{{name}}', '{{loweredFirst}}'],
            [$name, lcfirst($name)],
            $this->getStub('Service')
        );

        file_put_contents(app_path("/Services/{$name}Service.php"), $serviceTemplate);
    }

    protected function interface($name)
    {
        $interfaceTemplate = str_replace(
            ['{{name}}'],
            [$name],
            $this->getStub('ServiceInterface')
        );

        file_put_contents(app_path("/Services/Interfaces/{$name}ServiceInterface.php"), $interfaceTemplate);
    }

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('Creating the service...');

        if($this->argument('name') == null) {
            $this->error('Missing the name argument!');
            return false;
        }

        $name = $this->argument('name');

        $this->service($name);
        $this->interface($name);

        $this->info('Service created successfully!');
    }
}
