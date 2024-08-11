<?php

namespace App\Listeners;

use App\Events\ImportDataProcessed;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendReportNotification
{
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
    public function handle(ImportDataProcessed $event): void
    {
//        $file = $event->reportFileLog;
//        $file->status = 0;
//        $file->save();
    }
}
