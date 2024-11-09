<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeService extends Command
{
    protected $signature = 'make:service {name}';
    protected $description = 'Generate a service for a given entity, adhering to the Dependency Inversion Principle';

    public function handle()
    {
        $name = $this->argument('name');
        $this->info("Creating service for {$name}");

        // インターフェース名を指定
        $repositoryInterface = "{$name}RepositoryInterface";

        // Service作成
        $servicePath = app_path("Services/{$name}Service.php");
        if (!File::exists($servicePath)) {
            $serviceContent = <<<EOF
            <?php

            namespace App\Services;

            use App\Repositories\\{$repositoryInterface};

            class {$name}Service
            {
                protected \${$repositoryInterface};

                public function __construct({$repositoryInterface} \${$repositoryInterface})
                {
                    \$this->{$repositoryInterface} = \${$repositoryInterface};
                }

                public function get()
                {
                    return \$this->{$repositoryInterface}->get();
                }
            }
            EOF;
            File::put($servicePath, $serviceContent);
            $this->info("Service created: {$servicePath}");
        } else {
            $this->error("Service {$servicePath} already exists.");
        }
    }
}
