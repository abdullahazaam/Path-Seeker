<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;

class ImportDb extends Command
{
    protected $signature = 'db:import-sql';
    protected $description = 'Import local SQL dump to Railway safely';

    public function handle()
    {
        // Check if data already exists to prevent accidental wipes on server restarts
        if (Schema::hasTable('users') && DB::table('users')->count() > 0) {
            $this->info('Database already populated. Skipping import.');
            return;
        }

        $path = database_path('import.sql');
        if (File::exists($path)) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            Artisan::call('db:wipe', ['--force' => true]);
            DB::unprepared(File::get($path));
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->info('Database imported successfully!');
        } else {
            $this->error('import.sql file not found!');
        }
    }
}
