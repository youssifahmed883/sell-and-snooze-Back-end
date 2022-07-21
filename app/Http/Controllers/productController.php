<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productController extends Controller
{
    //

    function addProduct(Request $req){
        $product =new products();
        $product->productName=$req->input('productName');
        $product->productCategory=$req->input('productCategory');
        $product->productModel=$req->input('productModel');
        $product->productQuantity=$req->input('productQuantity');
        $product->productDescription=$req->input('productDescription');
        $product->productPrice=$req->input('productPrice');
        $product->companyId=$req->input('companyId');
           
        $product->productImage=$req->file('file')->store('projectPhotos');
        $product->save();
       return  response()->json([
           'status' =>200,
           'product'=>$product
       ]);
    }

    function getProducts( $useremail){
      
        $getTheProducts = DB::table('products')
        ->where('companyId', $useremail)->get();
      
            // ...
            return $getTheProducts;
    }
    function UpdateCumpanyInfo(Request $req , $CompanyId){
  
        $Company = CompanyInformation::where('CompanyId', $CompanyId)->first();
       
        $Company->Headquarters=$req->input('Headquarters');
        $Company->numOfWorkers=$req->input('numOfWorkers');
        $Company->Phone=$req->input('Phone');
        $Company->Industry=$req->input('Industry');
        $Company->Website=$req->input('Website');
        $Company->Description=$req->input('Description');
        $Company->update();

        return response()->json([
        
            'status'=> 200,
            "Company"=>$Company,
            
        ]
    
        );


    }




}
