<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;



class AdminActivityNotification extends Notification
{


use Queueable;



public $title;

public $message;




public function __construct($title,$message)

{

$this->title = $title;

$this->message = $message;

}





public function via($notifiable)

{

return ['database'];

}







public function toDatabase($notifiable)

{


return [


'title'=>$this->title,


'message'=>$this->message



];


}



}