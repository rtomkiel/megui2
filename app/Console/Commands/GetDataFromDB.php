<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GetDataFromDB extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'getdata:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Data from Database and save in table';

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
        $query = 'SELECT pg_database.datname as Database, pg_size_pretty(pg_database_size(pg_database.datname)) as db_size FROM pg_database WHERE datistemplate = false order by pg_database_size(pg_database.datname) desc;';
        $result = DB::select($query);
        
    }
}
