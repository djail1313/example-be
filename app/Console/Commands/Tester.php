<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Islami\Quotes\Application\Commands\CreateSelfReminder\CreateSelfReminder;

class Tester extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tester:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $a = CreateSelfReminder::dispatchNow('asd', 'asd.jpg');
        return false;
    }
}
