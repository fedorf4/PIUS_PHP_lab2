<?php

namespace App\Console\Commands;

use App\Models\Address;
use App\Models\Customer;
use Illuminate\Console\Command;

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
        if (!Customer::find($id)) {
            $this->error('This customer doesnt exist!');
            return 1;
        }
        $count = Address::where('customer_id', $id)->count();
        $this->info('This customer has ' . $count . ' addresses');
        return 0;
    }
}
