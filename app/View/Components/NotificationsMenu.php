<?php

namespace App\View\Components;

use App\Models\Client;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class NotificationsMenu extends Component
{
    public $notifications;
    public $newNotificationsCount;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($count = 6)
    {
        $client = Client::find( Auth::guard('client')->user()->id);
        $this->notifications         = $client->unreadNotifications()->limit($count)->get();
        $this->newNotificationsCount = $client->unreadNotifications()->count();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.notifications-menu');
    }
}
