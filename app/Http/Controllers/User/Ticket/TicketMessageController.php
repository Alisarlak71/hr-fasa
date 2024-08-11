<?php

namespace App\Http\Controllers\User\Ticket;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use App\Services\File\FileManager;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TicketMessageController extends Controller
{
    /**
     * @param Request $request
     * @param Ticket $ticket
     * @param FileManager $fm
     * @return JsonResponse
     */
    public function store(Request $request, Ticket $ticket, FileManager $fm): JsonResponse
    {
        $request->validate([
            'body' => 'required|min:4',
            'files' => 'nullable|array',
        ]);

        $message = new TicketMessage();
        $message->user_id = \Auth::id();
        $message->ticket_id = $ticket->id;
        $message->body = $request->input('body');
        $message->save();

        $ticket->updated_at = Carbon::now();
        if(!empty($request->input('files'))){
            $fm->attachFile('tickets', $message->id, $request->input('files'));
        }

        return new JsonResponse(['message' => 'message submitted']);
    }
}
