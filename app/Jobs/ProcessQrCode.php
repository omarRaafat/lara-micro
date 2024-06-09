<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class ProcessQrCode implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    // protected $user;
    public function __construct()
    {
     
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user = User::find(2);
        $user->update([
            'report_at' => now()
        ]);
    }
}
