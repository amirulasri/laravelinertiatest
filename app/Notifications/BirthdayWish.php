<?php

namespace App\Notifications;

use App\Models\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BirthdayWish extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Contact $contact)
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Happy birthday!')
            ->greeting('Happy birthday!')
            ->line('Haii ' . $this->contact->fullname . ',' . ' Happy birthday! 🎉🎉🎉')
            ->line('Saya doakan semoga kamu panjang umur, sihat sentiasa, murah rezeki dan berjaya dalam hidup, dunia dan akhirat. Amin.')
            ->line('Reply ke whatsapp saya jika ada apa-apa kesilapan yee. 😊')
            ->action('Reply', url('https://wa.me/601135020493?text=Hai,%20nak%20reply%20dari%20email%20birthday'))
            ->line('Terima kasih kerana baca email ini dan selamat hari lahir sekali lagi. 🎂🎈🎁');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
