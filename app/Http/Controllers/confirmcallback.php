<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Log;

class confirmcallback extends Controller
{
    public function storeResults(Request $requests){
        
        $request=file_get_contents('php://input');
        
         Log::error('RECEIVED INFORMATION: '.$request);
        
        //process the received content into an array
        $decoded = json_decode($request);

            $status_result = $decoded->Body->stkCallback->ResultCode;
            
            $status_result_desc = $decoded->Body->stkCallback->ResultDesc;
            $CheckoutRequestID = $decoded->Body->stkCallback->CheckoutRequestID;
            
            if ($status_result == 0){
                
                    session()->put('_paystatus',0);
            
                    $decoded_body = $decoded->Body->stkCallback->CallbackMetadata;
                    
                    $specificAmount = $decoded_body->Item[0]->Value;
                    $specificMpesaReceiptNumber = $decoded_body->Item[1]->Value;
                   
                    $specificTransactionDate = $decoded_body->Item[3]->Value;
                    $specificPhoneNumber = $decoded_body->Item[4]->Value;
                    
    
                    DB::update('UPDATE payments set
                                   
                                   Amount =?,
                                   MpesaReceiptNumber =?,
                                   TransactionDate =?,
                                   PhoneNumber =?,
                                   ResultCode = ?
                                 
                                   where CheckoutRequestID = ?',
                                   [$specificAmount, 
                                   $specificMpesaReceiptNumber, 
                                   $specificTransactionDate, 
                                   $specificPhoneNumber,
                                   $status_result,
                                   $CheckoutRequestID
                                   
                                  ] );
                    
                 
                   //if execution reaches here, then all did went well!
                                    }
                    else{
                        session()->put('_paystatus',$status_result);
                        DB::update('UPDATE payments set
                                   
                                   ResultDesc =?,
                                   ResultCode = ?
                                 
                                   where CheckoutRequestID = ?',
                                   [
                                    $status_result_desc,
                                    $status_result,
                                   $CheckoutRequestID
                                   
                                  ] );
                        
                    
                    }

        
    }
   
}
