<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use GuzzleHttp\Client;




class BooksController extends Controller
{


    public function buyBook($itemNumber)
    {
    $client = new Client();
       
        $queryRequest='http://192.168.209.134/query/'.$itemNumber;
     
   $res= $client->request('GET',  $queryRequest);
   
    if ($res->getStatusCode() == 200) { // 200 OK
     
$array = json_decode($res->getBody()->getContents(), true); 
if($array["message"]=="Found,Not out of stock"){
 

 $updateRequest='http://192.168.209.134/update/'.$itemNumber;
   
   $updateRes= $client->request('PUT',$updateRequest);
    DB::insert('insert into orders (bookId,customerName,date) values(?,?,?)',[$itemNumber,"malak Bawwab",date("Y-m-d H:i:s")
]);

  return  $updateRes->getBody();
}elseif($array["message"]=="Found  but out of stock"){
 return   "Buy faild,book is out of stock";
}elseif ($array["message"]=="Not Found"){
 return   "Buy faild,no book with this number".' '.$itemNumber;
}

       
       }
}

 public function showAllOrders($itemNumber)
    {
$result= DB::select('select * from orders where bookId=?',[$itemNumber]);

  if(!empty($result)){

return response()->json($result);
}else{

return "l";
}



}
}