<?php
/**
 * Controller to work with tickets.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;
use App\Models\TicketsTmp;

class TicketsController extends Controller
{
    /**
     * Renders the createTicket view 
     * or redirects to home page, if the user is not a client.
     *
     * @return view/redirect 
     */
    public function askQuestion(){
        $user = Auth::user();
        if ($user && $user->roles_id != 1) {
            session()->flash('error_message', trans('Only clients have access to create a ticket'));
            return redirect()->home();
        }
        $service_types = \App\Models\Spr\SprServiceTypes::get();

        return view('pages.chat.createTicket', [
            'user' => $user,
            'service_types' => $service_types,
        ]);
    }

    /**
     * Processes the POST request from askQuestion page form.
     *
     * @param AskQuestionRequest $request - validation request.
     * @return redirect 
     */
    public function askQuestionPost(\App\Http\Requests\Chat\AskQuestionRequest $request){
        $context = request()->only(
            'email', 'name', 'title', 'initial_message', 'service_types_id'
        );
        $model = Auth::check() ? new Tickets() : new TicketsTmp();

        $ticket = $model->_create($context);

        if(!$model->hasErrors()){
            if ($model instanceof Tickets) {
                session()->flash('success_message', 'Ticket successfully created.');
            } elseif ($model instanceof TicketsTmp) {
                session()->flash('success_message', 'Ticket successfully created. You need to activate your email.');
            }
            return redirect()->route('ticket-created', ['ticket_id' => $ticket->id]);
        }

        session()->flash('error_message', $model->getFirstError());
        return redirect()->home();
    }

    /**
     * Renders the ticket successfully created view.
     *
     * @param int $ticket_id
     * @return view
     */
    public function ticketCreated($lang, $ticket_id){
        if (Auth::check()) {
            $template = 'pages.chat.ticketCreated';
            $ticket = Tickets::where(['id' => $ticket_id])->first();
        }else{
            $template = 'pages.chat.tempTicketCreated';
            $ticket = TicketsTmp::where(['id' => $ticket_id])->first();
        }

        return view($template, [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Renders the ticket list view.
     *
     * @return view
     */
    public function list(){
        $my_tickets = Tickets::where(['created_by' => Auth::user()->id])->get();

        return view('pages.chat.ticketsList', [
            'my_tickets' => $my_tickets,
        ]);
    }
}
