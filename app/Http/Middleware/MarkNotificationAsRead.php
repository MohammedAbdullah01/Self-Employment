<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarkNotificationAsRead
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $client = Auth::guard('client')->user();
        $notifiy_id = $request->query('notify');

        if ($notifiy_id){
            $notification =  $client->unreadNotifications()->find($notifiy_id);

            if($notification){
                $notification->markAsRead();
                // $notification->delete();


            }
        }
        return $next($request);
    }
}

