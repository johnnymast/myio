<?php

namespace App\Console\Commands;

use DotEnvWriter\DotEnvWriter;
use Illuminate\Console\Command;

class Install extends Command
{

    /**
     * The name and signature of the console command.
     * @var string
     */
    protected $signature = 'myio:install';

    /**
     * The console command description.
     * @var string
     */
    protected $description = 'Wizard to create the .env file';

    /**
     * We will write the settings to this
     * file.
     * @var string
     */
    protected $envFile = '.env.debug';

    /**
     * These are the questions for creating
     * the environment file.
     * @var array
     */
    protected $steps = [];


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
        $this->steps = [
            [
                'question' => 'What environment will you run '.config('app.name').' in',
                'default'  => 'local',
                'key'      => 'APP_ENV',
                'answers'  => ['local', 'production']
            ],
            [
                'question' => 'Enable debugging? ',
                'default'  => 'true',
                'key'      => 'APP_DEBUG',
                'answers'  => ['true', 'false']
            ],
            [
                'question' => 'Logging level',
                'default'  => config('app.log_level'),
                'key'      => 'APP_LOG_LEVEL',
                'answers'  => ['debug', 'info', 'notice', 'warning', 'error', 'critical', 'alert', 'emergency']
            ],
            [
                'question' => 'Application url',
                'default'  => config('app.url'),
                'key'      => 'APP_URL',
                'answers'  => [],
            ]
        ];
    }


    /**
     * Generate a unique APP key, This is
     * code i stole and modified from the
     * core.
     * @return string
     */
    private function createAppKey()
    {
        return 'base64:'.base64_encode(random_bytes(config('app.cipher') == 'AES-128-CBC' ? 16 : 32));
    }


    /**
     * Execute the console command.
     * @return mixed
     */
    public function handle()
    {
        $env = ['APP_KEY' => $this->createAppKey()];

        $this->info("Welcome to ".config('app.name').". We will quickly get you started by asking you a few questions.");

        foreach ($this->steps as $step) {
            $repeat = true;
            while ($repeat) {

                $answer = $this->anticipate($step['question'],  $step['answers'], $step['default']);

                if (count($step['answers']) > 0 && in_array($answer, array_values($step['answers'])) == false) {
                    $repeat = true;

                    $this->info('Your possible choices are: ['.implode(', ', $step['answers']).']');

                } else {
                    $repeat = false;
                    $env[$step['key']] = $answer;
                }
            }
        }

        if (count($env) > 1) {
            $writer = new DotEnvWriter($this->envFile);
            foreach ($env as $key => $val) {
                $writer->set($key, $val);
            }
            $writer->save();
        }

        $this->info("\r\nHave fun ... ");
    }
}
