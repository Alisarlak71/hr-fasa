<?php

namespace App\Events;

use App\Models\ReportFileLog;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ImportDataProcessed implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ReportFileLog $reportFileLog;

    /**
     * Create a new event instance.
     */
    public function __construct(ReportFileLog $reportFileLog)
    {
        $this->reportFileLog = $reportFileLog;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new Channel('transactionImport'),
        ];
    }

    /**
     * @return array
     */
    public function broadcastWith(): array
    {
        return ['data' => $this->reportFileLog];
    }
}
