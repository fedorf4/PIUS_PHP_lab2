<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class count_addresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'customer:count-addresses {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The number of addresses a customer has with this ID';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $count = DB::table('addresses')->where('customer_id', $id)->count();
        $this->info('This customer has ' . $count . ' addresses');
        return 0;
    }
}
