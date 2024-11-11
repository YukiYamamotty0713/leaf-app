<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeRoute extends Command
{
    protected $signature = 'make:route {name} {controller?}';
    protected $description = 'Register a route in the web.php file under auth middleware group';
    
    public function handle()
    {
        $name = $this->argument('name');
        $controller = $this->argument('controller') ?: "{$name}Controller";

        $webRoutesPath = base_path('routes/web.php');
        $webRoutesContent = File::get($webRoutesPath);

        //web.phpがない場合、コマンド
        if (!File::exists($webRoutesPath)) {
            $this->error('web.php file not found.');
            return Command::FAILURE;
        }
        
        // use文を追加
        $useStatement = "use App\\Http\\Controllers\\{$controller};";
        if (!str_contains($webRoutesContent, $useStatement)) {
            // 最後のuse文を見つける
            $lastUsePos = $this->findLastUseStatement($webRoutesContent);
            if ($lastUsePos !== false) {
                // 最後のuse文の後に新しいuse文を追加
                $webRoutesContent = substr_replace(
                    $webRoutesContent,
                    "\n{$useStatement}",
                    $lastUsePos,
                    0
                );
            } else {
                $this->error('Could not find appropriate location for use statement.');
                return Command::FAILURE;
            }
        }

        // auth ミドルウェアグループを見つける
        $authGroupPattern = '/Route::middleware\([\'"]auth[\'"]\)->group\(.*?function.*?\)\s*{/s';
        
        if (preg_match($authGroupPattern, $webRoutesContent, $matches)) {
            // 新しいルートを生成
            $routePattern = "    Route::get('{$name}', [{$controller}::class, 'index'])->name('{$name}.index');";
            
            // auth グループの最後の }); を見つける
            $lastBrace = strrpos($webRoutesContent, '});');
            if ($lastBrace !== false) {
                // 最後の }); の直前に新しいルートを挿入
                $webRoutesContent = substr_replace(
                    $webRoutesContent,
                    "\n{$routePattern}\n",
                    $lastBrace,
                    0
                );

                // ファイルに書き戻す
                File::put($webRoutesPath, $webRoutesContent);
                
                $this->info("Route and use statement for '{$controller}' added successfully.");
                return Command::SUCCESS;
            }
            
            $this->error('Could not find the end of auth middleware group.');
            return Command::FAILURE;
        }
        
        $this->error('Auth middleware group not found in web.php');
        return Command::FAILURE;
    }

    /**
     * 最後のuse文の位置を見つける
     */
    private function findLastUseStatement(string $content): false|int
    {
        $lines = explode("\n", $content);
        $lastUseLinePos = false;
        $currentPos = 0;

        foreach ($lines as $line) {
            if (preg_match('/^use\s+/', trim($line))) {
                $lastUseLinePos = $currentPos + strlen($line);
            }
            $currentPos += strlen($line) + 1; // +1 for the newline character
        }

        return $lastUseLinePos;
    }
}