<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function paydetails(Request $request){
        $data=[
            'BusinessShortCode'=> 174379,
            'Password'=> "MTc0Mzc5YmZiMjc5ZjlhYTliZGJjZjE1OGU5N2RkNzFhNDY3Y2QyZTBjODkzMDU5YjEwZjc4ZTZiNzJhZGExZWQyYzkxOTIwMjMwMTIxMjIzMjM0",
            'Timestamp'=> "20230121223234",
            'TransactionType'=> "CustomerPayBillOnline",
            'Amount'=> 1,
            'PartyA'=> 254705384479,
            'PartyB'=> 174379,
            'PhoneNumber'=> 254705384479,
            'CallBackURL'=> "https://mydomain.com/path",
            'AccountReference'=> "CompanyXLTD",
            'TransactionDesc'=> "Payment of X"
        ];

        $info=json_encode($data);

        return $info;
       }

       public function payment(Request $request){

        $ch = curl_init('https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest');
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer CSAqeejcZGJ3MY2zK0RnWUe1n40R',
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$this->paydetails($request));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $response     = curl_exec($ch);
        curl_close($ch);
        echo $response;

       }


}
