<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:news {--count=50}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $length = $this->option('count');
        _seed($length);
        echo 'Generated News';
        die;
    }
}
