<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Orders extends Model
{
    use Notifiable;
    //

    protected $fillable = array('title','order_id','product_id','supplier_id','buyer','price','quantity','valuation','status','destination' );

    public static  $rules = array(
        'buyer' => 'required',
        'supplier_id' => 'required',
        'quantity' => 'required|numeric',
        'price' => 'required|numeric',
        'valuation' => 'required|min:5',
        'title' => 'required',
        'status' => 'required|min:20',
        'destination' => 'required',
        );



}
