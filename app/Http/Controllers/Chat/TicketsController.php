<?php
/**
 * Controller to work with tickets.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;
use App\Models\TicketsTmp;
use App\Models\Uploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TicketsController extends Controller
{
    protected $sprs_caching_seconds = 86400;
    protected $model_caching_seconds = 86400;

    /**
     * Renders the createTicket view 
     * or redirects to home page, if the user is not a client.
     *
     * @return view/redirect 
     */
    public function createTicket(){
        $user = Auth::user();
        if ($user && $user->roles_id != 1) {
            session()->flash('error_message', trans('Only clients have access to create a ticket'));
            return redirect()->home();
        }
        $service_types = Cache::remember('service_types', $this->sprs_caching_seconds, function () {
            return \App\Models\Spr\SprServiceTypes::get();
        });
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
    public function createTicketPost(\App\Http\Requests\Chat\AskQuestionRequest $request){
        $context = request()->only(
            'email', 'name', 'title', 'initial_message', 'service_types_id'
        );
        $model = Auth::check() ? new Tickets() : new TicketsTmp();

        $ticket = $model->_create($context);
        if(request()->has('ask_images')){
            $upload_model = new Uploads();
            foreach(request()->file('ask_images') as $img){
                $fileName = uniqid() . '.' . $img->extension();
                $filePath = 'images/'. date('Y') . '/' . date('m') . '/' . date('d') . '/' .$fileName;
                Storage::disk('public')->put($filePath, $img->get());
                $context = [
                    'name' => $fileName,
                    'original_name' => $img->getClientOriginalName(),
                    'ticket_uid' => $ticket->ticket_uid,
                    'path' => 'storage/' . $filePath,
                    'extention' => $img->extension(),
                    'size' => $img->getSize()
                ];
                $upload_model->_create($context);
            }
        }

        if(!$model->hasErrors()){
            if ($model instanceof Tickets) {
                Cache::put('my_tickets', '', 0);
                session()->flash('success_message', trans('Ticket successfully created'));
            } elseif ($model instanceof TicketsTmp) {
                session()->flash('success_message', trans('Ticket successfully created. You need to activate your email'));
            }
            return redirect()->route('ticket-created', ['ticket_uid' => $ticket->ticket_uid]);
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
    public function ticketCreated($lang, $ticket_uid){
        if (Auth::check()) {
            $template = 'pages.chat.ticketCreated';
            $ticket = Tickets::where(['ticket_uid' => $ticket_uid])->first();
        }else{
            $template = 'pages.chat.tempTicketCreated';
            $ticket = TicketsTmp::where(['ticket_uid' => $ticket_uid])->first();
        }
        // echo '<pre>' . print_r($ticket, true);exit();

        return view($template, [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Renders the ticket list view.
     *
     * @return view
     */
    public function listTickets(){
        $my_tickets = Cache::remember('my_tickets', $this->model_caching_seconds, function () {
            return Tickets::where(['created_by' => Auth::user()->id])->get();
        });

        return view('pages.chat.ticketsList', [
            'my_tickets' => $my_tickets,
        ]);
    }

    /**
     * Renders the single ticket view.
     *
     * @return view
     */
    public function viewTicket($lang, $ticket_uid){
        $ticket = Tickets::where(['ticket_uid' => $ticket_uid])->first();
        // echo '<pre>' . print_r($ticket, true);exit();
        return view('pages.chat.viewTicket', [
            'ticket' => $ticket,
        ]);
    }
    /**
     * Update the ticket.
     *
     * @return view
     */
    public function updateTicket($lang, $ticket_uid){
        $my_ticket = Tickets::where(['ticket_uid' => $ticket_uid])->first();

        $service_types = Cache::remember('service_types', $this->sprs_caching_seconds, function () {
            return \App\Models\Spr\SprServiceTypes::get();
        });

        return view('pages.chat.updateTicket', [
            'user' => Auth::user(),
            'service_types' => $service_types,
            'my_ticket' => $my_ticket,
        ]);
    }

    /**
     * Processes the POST request from update ticket page form.
     *
     * @param AskQuestionRequest $request - validation request.
     * @return redirect 
     */
    public function updateTicketPost(\App\Http\Requests\Chat\AskQuestionRequest $request, $lang, $ticket_uid){
        $context = request()->only(
            'title', 'initial_message', 'service_types_id'
        );
        $conditions['ticket_uid'] = $ticket_uid;

        $my_ticket = new Tickets();
        $my_ticket->_update($conditions, $context);

        Cache::put('my_tickets', '', 0);
        session()->flash('success_message', trans('Ticket successfully updated'));
        return redirect()->route('tickets-list');
    }

    /**
     * Processes the POST request from update ticket page form.
     *
     * @param int $ticket_uid - unique ID of ticket.
     * @return redirect 
     */
    public function deleteTicket($lang, $ticket_uid){
        $conditions['ticket_uid'] = $ticket_uid;

        $my_ticket = new Tickets();
        $my_ticket->_delete($conditions);

        if($my_ticket->hasErrors()){
            session()->flash('error_message', $my_ticket->getFirstError());
        }else{
            Cache::put('my_tickets', '', 0);
            session()->flash('success_message', trans('Ticket successfully deleted'));
        }
        
        return redirect()->route('tickets-list');
    }

    /**
     * Updates the ticket status to "closed".
     *
     * @param int $ticket_uid - unique ID of ticket.
     * @return redirect 
     */
    public function closeTicket($lang, $ticket_uid){
        Tickets::where(['ticket_uid' => $ticket_uid])->update(['status_id' => 4]);

        session()->flash('success_message', trans('Ticket successfully closed'));
        
        return redirect()->back();
    }
}
