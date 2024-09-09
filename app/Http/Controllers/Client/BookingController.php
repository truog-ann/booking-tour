<?php

namespace App\Http\Controllers\Client;

use App\Enums\StatusPayment;
use App\Enums\StatusTour;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ResponseJson;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class BookingController extends Controller
{
    //
    protected $ResponseJson;
    public function __construct(ResponseJson $ResponseJson)
    {
        $this->ResponseJson = $ResponseJson;
    }
    public function showByUserId(Request $request)
    {
        $bookings = Booking::where('user_id', $request->id)->orderByDesc('created_at')->get();
        if ($bookings) {
            $status_payment = $request->status_payment;
            $status_tour = $request->status_tour;
            if ($status_payment) {
                $bookings = $bookings->where('status_payment', $status_payment);
            }
            if ($status_tour) {
                $bookings = $bookings->where('status_tour', $status_tour);
            }
            return $this->ResponseJson->responseSuccess($bookings);
        }
        return $this->ResponseJson->responseFailed('Không có dữ liệu');
    }
    public function showByBookingCode($code)
    {
        $bookings = Booking::where('booking_code', $code)->orderByDesc('created_at')->get();
        if ($bookings) {
            return $this->ResponseJson->responseSuccess($bookings);
        }
        return $this->ResponseJson->responseFailed('Không có dữ liệu');
    }
    public function cancelBooking(Request $request)
    {
        $query = Booking::query();
        if ($request->id && $request->id != null) {
            $query->where('user_id', $request->id);
        }
        $booking = $query->where('booking_code', 'LIKE', $request->booking_code)->first();
        $now = date("d-m-Y");
        if ($booking && $booking->start < $now) {
            if ($booking->status_tour == StatusTour::WAITING && $request->action == 'cancel') {
                if ($booking->status_payment == 1) {
                    $booking->status_payment = StatusPayment::REFUND;
                } else {
                    $booking->status_payment = StatusPayment::CANCEL;

                }
                $booking->status_tour = StatusTour::CANCEL;
                $booking->save();
                return $this->ResponseJson->responseSuccess($booking, 'Hủy thành công');
            }
            if (
                $booking->status_payment == StatusPayment::PAID
                && $booking->status_tour == StatusTour::WAITING
                && $request->action == 'refund'
            ) {
                $booking->status_payment = StatusPayment::REFUND;
                $booking->status_tour = StatusTour::CANCEL;
                $booking->save();
                return $this->ResponseJson->responseSuccess('Hoàn tiền thành công');
            }
            return $this->ResponseJson->responseFailed('Không thể cập nhật dữ liệu');

        }
        return $this->ResponseJson->responseFailed('Không có dữ liệu');
    }

}
