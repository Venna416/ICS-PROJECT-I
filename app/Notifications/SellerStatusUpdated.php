<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class SellerStatusUpdated extends Notification
{
    use Queueable;

    protected $profile;
    protected $status;

    // Pass the profile instance and the new status string into the constructor
    public function __construct($profile, $status)
    {
        $this->profile = $profile;
        $this->status = $status;
    }

    // Define the delivery channels
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    // Build the Email Structure
    public function toMail($notifiable)
    {
        $message = (new MailMessage)
            ->subject('OSVS Profile Verification Update')
            ->greeting('Hello ' . $notifiable->name . '!')
            ->line('There is an update regarding your seller profile verification status for "' . $this->profile->brand_name . '".');

        if ($this->status === 'approved') {
            $message->line('Congratulations! Your business profile has been reviewed and approved.')
                    ->action('View Your Dashboard', url('/dashboard'))
                    ->line('You now have a verified vendor badge on our landing registry.');
        } else {
            $message->line('Regrettably, your profile submission could not be verified at this time.')
                    ->line('Please review your details and re-upload clear validation documents.')
                    ->action('Update Profile Data', route('seller.profile.edit', $this->profile->id));
        }

        return $message;
    }

    // Build the Database Array Payload
    public function toArray($notifiable)
    {
        return [
            'profile_id' => $this->profile->id,
            'brand_name' => $this->profile->brand_name,
            'status' => $this->status,
            'message' => 'Your seller profile status has been marked as ' . $this->status . '.'
        ];
    }
}