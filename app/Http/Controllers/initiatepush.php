<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Log;

class initiatepush extends Controller
{
        public function pay(Request $request){
            $Amount =$request->input('amount');
            
            $phoneNumber = "254".substr($request['phonenumber'], -9);
       
            $CallBackURL = 'https://integrate-payment.herokuapp.com/callback';
        
             Log::error('INITIATION PHONE RECEIVED: '.$phoneNumber);
             
             if($Amount != 0){
                echo $phoneNumber;
        /*
                $mpesa= new \Safaricom\Mpesa\Mpesa();
                
                $stkPushSimulation=$mpesa->STKPushSimulation(174379, 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919', 'CustomerPayBillOnline', $Amount, $phoneNumber, 174379, $phoneNumber, $CallBackURL, 'lozadasuplies', 'lozada', 'Payment');
        
                
               if (!empty($stkPushSimulation)){
                
               $state = json_decode($stkPushSimulation);
               
               $ResponseCode = $state->ResponseCode;
               
               $CustomerMessage = $state->CustomerMessage;
               
               if ($ResponseCode == '0'){
               
               $MerchantRequestID = $state->MerchantRequestID;
               
               $CheckoutRequestID = $state->CheckoutRequestID;
                    
                    DB::insert('INSERT INTO payments
                            ( 
                            MerchantRequestID,
                            CheckoutRequestID
                            
                            )   values (?, ?)',
                            [$MerchantRequestID,
                             $CheckoutRequestID
                           ] );
                    return view('waiting', ['CheckoutRequestID' => $CheckoutRequestID,'CustomerMessage' =>$CustomerMessage,'complete'=>false]);
                    }else{
               
                 return view('waiting', ['CustomerMessage' =>$CustomerMessage,'complete'=>true]);
                    }
               }
               
                if(session()->has('_paystatus')){
                    echo "Something found in session!<br>".'<br>';
                  if ((session()->pull('_paystatus')) == '0'){
                    echo "Payment accepted successfully";
                    
                  }else{
                    $error_code = session()->pull('_paystatus');
                    echo "Payment Rejected, Please retry: error: ".$error_code;
                  }
                }
     */
        }else
        {
        echo "Go buy some tea with that amount"; 
        }
    
    }
}
