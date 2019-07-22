<?php
/**
 * Created by PhpStorm.
 * User: Anjola
 * Date: 10/26/2018
 * Time: 3:20 PM
 */

namespace App\Http\Controllers;


use App\Supplier;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;

class SupplierController
{



    public function getIndex(){
        return View::make('auth/register/supplier');
    }

    public  function CreateSupplier(Request $request){

        $data = $request::all();

        $validator = Validator::make($data,Supplier::$rules);



             $supplier = Supplier::firstOrCreate([
                 'supplier_id' => Auth::user()->user_id,
                'title' => $data['title'],
                 'address' => 'something',
                'LG' => $data['LG'],
                 'place_id' => $data['place_id'],
                'state' => $data['state'],
                'country' => $data['country'],
                 'status' => 'active'
            ]);

            return Redirect::to('/dashboard')
                ->with('message','Welcome to the world of Buildeasy');
        }

    }
