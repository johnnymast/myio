<?php

namespace App\Console\Commands;

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
    protected $envFile = '.env';

    /**
     * Same environment file.
     * @var string
     */
    protected $sampleEnv = '.env.example';

    /**
     * These are the questions for creating
     * the environment file.
     * @var array
     */
    protected $steps = [];

    /**
     * This array will contain the keys and values
     * we will write to the environment file.
     * @var array
     */
    protected $env = [];


    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();

        $this->env[] = [
            'type'  => 'value',
            'key'   => 'APP_KEY',
            'value' => $this->createAppKey()
        ];

        $this->steps = [
            [
                'question' => 'What environment will you run '.config('app.name').' in',
                'default'  => 'local',
                'key'      => 'APP_ENV',
                'answers'  => ['local', 'production'],
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
                'nextline' => 'separator',
            ],
            [
                'question' => 'Database connection',
                'default'  => 'mysql',
                'key'      => 'DB_CONNECTION',
                'answers'  => ['mysql'],
            ],
            [
                'question' => 'Database host',
                'default'  => '127.0.0.1',
                'key'      => 'DB_HOST',
                'answers'  => ['127.0.0.1', 'localhost'],
            ],
            [
                'question' => 'Database port',
                'default'  => '3306',
                'key'      => 'DB_PORT',
                'answers'  => ['3306'],
            ],
            [
                'question' => 'Database name',
                'default'  => 'myio',
                'key'      => 'DB_DATABASE',
                'answers'  => [],
            ],
            [
                'question' => 'Database user',
                'default'  => 'root',
                'key'      => 'DB_USERNAME',
                'answers'  => [],
            ],
            [
                'question' => 'Database password',
                'default'  => 'root',
                'key'      => 'DB_PASSWORD',
                'answers'  => [],
            ],
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
        $this->info("Welcome to ".config('app.name').". We will quickly get you started by asking you a few questions.");

        if (file_exists($this->envFile) == true) {
            if (($answer = $this->anticipate($this->envFile.' already exists, do you wish to continue?' , ['yes', 'no'], 'no'))) {
                if ($answer == 'no') {
                    $this->info("\r\nBye bye ... ");
                    return;
                }
            }
        }


        foreach ($this->steps as $step) {
            $repeat = true;
            while ($repeat) {
                $answer = $this->anticipate($step['question'], $step['answers'], $step['default']);

                if (count($step['answers']) > 0 && in_array($answer, array_values($step['answers'])) == false) {
                    $repeat = true;
                    $this->info('Your possible choices are: ['.implode(', ', $step['answers']).']');
                } else {
                    $repeat = false;
                    $this->env[] = [
                        'type'  => 'value',
                        'key'   => $step['key'],
                        'value' => $answer
                    ];
                }
            }

            if (isset($step['nextline']) == true && $step['nextline'] == 'separator') {
                $this->env[] = ['type' => 'separator'];
            }
        }

        $sampleEnv = file_get_contents($this->sampleEnv);

        if ($sampleEnv) {
            $lines = explode("\n", $sampleEnv);
            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) {
                    $this->env[] = ['type' => 'separator'];
                }
                $line = explode('=', $line);
                if (isset($line[0]) == true && isset($line[1]) == true) {
                    $this->env[] = [
                        'type'  => 'value',
                        'key'   => $line[0],
                        'value' => $line[1]
                    ];
                }
            }
        }
        unset($sampleEnv);

        $written = [];
        if (count($this->env) > 1) {
            $fp = fopen($this->envFile, 'w+');
            foreach ($this->env as $item) {

                if ($item['type'] == 'value') {
                    if (isset($written[$item['key']])) {
                        continue;
                    }
                    fwrite($fp, $item['key'].'='.$item['value']."\n");
                    $written[$item['key']] = $item['value'];
                } else {
                    if ($item['type'] == 'separator') {
                        fwrite($fp, "\n");
                    }
                }
            }
            fclose($fp);
        }

        $this->info("\r\nHave fun ... ");
    }
}
