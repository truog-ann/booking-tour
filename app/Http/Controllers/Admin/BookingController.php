<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusPayment;
use App\Enums\StatusTour;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BookingController extends Controller
{

    public function index(Request $request)
    {

        $query = Booking::query();
        if ($request->code && $request->code != null) {
            $query->where('booking_code', 'LIKE', '%' . $request->code . '%');
        }
        if ($request->user_name && $request->user_name != null) {
            $query->where('user_name', 'LIKE', '%' . $request->user_name . '%');
        }
        if (isset($request->status_payment) && $request->status_payment != null) {
            $query->where('status_payment', intval($request->status_payment));
        }
        if (isset($request->status_tour) && $request->status_tour != null) {
            $query->where('status_tour', intval($request->status_tour));
        }
        $bookings = $query->orderByDesc('created_at')->paginate(10);

        $title = 'Bookings';

        return view('admin.Bookings.index', compact('bookings', 'title'));
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        if ($booking) {
            return response()->json($booking);
        }
        return response()->json();
    }
    public function show($id)
    {
        $booking = Booking::find($id);
        $booking->statusPayment = $booking->getNameStatusPayment();
        $booking->statusTour = $booking->getNameStatusTour();
        $booking->total_price = number_format($booking->total_price, 0, '.', '.') . " VNĐ";
        $booking->tour_price = number_format($booking->tour_price, 0, '.', '.') . " VNĐ";
        $booking->hotel_price = number_format($booking->hotel_price, 0, '.', '.') . " VNĐ";
        // dd($booking);
        if ($booking) {
            return response()->json($booking);
        }
        return response()->json();
    }

    public function update(Request $request)
    {
        $booking = Booking::find($request->id);
        // dd($request->all(),$booking);
        if ($booking) {
            if ($request->status_payment < $booking->status_payment || $request->status_tour < $booking->status_tour) {
                return redirect()->route('bookings.index')->with('error', "Không thể cập nhật trạng thái đơn hàng");
            }
            if ($request->status_tour == StatusTour::DONE) {
                $booking->update([
                    'status_payment' => StatusPayment::PAID,
                    'status_tour' => StatusTour::DONE,
                ]);
            } elseif ($request->status_tour == StatusTour::CANCEL) {
                if ($booking->status_payment == StatusPayment::PAID) {
                    $booking->update([
                        'status_payment' => StatusPayment::REFUND,
                        'status_tour' => StatusTour::CANCEL,
                    ]);
                } elseif ($booking->status_payment == StatusPayment::PENDING) {
                    $booking->update([
                        'status_payment' => StatusPayment::CANCEL,
                        'status_tour' => StatusTour::CANCEL,
                    ]);
                }
            } else {
                $booking->update($request->all());
            }
            return redirect()->route('bookings.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công');
        }
        return redirect()->route('bookings.index')->with('error', "Đơn hàng không tồn tại");
    }

    public function updatePaymentStatus(Request $request, $id, Booking $booking)
    {
        $booking->where('booking_code', $id)->update($request->all());
        return response()->json(array('success' => 'Booking updated successfully'));
    }


    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking deleted successfully.');
    }
}
