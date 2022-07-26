<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Helpers\Env;

class generateGithubKey extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:github-key';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command will be generate guthub random for secure webhook to pull repositories!';

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
     * @return int
     */
    public function handle()
    {
        $key = "GITHUB_PULL_SECRET";
        $value = (string) Str::uuid();
        $envFilePath = App::environmentFilePath();
        $content = file_get_contents($envFilePath);
        [$newEnvFileContent, $isNewVariableSet] = Env::setVariable($content, $key, $value);

        if ($isNewVariableSet) {
            $this->info("A new environment variable with key '{$key}' has been set to '{$value}'");
        } else {
            [$_, $oldValue] = explode('=', Env::readKeyValuePair($content, $key), 2);
            $this->info("Environment variable with key '{$key}' has been changed from '{$oldValue}' to '{$value}'");
        }

        Env::save($envFilePath, $newEnvFileContent);
    }
    
}