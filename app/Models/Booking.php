<?php

namespace App\Models;

use App\Enums\StatusPayment;
use App\Enums\StatusTour;
use App\Events\BookingCreate;
use App\Events\BookingStatusUpdated;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
class Booking extends Model
{
    use Notifiable;
    use HasFactory;
    use SoftDeletes;
    protected $table = 'bookings';
    protected $dispatchesEvents = [
        'created' => BookingCreate::class,
        'updated' => BookingStatusUpdated::class
    ];
    protected $fillable = [
        'booking_code',
        'user_name',
        'email',
        'phone',
        'tour_id',
        'tour_name',
        'tour_price',
        'tour_address',
        'hotel_name',
        'hotel_price',
        'hotel_address',
        'book_price',
        'promotion_price',
        'total_price',
        'people',
        'start',
        'end',
        'status_payment',
        'status_tour',
        'user_id',
        'kids',
        'adults',
        'children2To5',
        'children6To12'

    ];
    public function getNameStatusPayment()
    {
        return StatusPayment::getValueByKey($this->status_payment);
    }
    public function getNameStatusTour()
    {
        return StatusTour::getValueByKey($this->status_tour);
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
