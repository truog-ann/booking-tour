<?php

namespace App\Http\Controllers\Admin;

use App\Enums\StatusPayment;
use App\Enums\StatusTour;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class StasticController extends Controller
{
    //
    public function index(Request $request)
    {
        $nowYear = $request->year ?? date("Y");
        $title = "Thống kê";
        $arr = [];
        //doanh thu theo tháng của năm
        for ($i = 1; $i <= 12; $i++) {
            $query = Booking::query()->where('deleted_at', null)
                ->where('status_payment', StatusPayment::PAID)
                ->where('status_tour', StatusTour::DONE)
                ->whereRaw('MONTH(created_at) = ' . $i)
                ->whereRaw('YEAR(created_at) = ' . $nowYear)
                ->sum('total_price');
            $arr[] = $query;
        }

        $tour_id = Booking::query()->where('deleted_at', null)
            ->groupBy('tour_id')
            ->pluck('tour_id');

        $tours = Tour::query()->whereIn('id', $tour_id)->limit(10)->get();
        //các năm
        $years = $query = Booking::query()->where('deleted_at', null)
            ->where('status_payment', StatusPayment::PAID)
            ->where('status_tour', StatusTour::DONE)

            ->selectRaw('year(created_at) as year')

            ->groupByRaw('year(created_at)')
            ->orderByDesc('year')

            ->get();

        //tổng doanh thu năm
        $total = Booking::query()->where('deleted_at', null)
            ->where('status_payment', StatusPayment::PAID)
            ->where('status_tour', StatusTour::DONE)
            ->whereRaw('YEAR(created_at) = ' . $nowYear)
            ->sum('total_price');

        $bookNew = Booking::where('deleted_at', null)->where('status_tour', StatusTour::WAITING)->count();
        $bookDone = Booking::where('deleted_at', null)->where('status_tour', StatusTour::DONE)->count();
        $bookCancel = Booking::where('deleted_at', null)->where('status_tour', StatusTour::CANCEL)->count();
        $dataBook = [
            'bookNew' => $bookNew,
            'bookDone' => $bookDone,
            'bookCancel' => $bookCancel
        ];
        return view("admin.stastics.index", compact('title', 'arr', 'total', 'years', 'tours', 'dataBook'));
    }
    public function indexApi(Request $request)
    {
        $nowYear = $request->year ?? date("Y");
        $arr = [];
        //doanh thu theo tháng của năm
        for ($i = 1; $i <= 12; $i++) {
            $query = Booking::query()->where('deleted_at', null)
                ->where('status_payment', StatusPayment::PAID)
                ->where('status_tour', StatusTour::DONE)
                ->whereRaw('MONTH(created_at) = ' . $i)
                ->whereRaw('YEAR(created_at) = ' . $nowYear)
                ->sum('total_price');
            $arr[] = $query;
        }


        //tổng doanh thu năm
        $total = Booking::query()->where('deleted_at', null)
            ->where('status_payment', StatusPayment::PAID)
            ->where('status_tour', StatusTour::DONE)
            ->whereRaw('YEAR(created_at) = ' . $nowYear)
            ->sum('total_price');
        return response()->json([
            'data' => $arr,
            'total' => $total
        ]);
    }
}
