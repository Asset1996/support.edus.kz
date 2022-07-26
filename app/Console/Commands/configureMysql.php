<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\App;
use App\Helpers\Env;

class configureMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:config';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command for set config values for connection to Mysql';

    /**
     * The .env file path
     *
     * @var string
     */
    protected $envFilePath;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->envFilePath = App::environmentFilePath();
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $host = $this->ask('Enter host (empty for localhost)')?:"localhost";
        $this->setEnv("DB_HOST", $host);

        $port = $this->ask('Enter port (empty for 3306)')?:"3306";
        $this->setEnv("DB_PORT", $port);
        
        $database = $this->ask('Enter database name (empty for main)')?:"main";
        $this->setEnv("DB_DATABASE", $database);
        
        $username = $this->ask('Enter username (empty for root)')?:"root";
        $this->setEnv("DB_USERNAME", $username);
        
        $password = $this->ask('Enter password (empty for null)')?:"null";
        $this->setEnv("DB_PASSWORD", $password);

        return 0;
    }

    /**
     * Set or update value and key on .env file
     * and save .env file
     */
    private function setEnv(string $key, string $value)
    {
        
        $content = file_get_contents($this->envFilePath);
        [$newEnvFileContent, $isNewVariableSet] = Env::setVariable($content, $key, $value);

        if ($isNewVariableSet) {
            $this->info("A new environment variable with key '{$key}' has been set to '{$value}'");
        } else {
            [$_, $oldValue] = explode('=', Env::readKeyValuePair($content, $key), 2);
            $this->info("Environment variable with key '{$key}' has been changed from '{$oldValue}' to '{$value}'");
        }

        Env::save($this->envFilePath, $newEnvFileContent);
    }
}