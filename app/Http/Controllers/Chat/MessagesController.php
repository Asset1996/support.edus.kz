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
        $last_message = Messages::select(['order_num', 'created_at'])->where([
            'ticket_uid' => $ticket_uid,
        ])->latest('order_num')->first();

        $last_message_order_num = $last_message->order_num;
        $last_message_created_at = $last_message->created_at;

        $diff_ru = $diff_kk = '';
        $diff_in_days = $last_message_created_at->floatDiffInDays(now());
        $diff_in_hours = $last_message_created_at->floatDiffInHours(now());
        $diff_in_minutes = $last_message_created_at->diffInMinutes(now());
        $diff_ru = round($diff_in_days) . ' дней назад';
        $diff_kk = round($diff_in_days) . ' кун бурын';
        if ($diff_in_days < 1 && $diff_in_hours > 1){
            $diff_ru = round($diff_in_hours) . ' часа назад';
            $diff_kk = round($diff_in_hours) . ' сагат бурын';
        }elseif($diff_in_hours < 1){
            $diff_ru = round($diff_in_minutes) . ' минут назад';
            $diff_kk = round($diff_in_hours) . ' минут бурын';
        }

        $context['ticket_uid'] = $ticket_uid;
        $context['created_by_type'] = 1; //1 - client
        $context['message_body'] = request()->input('message_body');
        $context['order_num'] = $last_message_order_num + 1;
        $context['answered_in_ru'] = $diff_ru;
        $context['answered_in_kk'] = $diff_kk;

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
