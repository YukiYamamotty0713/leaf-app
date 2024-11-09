<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakePage extends Command
{
    protected $signature = 'make:page {name} {--dir=User} {--title=Page Title}';  // Added --title option
    protected $description = 'Create a new page with authenticated layout in a specific directory';

    public function handle()
    {
        $pageName = $this->argument('name');
        $dir = $this->option('dir');  // --dir オプションでディレクトリを指定
        $pageTitle = $this->option('title');  // Getting PageTitle option

        // If no title is provided, use a default value
        if (!$pageTitle) {
            $pageTitle = $pageName;  // Use page name as title if not specified
        }

        $path = resource_path("js/Pages/{$dir}/{$pageName}.vue");
        if (File::exists($path)) {
            $this->error("Page {$pageName} already exists in {$dir}!");
            return;
        }

        // Vue ファイルのテンプレート内容
        $content = "<script setup>\n";
        $content .= "import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';\n";
        $content .= "import { Head, useForm } from '@inertiajs/vue3';\n";
        $content .= "</script>\n\n";
        $content .= "<template>\n";
        $content .= "    <Head title=\"{$pageTitle}\" />\n";  // Use PageTitle here
        $content .= "    <AuthenticatedLayout>\n";
        $content .= "    </AuthenticatedLayout>\n";
        $content .= "</template>\n";

        // 指定ディレクトリが存在しない場合は作成
        $dirPath = resource_path("js/Pages/{$dir}");
        if (!File::exists($dirPath)) {
            File::makeDirectory($dirPath, 0777, true);
        }

        File::put($path, $content);
        $this->info("Page {$pageName} with title '{$pageTitle}' created successfully in {$dir} at {$path}");
    }
}
