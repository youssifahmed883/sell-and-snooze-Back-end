<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Post;
use App\Models\products;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    //



   public function addCpmpanyInfo(Request $req)

    {

        $affected = DB::table('users')
        ->where('id',$req->input('CompanyId'))
        ->update(['completeRigester' => 1]);
        $company =new CompanyInformation();
        $company->CompanyEmail=$req->input('CompanyEmail');
        $company->Headquarters=$req->input('Headquarters');
        $company->numOfWorkers=$req->input('numOfWorkers');
        $company->Phone=$req->input('Phone');
        $company->Industry=$req->input('Industry');
        $company->Website=$req->input('Website');
        $company->Description=$req->input('Description');
        $company->CompanyId=$req->input('CompanyId');




        // CompanyEmail	Headquarters	numOfWorkers	Phone	Industry	Website	Description	photo



        $company->save();

        # code...
        return $company;
    }
    function getCompanyInfo( $CompanyEmail){

        $Companyinformation = DB::table('companyinfo')
        ->where('CompanyEmail', $CompanyEmail)->get();

            // ...
            return $Companyinformation;
    }
    public function getCompanyCategory($Industry)
    {
        $users = DB::table('users')
            ->join('companyinfo', 'users.id', '=', 'companyinfo.CompanyId')->Where('Industry', $Industry)->get();



         return $users;

    }
    public function getCompanyPage($CompanyId)
    {
        $users = DB::table('users')
            ->join('companyinfo', 'users.id', '=', 'companyinfo.CompanyId')

            ->Where('users.id', $CompanyId)->get();

         $CompanyProducts = DB::table('products')
        ->where('companyId', $CompanyId)->get();


        return response()->json([
            'status'=>200,
            'CompanyInfo'=> $users,
            'Products'=>$CompanyProducts,
        ]

    );

    }
    public function productPage($CompanyId,$Productid,$userName )
    {
        $users = DB::table('users')
            ->join('companyinfo', 'users.id', '=', 'companyinfo.CompanyId')

            ->Where('users.id', $CompanyId)->get();

         $Product = DB::table('products')
        ->where('id', $Productid)->get();


        $orders = DB::table('orders')
        ->where('username', $userName)
        ->where('productId', $Productid)->get();



        return response()->json([
            'status'=>200,
            'CompanyInfo'=> $users,
            'Product'=>$Product,
            'order'=>$orders,
        ]

    );

    }
    public function productInformation($Productid)
    {


         $Product = DB::table('products')
        ->where('id', $Productid)->get();


        return response()->json([
            'status'=>200,

            'Product'=>$Product,
        ]

    );

    }

    function UpdateproductInformation(Request $req , $Productid){
        $product = products::where('id', $Productid)->first();

        if ($req->file('file') == null ){
            $product->productName=$req->input('productName');
            $product->productCategory=$req->input('productCategory');
            $product->productModel=$req->input('productModel');
            $product->productQuantity=$req->input('productQuantity');
            $product->productPrice=$req->input('productPrice');
            $product->productDescription=$req->input('productDescription');
            $product->update();
            return response()->json([

                'status'=> 200,
                "Company"=>$product,
                 ]

            );
        }else {
            $product->productName=$req->input('productName');
            $product->productCategory=$req->input('productCategory');
            $product->productModel=$req->input('productModel');
            $product->productQuantity=$req->input('productQuantity');
            $product->productPrice=$req->input('productPrice');
            $product->productDescription=$req->input('productDescription');
            $product->productImage=$req->file('file')->store('projectPhotos');
            $product->update();
            return response()->json([

                'status'=> 200,
                "Company"=>$product,
                 ]

            );
        }
        // $product->productImage=$req->file('file')->store('projectPhotos');
        // $product->update();


    }
    public function deleteProduct($id)
    {
        $product = products::find($id);
        $product->delete();
        return response()->json([

            'status'=> 200,
            'student'=>'student deleted successfully',
        ]);
    }
    public function deleteAddvertisment($Postid)
    {
        $post = Post::find($Postid);
        $post->delete();
        return response()->json([

            'status'=> 200,
            'student'=>'student deleted successfully',
        ]);
    }

    function ChangePassword(Request $req){





        $user = User::where('email', $req->email)->first();

        if (Hash::check($req->password, $user->password)) {


            $user->password = Hash::make($req->input('NewPassword'));

            $user->save();

            return response()->json([
                'status'=>200,
                'message'=>'Password Changed',
                'userEmail'=>$user->email,
            ]);


    }else{
        return response()->json([
            'status'=>400,
            'message'=>'Wrong Password'
        ]);
    }

    }
    function ChangeLocation(Request $req){

        $user = User::where('email', $req->email)->first();
        $user->Address=$req->input('address');
        $user->City=$req->input('city');
        $user->update();
        return response()->json([
            'status'=> $user
        ]);
    }

    function getUserInfo($userEmail){
        $user = DB::table('users')
        ->where('email', $userEmail)->get();
        return $user;

    }




}
