<?php

namespace App\Http\Controllers;

use App\Mail\BookingSuccess;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Number;
use App\Jobs\CreateBookingJob;
use App\Http\Controllers\ResponseJson;

class PaymentController extends Controller

{
    public function createPayment(Request $request, ResponseJson $responseJson)
    {
        // Prepare payment parameters

        $max = 45;
        $totalPeople = Booking::where('tour_id', $request->tour_id)->where('start', $request->start)->sum('people');
        if ($totalPeople + $request->people > $max) {
            return $responseJson->responseSuccess($totalPeople + $request->people - $max, 'Quá số lượng người tham gia trong đợt');
        } else {
            CreateBookingJob::dispatch($request->all());
        }
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:5173/paymentSuccess";
        $vnp_TmnCode = "JNX5BU3J"; //Mã website tại VNPAY 
        $vnp_HashSecret = "3LOIJOCBALY2FWV4LC2DQXZJ0LY4VJHI"; //Chuỗi bí mật
        $vnp_TxnRef = $request['booking_code'];
        $vnp_OrderInfo = 'Thanh Toán Tour: ' . $request->title;
        $vnp_OrderType = 1000;
        $vnp_Amount = $request->total_price * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        // Mail::to($request->email)->send(new BookingSuccess($booking));
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
        // vui lòng tham khảo thêm tại code demo

        // Add other parameters and create checksum
        // Redirect to VNPay payment page
    }

    public function rePay (Request $request){
        $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = "http://localhost:5173/paymentSuccess";
        $vnp_TmnCode = "JNX5BU3J"; //Mã website tại VNPAY 
        $vnp_HashSecret = "3LOIJOCBALY2FWV4LC2DQXZJ0LY4VJHI"; //Chuỗi bí mật
        $vnp_TxnRef = $request['booking_code'];
        $vnp_OrderInfo = 'Thanh Toán Tour: ' . $request->title;
        $vnp_OrderType = 1000;
        $vnp_Amount = $request->total_price * 100;
        $vnp_Locale = 'VN';
        $vnp_BankCode = 'NCB';
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $inputData = array(
            "vnp_Version" => "2.1.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            $inputData['vnp_Bill_State'] = $vnp_Bill_State;
        }

        //var_dump($inputData);
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashdata .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        $returnData = array(
            'code' => '00',
            'message' => 'success',
            'data' => $vnp_Url
        );

        // Mail::to($request->email)->send(new BookingSuccess($booking));
        if (isset($_POST['redirect'])) {
            header('Location: ' . $vnp_Url);
            die();
        } else {
            echo json_encode($returnData);
        }
    }

    public function bankingPayment(Request $request, ResponseJson $responseJson)
    {
        try {
            
            $max = 45;
            $totalPeople = Booking::where('tour_id', $request->tour_id)->where('start', $request->start)->sum('people');   
            if (($totalPeople + $request->people) > $max) {
                return $responseJson->responseSuccess($totalPeople + $request->people - $max, 'Quá số lượng người tham gia trong đợt');
            } else {
                CreateBookingJob::dispatch($request->all());
            }
            return response()->json([
                'message' => 'Đặt Lịch Thành Công!!!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Đã Xảy Ra Lỗi Trong Quá Trình Đặt Lịch! Vui Lòng Thử Lại Sau!',
            ], 500);
        }
    }

    public function cashPayment(Request $request, ResponseJson $responseJson)
    {
        try {
            $max = 45;
            $totalPeople = Booking::where('tour_id', $request->tour_id)->where('start', $request->start)->sum('people');
            if ($totalPeople + $request->people > $max) {
                return $responseJson->responseSuccess($totalPeople + $request->people - $max, 'Quá số lượng người tham gia trong đợt');
            } else {
                CreateBookingJob::dispatch($request->all());
            }
            return response()->json([
                'message' => 'Đặt Lịch Thành Công!!!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Đã Xảy Ra Lỗi Trong Quá Trình Đặt Lịch! Vui Lòng Thử Lại Sau!',
            ], 500);
        }
    }
}
