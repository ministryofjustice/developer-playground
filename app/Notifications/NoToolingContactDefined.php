<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\SlackMessage;
use Illuminate\Notifications\Notification;

class NoToolingContactDefined extends Notification
{
    use Queueable;

    private $tools;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($tools)
    {
        $this->tools = $tools;
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
        foreach ($this->tools as $tool) {
            $content .= "<" . route('tool', $tool->slug) . "|" . $tool->name . ">\n";
        }

        return (new SlackMessage)
            ->from(config('app.name'))
            ->content('Tooling contacts are missing or invalid.')
            ->to('#digital-tooling-management-test')
            ->attachment(function($attachment) use ($content) {
                $attachment->title('Please assign a valid contact for the following:')
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
