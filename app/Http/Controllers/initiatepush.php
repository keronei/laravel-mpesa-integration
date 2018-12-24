<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;

class initiatepush extends Controller
{
        public function pay(Request $request){
            $Amount =$request->input('amount');
            $phoneNumber =$request->input('phonenumber');
       
            $CallBackURL = 'https://integrate-payment.herokuapp.com/callback';
        
             Log::error('INITIATION PHONE RECEIVED: '.$phoneNumber);
        
        $mpesa= new \Safaricom\Mpesa\Mpesa();
        
        $stkPushSimulation=$mpesa->STKPushSimulation(174379, 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919', 'CustomerPayBillOnline', $Amount, $phoneNumber, 174379, $phoneNumber, $CallBackURL, 'lozadasuplies', 'lozada', 'Payment');

        echo "Processing . . .";
    }
}
