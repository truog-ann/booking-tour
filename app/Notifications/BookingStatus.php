<?php

namespace App\Notifications;

use App\Enums\StatusTour;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BookingStatus extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public Booking $booking)
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
            ->subject('Cập nhật đơn hàng')
            ->line("Đơn hàng #{$this->booking->booking_code} đã cập nhật thành công.")
            ->line("Trạng thái đơn hàng:  " . strip_tags($this->booking->getNameStatusTour()) . ".")
            ->line("Trạng thái thanh toán:  " . strip_tags($this->booking->getNameStatusPayment()) . ".")
            ->line('Cảm ơn vì đã đến!');
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
