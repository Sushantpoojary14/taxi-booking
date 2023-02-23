<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Notifications\Facades\Vonage;
use App\Notifications\SmsNotification;
class NotificationController extends Controller
{

    public function sendSmsNotificaition()
    {
        $user =User:: query()
        ->where('phone','8805778742');
        dd($user);
        $user->notify(new SmsNotification);
        return "mesage";
    }
}
