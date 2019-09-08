<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RepositoryMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a repository and corresponding interface';

    protected function getStub($type) 
    {
        return file_get_contents(resource_path("stubs/$type.stub"));
    }

    protected function repository($name)
    {
        $repositoryTemplate = str_replace(
            ['{{name}}'],
            [$name],
            $this->getStub('Repository')
        );

        file_put_contents(app_path("/Repositories/{$name}Repository.php"), $repositoryTemplate);
    }

    protected function interface($name)
    {
        $interfaceTemplate = str_replace(
            ['{{name}}'],
            [$name],
            $this->getStub('RepositoryInterface')
        );

        file_put_contents(app_path("/Repositories/Interfaces/{$name}RepositoryInterface.php"), $interfaceTemplate);
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
        $this->info('Creating the repository...');

        if($this->argument('name') == null) {
            $this->error('Missing the name argument!');
            return false;
        }

        $name = $this->argument('name');

        $this->repository($name);
        $this->interface($name);

        $this->info('Repository created successfully!');
    }
}
