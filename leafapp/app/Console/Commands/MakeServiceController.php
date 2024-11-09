<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeServiceController extends Command
{
    protected $signature = 'make:service-controller {name} {--dir=default}';
    protected $description = 'Generate a controller that uses the service class for a given entity';

    public function handle()
    {
        $name = $this->argument('name');
        $dir = $this->option('dir');  // オプションでディレクトリを指定

        $this->info("Creating controller for {$name} using the service");

        // Serviceクラス名を定義
        $serviceClass = "{$name}Service";
        // コントローラーのパスを指定
        $controllerPath = app_path("Http/Controllers/{$name}Controller.php");

        // ファイルが存在しない場合に作成
        if (!File::exists($controllerPath)) {
            // Vueコンポーネントのディレクトリを設定（オプションで指定された場合、デフォルトは 'default'）
            $componentPath = $dir === 'default' ? "{$name}" : "{$dir}";

            $controllerContent = <<<EOF
            <?php

            namespace App\Http\Controllers;

            use App\Services\\{$serviceClass};
            use Inertia\Inertia;

            class {$name}Controller extends Controller
            {
                protected \${$serviceClass};

                public function __construct({$serviceClass} \${$serviceClass})
                {
                    \$this->{$serviceClass} = \${$serviceClass};
                }

                public function index()
                {
                    // サービスメソッドの利用例
                    \$data = \$this->{$serviceClass}->get();

                    // InertiaでVueコンポーネントをレンダリング
                    return Inertia::render('{$componentPath}', [
                        'data' => \$data,
                    ]);
                }
            }
            EOF;

            // コントローラーの内容をファイルに書き込む
            File::put($controllerPath, $controllerContent);
            $this->info("Controller created: {$controllerPath}");
        } else {
            $this->error("Controller {$controllerPath} already exists.");
        }
    }
}
