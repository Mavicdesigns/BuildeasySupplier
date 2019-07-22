<?php
/**
 * Created by PhpStorm.
 * User: Anjola
 * Date: 10/25/2018
 * Time: 9:53 PM
 */


namespace App\Http\Controllers;

use App\Orders;
use App\User;
use App\Http\Controllers\Controller;
use App\category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;
use Symfony\Component\HttpFoundation\Request;


class OrdersController extends Controller{


    public function Processedsingle($id){

        $order = Orders::where([
            ['order_id', '=', $id],
            ['status', '>=', 1 ]
        ])->get();

        if(count($order) <= 0){

            return Redirect::to('/dashboard')
                ->with('message','Can\'t find that order');
        }

        return View::make('Orders/Processedsingle')
            ->with('order', $order);
    }

    public function verifyToken($id, \Illuminate\Support\Facades\Request $request){


        $order = Orders::where([
            ['order_id', '=', $id],
            ['status', '=', 2]
        ])->latest()->first();

        if(empty($order)){
            return Redirect::to('/dashboard')
                ->with('message','Can\'t find the  order you ar trying to complete');
        }

        $input = $request::all();

        if(empty($input['token'])){
            return Redirect::to('/Orders/confirm/'.$id)
                ->with('error','Token can\'t be empty');

        }elseif($input['token'] == $order['token']){

            $update = Orders::where([
                ['order_id', '=', $id],
                ['status', '=', 2]
            ])->update(['status' => 3]);

            if($update){

                return Redirect::to('/dashboard')
                    ->with('message','Congratulations you have completed this Order');
            }


            return Redirect::to('/dashboard')
                ->with('message','Something Went Wrong, Could not complete This order');

        }else{
            return Redirect::to('/Orders/confirm/'.$id)
                ->with('error','Token is incorrect please verify and try again')
                ->with('message','Token is incorrect please verify and try again');
        }

    }


    public function single($id){

        $order = Orders::where([
            ['order_id', '=', $id],
            ['status', '=', 0]
        ])->limit(1)->latest()->get();
     if(count($order) <= 0){

         return Redirect::to('/dashboard')
             ->with('message','Sorry Can\'t find that order');
     }

        return View::make('Orders/single')
            ->with('order', $order);
    }


    public function processOrder($id){

         Orders::where([
            ['order_id', '=', $id],
            ['status', '=', 0]
        ])->update(['status' => 1]);

        return Redirect::to('/dashboard')
            ->with('message','Order is awaiting confirmation from Customer');


    }

    public function allNewOrders(){
        $order = Orders::where([
            ['supplier_id' ,'=',Auth::user()->user_id],
            ['status', '=', 0 ]
        ])->latest()->get();

        return View::make('orders/orders')
            ->with('orders',$order);

    }


    public function allConfirmationOrders(){
        $order = Orders::where([
            ['supplier_id' ,'=',Auth::user()->user_id],
            ['status', '=', 1 ]
        ])->latest()->get();

        return View::make('orders/orders')
            ->with('orders',$order);

    }

       public function allAwaitingOrder(){
        $order = Orders::where([
            ['supplier_id' ,'=',Auth::user()->user_id],
            ['status', '=', 2 ]
        ])->latest()->get();

           return View::make('orders/orders')
               ->with('orders',$order);

    }

    public function allCompletedOrder(){
        $order = Orders::where([
            ['supplier_id' ,'=',Auth::user()->user_id],
            ['status', '=', 3 ]
        ])->latest()->get();

        return View::make('orders/orders')
            ->with('orders',$order);

    }


}