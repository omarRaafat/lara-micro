<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class moveStorageFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:move-storage-files';

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
        try{
        Storage::move(storage_path('local/44'), storage_path('public/'));
        $this->info('files moved from local to public path');
        return Command::SUCCESS;

        }catch (\Exception $e){
            $this->error($e->getMessage());
            return Command::FAILURE;
        }
    }
}
