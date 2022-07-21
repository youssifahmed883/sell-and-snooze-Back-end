<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ordersController extends Controller
{
    //'userPhoto',
    // 'username',
    // 'productName',
    // 'productModel',
    // 'quantity',
    // 'productPhoto',
   public function insert(Request $request){
        $product = new orders();
        $product->quantity=$request->input('quantity');
        $product->userPhoto=$request->input('userPhoto');
        $product->username=$request->input('username');
        $product->productName=$request->input('productName');
        $product->productModel=$request->input('productModel');
        $product->productPhoto=$request->input('productPhoto');
        $product->productId=$request->input('productId');
        $product->companyEmail=$request->input('companyEmail');
        $product->location=$request->input('location');
        $product->PhoneNumber=$request->input('PhoneNumber');



        $product->PaymentPhoto=$request->file('file')->store('projectPhotos');
        $product->visaCard=Hash::make($request->input('visaCard'));


        products::find($request->id)->decrement('productQuantity',1);
        $product->save();

        return($product);
    }










    public function deleteOrder($username,$productId){
        DB::table('orders')->where('username', $username)->
       where('productId', $productId)->delete();
       $query = DB::table('products')
        ->where('id',$productId);
        $query->increment('productQuantity',1);

    }
    public function getDashBoardOrders($companyEmail ){
        $orders = DB::table('orders')
        ->where('companyEmail', $companyEmail)
        ->get();

            return response()->json([
                'status'=>200,
                'order'=>$orders,


            ]); }
    public function getOrdersForUser($UserEmail ){
        $orders = DB::table('orders')
        ->where('username', $UserEmail)
        ->get();

            return response()->json([
                'status'=>200,
                'order'=>$orders,


            ]); }
    public function UpdateStatus(Request $req ){
        $order = orders::where('id', $req->id)->first();


        $order->status=$req->input('status');


        $order->update();
            return response()->json([
                'status'=>200,
                'order'=>$order,


            ]); }
            public function deleteOrderInTable($id){
                DB::table('orders')->where('id', $id)->delete();


            }
}
