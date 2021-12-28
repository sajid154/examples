<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SharesAlloted extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'alloted:shares {user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Allocation of the shares of an IPO';

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
        //
    }
}
