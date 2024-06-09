<?php

namespace App\Http\Services;

use App\Models\User;
use Twilio\Rest\Client;
use App\Notifications\MyNotification;
use Illuminate\Support\Facades\Notification;

class TwilioService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendSMS($to, $message)
    {
        
        $user = User::find(1);
        // Notification::route('mail' , $user)->notify(new MyNotification($user['name']));
        $user->notify(new MyNotification());
        return $this->client->messages->create($to, [
            'from' => env('TWILIO_PHONE_NUMBER'),
            'body' => $message,
        ]);
       
    }
}