<?php
/**
 * Controller to work with messages.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tickets;
use App\Models\Messages;

class MessagesController extends Controller
{
    
    /**
     * Updates the ticket status to "closed".
     *
     * @param int $ticket_uid - unique ID of ticket.
     * @return redirect 
     */
    public function writeMessage(\App\Http\Requests\Chat\WriteMessageRequest $request, $lang, $ticket_uid){
        $last_message_order_num = Messages::select('order_num')->where([
            'ticket_uid' => $ticket_uid,
        ])->latest('order_num')->first()->order_num;

        $context['ticket_uid'] = $ticket_uid;
        $context['created_by_type'] = 1;
        $context['message_body'] = request()->input('message_body');
        $context['order_num'] = $last_message_order_num + 1;

        $ticket = new Tickets();
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
     *
     * @return view
     */
    public function evaluateMessage(){
        $message_id = request()->input('message_id');
        $evaluation = request()->input('evaluation');
        Messages::where(['id' => $message_id])->update(['evaluation'=> $evaluation]);
        return response(trans('Evaluation saved'), 200)->header('Content-Type', 'text/plain');;
    }

}
