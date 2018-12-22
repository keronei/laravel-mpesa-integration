<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Illuminate\Support\Facades\Log;

class confirmcallback extends Controller
{
    public function storeResults(Request $requests){
        
        $request=file_get_contents('php://input');
        
        //process the received content into an array
        $array = json_decode($request, true);
        $transactiontype= $array['TransactionType']; 
        $transid=$array['TransID']; 
        $transtime=$array['TransTime']; 
        $transamount=$array['TransAmount']; 
        $businessshortcode=$array['BusinessShortCode']; 
        $billrefno=$array['BillRefNumber']; 
        $invoiceno=$array['InvoiceNumber']; 
        $msisdn=$array['MSISDN']; 
        $orgaccountbalance=$array['OrgAccountBalance']; 
        $firstname=$array['FirstName']; 
        $middlename=$array['MiddleName']; 
        $lastname=$array['LastName'];
        
       // Log::info('RECEIVED TRANSAMOUNT: '.$transamount);
        
        DB::insert('INSERT INTO payments
                    ( 
                    TransactionType,
                    TransID,
                    TransTime,
                    TransAmount,
                    BusinessShortCode,
                    BillRefNumber,
                    InvoiceNumber,
                    MSISDN,
                    FirstName,
                    MiddleName,
                    LastName,
                    OrgAccountBalance
                    )   values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)',
                    [$transactiontype, 
                    $transid, 
                    $transtime, 
                    $transamount, 
                    $businessshortcode, 
                    $billrefno, 
                    $invoiceno, 
                    $msisdn,
                    $firstname, 
                    $middlename, 
                    $lastname, 
                    $orgaccountbalance] );
                            
    echo'{"ResultCode":0,"ResultDesc":"Confirmation received successfully"}';
        
    }
}
