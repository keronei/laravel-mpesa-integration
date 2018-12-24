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
        $decoded = json_decode($response);

            $status_result = $decoded->Body->stkCallback->ResultCode;
            
            $status_result_desc = $decoded->Body->stkCallback->ResultDesc;
            
            if ($status_result == 0){
            
                    $decoded_body = $decoded->Body->stkCallback->CallbackMetadata;
                    
                    $specificAmount = $decoded_body->Item[0]->Value;
                    $specificMpesaReceiptNumber = $decoded_body->Item[1]->Value;
                    $orgaccountbalance = $decoded_body->Item[2]->Value;
                    $specificTransactionDate = $decoded_body->Item[3]->Value;
                    $specificPhoneNumber = $decoded_body->Item[4]->Value;
                    
    
                    DB::insert('INSERT INTO payments
                                   ( 
                                   Amount,
                                   MpesaReceiptNumber,
                                   TransactionDate,
                                   PhoneNumber,
                                   Balance
                                   )   values (?, ?, ?, ?, ?)',
                                   [$specificAmount, 
                                   $specificMpesaReceiptNumber, 
                                   $specificTransactionDate, 
                                   $specificPhoneNumber, 
                                   
                                   $orgaccountbalance] );
                   //if execution reaches here, then all did went well!
                   return view('success', ['receipt' => $specificMpesaReceiptNumber,'amount' => $specificAmount]);
                                    }
                    else{
                        return view('success', ['reason' => $status_result_desc]);
                    }

        
    }
}
