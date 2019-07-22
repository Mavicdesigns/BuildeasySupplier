<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    //

    protected $fillable = array('title','supplier_id','place_id','LG','state','status','country','address');

    public static  $rules = array(
        'LG' => 'required',
        'state' => 'required',
        'place_id' => 'required',
        'title' => 'required',
        'country' => 'required',
        'address' => 'required',
        );




}
