<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompleteUserInfo extends Controller
{
    //UpdateUserPhoto
    function UpdateUserPhoto(Request $req , $useremail){
   
       
        
      
        // $user->photo=$req->file('file')->store('projectPhotos');
        // $user->save();
        $user =new User();
        $user = User::where('email', $useremail)->first();
       
        $user->photo=$req->file('file')->store('projectPhotos');
       
       
        $user->update();

        return response()->json([
        
            'status'=> 200,
            'userPhoto'=>$user->photo,
        ]
    
        );


    }
    
    function UpdateUserPhotoInPosts(Request $req , $useremail){
   
       
        $user = DB::table('posts')
        ->where('Companyusername', $useremail)->update(['companyPhoto' => $req->file('file')->store('projectPhotos')]);
      
       
      
       
       
      
       

        return response()->json([
        
            'status'=> 200,
            'userPhoto'=>$user,
        ]
    
        );


    }



    public function UpdateTheme(Request $req ,$id){
        $Theme = User::find($id); 
        $Theme -> dark_mode =$req->input('dark_mode');
        
        $Theme->update();
    }
   
}
