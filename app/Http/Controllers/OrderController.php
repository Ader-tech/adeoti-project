<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\client;
use Illuminate\Http\Request;
use Carbon\Carbon;


$order = order::paginate(15);

class OrderController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request,[
            'FullName'=> 'required',
            'Email'=>'required|email|unique:users,email',
            'Address'=>'required',
            'LGA'=> 'required',
            'PhoneNumber'=> 'required|digits:11',
            'state'=>'required',
            'custom' => [
                'Email' => ['required'=>'please input your email!',
                'max'=>'your email address is too long!'
            ],
        ],
            'orders' => 'present|array',
        ]);

            $client = new client;
            $client->Fullname = $request->FullName;
            $client->Email = $request->Email;
            $client->Address = $request->Address;
            $client->LGA = $request->LGA;
            $client->PhoneNumber = $request->PhoneNumber;
            $client->state = $request->state;
           
          
            $client->save(); 

            $orders = [];
            $clientOrder = collect($request->orders)->map(function($clider) use($orders , $client){
                $orders = [
                     'clients_id' => $client->id,
                     'products_id' => $clider['products_id'],
                     'quantity' => $clider['quantity'],
                     'TotalAmount' => $clider['TotalAmount'],
                     'status' => $clider['status'],
                     'created_at' => Carbon::now(),
                     'updated_at' => Carbon::now()
                ];
            return $orders;
            });
            order::insert($clientOrder->toArray());

            return response()->json([
                'status'=> true,
                'data' => $clientOrder
            ]);
    }
        public function update(Request $request, $id)
        {
            $order = order::find($id); 
            $order->status = $request->status;
            $order->save(); 
            
            return response()->json([
                'status'=> true,
                'success' => 'update successfully',
                'data' => $order
            ]);
        }

    public function allOrders()
    {
        $order = order::all();
        return response()->json([
            'status'=> true,
            'order' => $order
        ]);
    }

    public function getSingleOrder($id)
    {
        $order = order::find($id);
        
        return response()->json([
            'status'=> true,
            'data' => $order
        ]);
    }
    public function count()
    {
        $order = order::all(); 
        $counting = $order->count();
        $orderPending = $order->where('status','Pending')->count();
        $orderDelivered = $order->where('status','Delivered')->count();
        $orderCancelled = $order->where('status','Cancelled')->count();
        $Pending = $order->where('status','Pending')->sum('total');
        $Delivered = $order->where('status','Delivered')->sum('total');
        $Cancelled = $order->where('status','Cancelled')->sum('total');
        $totalAmount = $order->sum('total');
        
        
        return response()->json([
            'status'=> true,
            'data' => [$counting,$orderPending,$orderDelivered,$orderCancelled,$Pending, $Delivered,$Cancelled,$totalAmount]
        ]);
    }

}