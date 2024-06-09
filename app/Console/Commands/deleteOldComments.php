<?php

namespace App\Console\Commands;

use App\Models\Comment;
use Illuminate\Console\Command;

class deleteOldComments extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-comments';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete old comments';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $comments = Comment::where('created_at', '<', \Carbon\Carbon::now()->subDays(30)->toDateTimeString())
                    ->orWhereNull('author_id')->orWhere('author_id',0)
                    ->get();
        foreach ($comments as $comment) {
            $comment->delete();
        }
        $this->info('deleted old comments');
    }
}
