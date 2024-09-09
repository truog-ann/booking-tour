<?php

namespace App\Notifications;

use App\Mail\BookingSuccess;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewBooking extends Notification
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
    public function toMail(object $notifiable): Mailable
    {
        // $total = number_format($this->booking->total_price, 0, '.', '.');
        return (new BookingSuccess($this->booking))
            ->to($this->booking->email);

        // ->line("Cảm ơn {$this->booking->user_name} đã sử dụng dịch vụ.")
        // ->line("Mã đơn hàng: {$this->booking->booking_code}")
        // ->line("Tên: {$this->booking->user_name}")
        // ->line("Email: {$this->booking->email}")
        // ->line("SĐT: {$this->booking->phone}")
        // ->line("Số người: {$this->booking->people}")
        // ->line("Ngày đặt: {$this->booking->created_at->format('d-m-Y')}")
        // ->line("Tổng tiền: {$total} VNĐ")
        // ->action('Trang chủ', url('http://localhost:5173'))
        // ->line('Xin trân trọng cảm ơn');
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
