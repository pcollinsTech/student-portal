<?php

namespace App\Notifications;

use App\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyPharmacyStudent extends Notification
{
    use Queueable;


    protected $pharmacyStudent;
    /**
     * Create a new notification instance.
     *
     * @param Student $student
     */
    public function __construct($pharmacyStudent)
    {
        $this->pharmacyStudent = $pharmacyStudent;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You\'ve had a new student apply for Placement.')
                    ->line('Please click the link below to accept to be the students Tutor.')
                    ->action('Verify Student', url('/verify/pharmacy/' . $this->pharmacyStudent->activation_code));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
