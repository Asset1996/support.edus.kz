<?php
/**
 * Controller to work with tickets.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\CreateTicketRequest;
use App\Http\Requests\Chat\UpdateTicketRequest;
use App\Models\Messages;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\Tickets;
use App\Models\TicketsTmp;
use App\Models\Uploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Cache;

class TicketsController extends Controller
{
    protected object $ticket;

    /**
     * Constructor of the class.
     *
     * @return void
     */
    public function __construct(){
        $this->middleware(function ($request, $next) {
            $this->ticket = Auth::check() ? new Tickets() : new TicketsTmp();
            return $next($request);
        }, ['only' => ['createTicketPost', 'ticketCreated']]);
        $this->middleware('client',
            ['only' => ['createTicket', 'createTicketPost']]
        );
    }

    /**
     * Renders the createTicket view
     * or redirects to home page, if the user is not a client.
     *
     * @param Auth $auth
     * @return View
     */
    public function createTicket(Auth $auth): View
    {
        $user = $auth::user();
        $service_types = Cache::remember('service_types', 86400, function () {
            return \App\Models\Spr\SprServiceTypes::get();
        });
        return View('pages.chat.createTicket', [
            'user' => $user,
            'service_types' => $service_types,
        ]);
    }

    /**
     * Processes the POST request from askQuestion page form.
     *
     * @param CreateTicketRequest $request - validation request.
     * @return RedirectResponse
     * @throws FileNotFoundException
     */
    public function createTicketPost(CreateTicketRequest $request): RedirectResponse
    {
        $context = request()->only(
            'email', 'name', 'title', 'initial_message', 'service_types_id'
        );
        $model = $this->ticket;

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
                    'type' => explode('/', $img->getMimeType())[0],
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
                session()->flash(
                    'success_message',
                    trans('Ticket successfully created. You need to activate your email')
                );
            }
            return redirect()->route('ticket-created', ['ticket_uid' => $ticket->ticket_uid]);
        }

        session()->flash('error_message', $model->getFirstError());
        return redirect()->home();
    }

    /**
     * Renders the ticket successfully created view.
     *
     * @param $lang
     * @param string $ticket_uid
     * @return View
     */
    public function ticketCreated($lang, string $ticket_uid): View
    {
        if ($this->ticket instanceof Tickets) {
            $template = 'pages.chat.ticketCreated';
        }else{
            $template = 'pages.chat.tempTicketCreated';
        }
        $ticket = $this->ticket::where(['ticket_uid' => $ticket_uid])->first();

        return View($template, [
            'ticket' => $ticket,
        ]);
    }

    /**
     * Renders the ticket list view.
     *
     * @return view
     */
    public function listTickets(): View
    {
        $my_tickets = Cache::remember('my_tickets', 86400, function () {
            return Tickets::where(['created_by' => Auth::user()->id])->get();
        });

        return View('pages.chat.ticketsList', [
            'my_tickets' => $my_tickets,
        ]);
    }

    /**
     * Renders the single ticket view.
     *
     * @param $lang
     * @param $ticket_uid
     * @return view
     */
    public function viewTicket($lang, string $ticket_uid): View
    {
        $my_ticket = Tickets::where([
            'ticket_uid' => $ticket_uid,
            'created_by' => auth()->user()->id
        ])->first();

        if (!$my_ticket){
            abort(404);
        }

        return View('pages.chat.viewTicket', [
            'ticket' => $my_ticket,
        ]);
    }

    /**
     * Update the ticket.
     *
     * @param $lang
     * @param string $ticket_uid
     * @return View
     */
    public function updateTicket($lang, string $ticket_uid): View
    {
        $my_ticket = Tickets::where([
            'ticket_uid' => $ticket_uid,
            'created_by' => auth()->user()->id
        ])->first();

        if (!$my_ticket){
            abort(404);
        }

        return View('pages.chat.updateTicket', [
            'user' => Auth::user(),
            'my_ticket' => $my_ticket,
        ]);
    }

    /**
     * Processes the POST request from update ticket page form.
     *
     * @param UpdateTicketRequest $request - validation request.
     * @param $lang
     * @param $ticket_uid
     * @return RedirectResponse
     */
    public function updateTicketPost(UpdateTicketRequest $request, $lang, $ticket_uid): RedirectResponse
    {
        $context = request()->only(
            'title', 'initial_message'
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
     * @param $lang
     * @param string $ticket_uid - unique ID of ticket.
     * @return RedirectResponse
     */
    public function deleteTicket($lang, string $ticket_uid): RedirectResponse
    {
        $conditions['ticket_uid'] = $ticket_uid;

        $uplaods = new Uploads();
        $my_ticket = new Tickets();
        $my_ticket->_delete($conditions);

        if($my_ticket->hasErrors()){
            session()->flash('error_message', $my_ticket->getFirstError());
        }else{
            Cache::put('my_tickets', '', 0);
            $uplaods->delete_with_files($conditions);
            session()->flash('success_message', trans('Ticket successfully deleted'));
        }

        return redirect()->route('tickets-list');
    }

    /**
     * Updates the ticket status to "closed".
     *
     * @param $lang
     * @param string $ticket_uid - unique ID of ticket.
     * @return RedirectResponse
     */
    public function closeTicket($lang, string $ticket_uid): RedirectResponse
    {
        Tickets::where(['ticket_uid' => $ticket_uid])->update(['status_id' => 4]);

        session()->flash('success_message', trans('Ticket successfully closed'));

        return redirect()->back();
    }

    /**
     * Evaluates the ticket.
     */
    public function evaluateTicket(Tickets $tickets)
    {
        $ticket_id = request()->input('ticket_id');
        $evaluation = request()->input('evaluation');
        $tickets->where(['id' => $ticket_id])->update(['evaluation'=> $evaluation]);
        return response(trans('Evaluation saved'), 200)
            ->header('Content-Type', 'text/plain');;
    }
}
