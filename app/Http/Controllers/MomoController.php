<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MomoController extends Controller
{

    protected $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    protected $partnerCode = 'MOMOBKUN20180529';
    protected $accessKey = 'klm05TvNBzhg7h7j';
    protected $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    protected $orderInfo = "Thanh toán qua MoMo";
    protected $redirectUrl = "http://localhost:5173/paymentSuccess";
    protected $ipnUrl = "http://localhost:5173/paymentSuccess";
    protected $extraData = "";
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }


    public function createPayment(Request $request)
    {
        $request['booking_code'] =  time() . "";

        if (!empty($_POST)) {
            $partnerCode = $this->partnerCode;
            $accessKey = $this->accessKey;
            $serectkey = $this->secretKey;
            $orderId = $request['booking_code']; // Mã đơn hàng
            $orderInfo = $_POST["orderInfo"];
            $amount = $_POST["amount"];
            $ipnUrl = $_POST["ipnUrl"];
            $redirectUrl = $_POST["redirectUrl"];
            $extraData = $_POST["extraData"];

            $requestId = time() . "";
            $requestType = "payWithATM";
            $extraData = ($_POST["extraData"] ? $_POST["extraData"] : "");
            //before sign HMAC SHA256 signature
            $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
            $signature = hash_hmac("sha256", $rawHash, $serectkey);
            $data = array(
                'partnerCode' => $partnerCode,
                'partnerName' => "Test",
                "storeId" => "MomoTestStore",
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'redirectUrl' => $redirectUrl,
                'ipnUrl' => $ipnUrl,
                'lang' => 'vi',
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature
            );
            $result = $this->execPostRequest($this->endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json

            //Just a example, please check more in there

            header('Location: ' . $jsonResult['payUrl']);
        }
    }
}
