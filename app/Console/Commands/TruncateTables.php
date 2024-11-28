<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;

/**
 * Delete all rows for certain tables.
 *
 * php artisan truncate
 */
class TruncateTables extends Command
{
    private const TARGET_TABLES = [
        'conversions',
        'users', 
        'campaign_publisher',
        'campaigns',
        'advertisers',
        'publishers', 
        'networks'
    ];

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $env = App::environment();
        if ($env !== 'local') {
            $this->info('This command can only be run for a local environment.');
        } elseif ($this->confirm('Confirm truncate.', false)) {
            foreach (static::TARGET_TABLES as $table_name) {
                DB::table($table_name)->delete();
            }

            $this->info('Truncate complete.');
        } else {
            $this->info('Truncate cancelled.');
        }
    }
}
