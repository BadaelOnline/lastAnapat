<?php

namespace App\Notifications;

use App\Models\Cursos;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCourse extends Notification
{
    use Queueable;
    protected $cursos;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Cursos $cursos)
    {
        $this->cursos = $cursos;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return (new MailMessage)
            ->greeting('Hola!')
            ->line(@$this->cursos->entidades_formadoreas->nombre . ' agregó un nuevo curso.')
            ->action('Vista del curso', url('/admin/cursos/'))
            ->line('Mucho respeto y aprecio');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
