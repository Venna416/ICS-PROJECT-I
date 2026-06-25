<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;


class SellerVerificationStatus extends Notification
{

use Queueable;


public $seller;



public function __construct($seller)

{

$this->seller = $seller;

}




public function via($notifiable)

{

return ['database'];

}




public function toDatabase($notifiable)

{


if($this->seller->verification_status == 'verified')

{

$title = "✅ Seller Account Verified";

$message = 
"Congratulations! Your seller account has been verified successfully.";

}



elseif($this->seller->verification_status == 'rejected')

{

$title = "❌ Seller Verification Rejected";


$message = 
"Your seller verification was rejected. Reason: "
.$this->seller->verification_reason;

}



else

{

$title = "⏳ Verification Pending";


$message =
"Your seller verification is still under review.";

}




return [


'title'=>$title,


'message'=>$message,


'status'=>$this->seller->verification_status,


'seller_id'=>$this->seller->id



];


}



}