<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class LicenceHasCloseExpiryDate extends Notification
{
    use Queueable;

    private $licences;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($licences)
    {
        $this->licences = $licences;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['slack'];
    }

    public function toSlack($notifiable)
    {
        $content = '';
        foreach ($this->licences as $licence) {
            $content .= "<" . route('licence', $licence->id) . "|" . $licence->tool->name . ">\n";
        }

        return (new SlackMessage)
            ->from(config('app.name'))
            ->content('Licences are soon to expire.')
            ->to('#digital-tooling-management-test')
            ->attachment(function($attachment) use ($content) {
                $attachment->title('The following tools are affected, please investigate:')
                    ->content($content);
            });
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
