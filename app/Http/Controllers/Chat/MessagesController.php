<?php
/**
 * Controller to work with messages.
 */
namespace App\Http\Controllers\Chat;

use App\Http\Controllers\Controller;
use App\Http\Requests\Chat\WriteMessageRequest;
use App\Models\Tickets;
use App\Models\Messages;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;

class MessagesController extends Controller
{

    /**
     * Updates the ticket status to "closed".
     *
     * @param WriteMessageRequest $request
     * @param string $lang
     * @param string $ticket_uid - unique ID of ticket.
     * @param Tickets $ticket
     * @param Messages $message
     * @return RedirectResponse
     */
    public function writeMessage(
        \App\Http\Requests\Chat\WriteMessageRequest $request,
        string $lang,
        string $ticket_uid,
        Tickets $ticket,
        Messages $message
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

        $context = [
            'ticket_uid' => $ticket_uid,
            'created_by_type' => 1, //1 - client,
            'message_body' => request()->input('message_body'),
            'order_num' => $last_message_order_num + 1,
            'answered_in_ru' => $diff_ru,
            'answered_in_kk' => $diff_kk,
        ];

        $message->_create($context);
        $ticket->_update(
            ['ticket_uid' => $ticket_uid],
            ['status_id' => 2],
        );

        Cache::put('my_tickets', '', 0);

        Mail::to("support@edus.kz")
            ->send(new \App\Mail\MessageSentNotifyEmail(
                auth()->user()->email,
                route('view-ticket', ['ticket_uid' => $ticket_uid]),
                request()->input('message_body')
            ));

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
