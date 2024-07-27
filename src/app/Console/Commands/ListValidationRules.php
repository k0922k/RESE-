<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use ReflectionClass;

class ListValidationRules extends Command
{
    protected $signature = 'list:validation-rules';
    protected $description = 'List all validation rules in form request classes';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $path = app_path('Http/Requests');
        $files = File::allFiles($path);

        foreach ($files as $file) {
            $className = 'App\\Http\\Requests\\' . $file->getFilenameWithoutExtension();
            if (class_exists($className)) {
                $reflection = new ReflectionClass($className);
                if ($reflection->isSubclassOf('Illuminate\\Foundation\\Http\\FormRequest')) {
                    $this->line("Validation rules in: {$className}");
                    $instance = new $className;
                    $rules = $instance->rules();
                    foreach ($rules as $field => $rule) {
                        $this->line("- {$field}: {$rule}");
                    }
                    $this->line('');
                }
            }
        }
    }
}
