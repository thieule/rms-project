<?php  # /app/Console/Commands/ServeCommand.php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;

class ServeCommand extends Command {
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'serve';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Serve the application on the PHP development server";
    /**
     * Execute the console command.
     *
     * @return void
     */
    public function fire()
    {
        $redis = app()->make('redis');
        $redis->subscribe('test-chanel', function ($message) {
            $this->info('test-chanel:' . $message);
        });
    }
//    /**
//     * Get the console command options.
//     *
//     * @return array
//     */
//    protected function getOptions()
//    {
//        return array(
//            array('chanel', null, InputOption::VALUE_OPTIONAL, 'The host address to serve the application on.', 'localhost'),
//            array('port', null, InputOption::VALUE_OPTIONAL, 'The port to serve the application on.', 8000),
//        );
//    }
}