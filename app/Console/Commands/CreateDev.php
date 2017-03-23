<?php

namespace App\Console\Commands;

use DotEnvWriter\DotEnvWriter;
use Illuminate\Console\Command;
use Mockery\Exception;

/**
 * Setup the development environment for MyIO. The command
 * will auto generate the .env.testing file for you.
 */
class CreateDev extends Command
{
    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'myio:testenv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup the testing environment';

    /**
     * This testing environment file to write.
     *
     * @var string
     */
    protected $envFile = '.env.testing';

    /**
     * We will write our tests into this
     * database file.
     *
     * @var string
     */
    protected $dbFile = './database/database.sqlite';

    /**
     * @var array
     */
    protected $defaults = [];

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->defaults = [
            'APP_ENV'          => 'local',
            'APP_KEY'          => $this->createAppKey(),
            'APP_DEBUG'        => 'true',
            'APP_LOG_LEVEL'    => 'debug',
            'APP_URL'          => config('app.url'),
            'DB_CONNECTION'    => 'sqlite',
            'BROADCAST_DRIVER' => 'log',
            'CACHE_DRIVER'     => 'file',
            'SESSION_DRIVER'   => 'file',
            'QUEUE_DRIVER'     => 'sync',
        ];
    }

    /**
     * Generate a unique APP key, This is
     * code i stole and modified from the
     * core.
     *
     * @return string
     */
    private function createAppKey()
    {
        return 'base64:'.base64_encode(random_bytes(config('app.cipher') == 'AES-128-CBC' ? 16 : 32));
    }

    /**
     * Create the sqlite file that we
     * need for test database
     * transactions.
     *
     * @return bool
     */
    private function createDatabase()
    {
        return touch($this->dbFile);
    }

    /**
     * Fil in the fields so we can write them
     * to the .env.testing file.
     */
    private function createEnvironment()
    {
        try {
            $writer = new DotEnvWriter($this->envFile);
            foreach ($this->defaults as $key => $val) {
                $writer->set($key, $val);
            }
            $writer->save();
            $status = true;
        } catch (Exception $e) {
            $status = false;
        }

        return $status;
    }

    /**
     * Handle the execution of the console
     * command.
     *
     * @return mixed
     */
    public function handle()
    {
        $steps = [
            'database'    => [
                'callback' => [$this, 'createDatabase'],
                'messages' => [
                    'success' => 'Created '.$this->dbFile,
                    'error'   => 'Failed to create '.$this->dbFile,
                ],
            ],
            'environment' => [
                'callback' => [$this, 'createEnvironment'],
                'messages' => [
                    'success' => 'Created '.$this->envFile,
                    'error'   => 'Failed to create '.$this->envFile,
                ],
            ],
        ];

        $this->info('Welcome to the '.config('app.name')." testing environment. \r\n");

        foreach ($steps as $step) {
            $result = call_user_func($step['callback']);
            if ($result == true) {
                $this->info($step['messages']['success']);
            } else {
                $this->info($step['messages']['error']);
            }
        }

        $this->info("\r\nHappy testing ... ");
        print '<pre>';
        system('ls -l ');
    }
}
