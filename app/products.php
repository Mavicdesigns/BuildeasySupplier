<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    //

    protected $fillable = array('title','category_id','status','attributes','options','product_id','supplier_id','valuation','description','price','availability','image');

    protected $casts = [
        'attributes' => 'array',
        'options' => 'array'
    ];

    public static  $rules = array(
       // 'category_id' => 'required|Integer',
        // 'product_id' => 'required|min:2',
        // 'supplier_id' => 'required',
      //  'quantity' => 'required|numeric',
        'valuation' => 'required',
        'title' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        //'availability' => 'Integer',
        'image' => 'required | mimes:jpeg,jpg,png '
        );


    public function Category(){
        return $this->belongsTo('Category');
    }

}
