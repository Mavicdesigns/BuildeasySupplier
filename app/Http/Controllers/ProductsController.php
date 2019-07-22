<?php
/**
 * Created by PhpStorm.
 * User: Anjola
 * Date: 10/26/2018
 * Time: 8:50 PM
 */

namespace App\Http\Controllers;


use App\category;
use App\products;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Intervention\Image\Facades\Image;
use Intervention\Image\File;

class ProductsController extends Controller
{

    public function index(){

        return View::make('Products.create')
            ->with('categories',category::all());

    }

    public function createProduct(Request $request){

        $input = $request->json()->all();



        if($request->json()->get('file'))  {
            $image = $request->json()->get('file');
            $name = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
            $path = public_path('storage/').$name;
            if(Image::make($request->json()->get('file'))->save($path)) {

            }else {

            }



            $newProduccts = products::firstOrCreate([
                'title' => $input['title'],
                'price' => $input['price'],
                'image' => $path,
                'valuation' => $input['valuation'],
                'description' => $input['description'],
                'supplier_id' => Auth::user()->user_id,
                'category_id' => $input['category'],
                'product_id' => str_random(10),
                'status' => $input['status'],
                'options' => json_encode($input['allOptions']),
                'attributes' => json_encode($input['allProperties'])
            ]);

            $message = '';
            if($newProduccts){
                $message = "uploaded Product";
            }else{
                $error = " ";
            }

            return response()->json([
                'message' => $message,

            ], 200);
        }


//08035218276





    }

    public function allProduct(){

        $myProducts = products::where([
            ['supplier_id', '=', Auth::user()->user_id],
        ])->get();

        return response()->json([
            'allProducts' => $myProducts
        ],200);
    }

    public function createNewCategory(){



    }

    public function getCategory(){

        $catGory = category::all();

        return response()->json([
            'categories' => $catGory
        ],200);

    }

    function random_code($limit)
    {
        return substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);
    }


    public function createCategory($name){



        $category = category::firstOrCreate([
            'name' => $name,
            'category_id' => $this->random_code(17),
        ]);

        return response()->json([
            'newCategory' => $category,
            'success' => 'Category Added'
        ],200);

    }



    public function deleteProduct($id){

        try{
            $deleteProduct = products::where('product_id',$id)->delete();
            $error = [];

        }catch(QueryException $e){
            $error = $e->getMessage();
        }

        return response()->json([
            'error' => $error
        ]);

    }

    public function getCurrentProduct(Request $request){




    }

}