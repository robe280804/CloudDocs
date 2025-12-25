<?php

namespace App\Listeners;

use App\Events\QdrantEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\LoadDocumentIntoVectorJob;

class LoadDocumentIntoVector implements ShouldQueue
{
    use InteractsWithQueue;
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(QdrantEvent $event): void
    {
        LoadDocumentIntoVectorJob::dispatch($event->documents);
    }
}
