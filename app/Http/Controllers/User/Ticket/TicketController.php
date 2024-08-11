<?php

namespace App\Http\Controllers\User\Ticket;

use App\Enums\TicketPriorities;
use App\Enums\TicketStatuses;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketMessage;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class TicketController extends Controller
{
    /**
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function index(): View|\Illuminate\Foundation\Application|Factory|Application
    {
        /** @var Ticket $latest_ticket */
        $latest_ticket = Ticket::whereUserId(\Auth::id())->with(['messages','messages.user','messages.files'])->orderByDesc('updated_at')->first();

        if ($latest_ticket){
            TicketMessage::whereTicketId($latest_ticket->id)->where('user_id','!=',\Auth::id())->update(['is_read' => true]);
        }

        return view('dashboard.user.tickets')->with(['title'=>'تیکت ها',
            'tickets'=> Ticket::whereUserId(\Auth::id())->with('unreadMessages')->orderByDesc('updated_at')->paginate(),
            'latest_ticket' => $latest_ticket->load(['messages.files','messages.user'])]);
    }

    /**
     * @param Ticket $ticket
     * @return View|\Illuminate\Foundation\Application|Factory|Application
     */
    public function show(Ticket $ticket): View|\Illuminate\Foundation\Application|Factory|Application
    {
        TicketMessage::whereTicketId($ticket->id)->where('user_id', '!=', \Auth::id())->update(['is_read' => true]);
        return view('dashboard.user.tickets')->with(['title' => 'تیکت ها',
            'tickets' => Ticket::whereUserId(\Auth::id())->with('unreadMessages')->orderByDesc('updated_at')->paginate(),
            'latest_ticket' => $ticket->load(['messages.files','messages.user'])]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|min:5',
            'subject_id' => 'required|exists:subjects,id',
            'priority' => ['required',TicketPriorities::validation()],
            'message' => 'required|string|min:4',
        ]);

        $ticket = new Ticket();
        $ticket->title = $request->input('title');
        $ticket->subject_id = $request->input('subject_id');
        $ticket->priority = $request->input('priority');
        $ticket->status = TicketStatuses::OPENED;
        $ticket->user_id = \Auth::id();
        $ticket->save();

        $message = new TicketMessage();
        $message->body = $request->input('message');
        $message->user_id = \Auth::id();
        $message->save();

        return new JsonResponse(['messages'=>'success!']);
    }

    /**
     * @param Ticket $ticket
     * @return Application|\Illuminate\Foundation\Application|RedirectResponse|Redirector
     */
    public function open(Ticket $ticket): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $ticket->status = TicketStatuses::OPENED;
        $ticket->save();

        return redirect('/tickets/'.$ticket->id);
    }

    /**
     * @param Ticket $ticket
     * @return \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
     */
    public function close(Ticket $ticket): \Illuminate\Foundation\Application|Redirector|RedirectResponse|Application
    {
        $ticket->status = TicketStatuses::CLOSED;
        $ticket->save();

        return redirect('/tickets/'.$ticket->id);
    }
}
