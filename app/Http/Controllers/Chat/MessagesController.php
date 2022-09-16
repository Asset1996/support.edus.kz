<?php
/**
 * Controller to work with messages.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Models\Tickets;
use App\Models\Messages;
use Illuminate\Http\RedirectResponse;

class MessagesController extends Controller
{

    /**
     * Updates the ticket status to "closed".
     *
     * @param string $ticket_uid - unique ID of ticket.
     * @return RedirectResponse
     */
    public function writeMessage(
        \App\Http\Requests\Chat\WriteMessageRequest $request,
        string $lang,
        string $ticket_uid,
        Tickets $ticket
    ): RedirectResponse
    {
        $last_message_order_num = Messages::select('order_num')->where([
            'ticket_uid' => $ticket_uid,
        ])->latest('order_num')->first()->order_num;

        $context['ticket_uid'] = $ticket_uid;
        $context['created_by_type'] = 0;
        $context['message_body'] = request()->input('message_body');
        $context['order_num'] = $last_message_order_num + 1;

        $message = new Messages();
        $message->_create($context);

        $ticket->_update(
            ['ticket_uid' => $ticket_uid],
            ['status_id' => 2],
        );

        return redirect()->back();
    }

    /**
     * Evaluates the message.
     */
    public function evaluateMessage(Messages $message)
    {
        $message_id = request()->input('message_id');
        $evaluation = request()->input('evaluation');
        $message->where(['id' => $message_id])->update(['evaluation'=> $evaluation]);
        return response(trans('Evaluation saved'), 200)
            ->header('Content-Type', 'text/plain');;
    }

}
