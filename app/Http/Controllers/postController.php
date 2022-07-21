<?php

namespace App\Http\Controllers;

use App\Models\Dislikedpost;
use App\Models\likedpost;
use App\Models\commentModel;
use App\Models\Post;
use App\Models\products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\Input;

class postController extends Controller
{
    public function index(Request $req , $useremail)
    {
        $post = Post::all();

        $returnLikePosts = DB::table('likedposts')
        ->where('useremail', $useremail)->get();


        $returnDislikePosts = DB::table('dislikedposts')
        ->where('useremail', $useremail)->get();

        return response()->json([

            'posts'=> $post,
            'likedPosts'=> $returnLikePosts,
            'DislikedPosts'=> $returnDislikePosts,

        ]

    );




    }



    function addPost(Request $req){

        $post =new Post();
        $post->Companyusername=$req->input('username');
            $post->description=$req->input('description');

            $post->category=$req->input('category');
            $post->companyPhoto=$req->input('userPhoto');



        $post->filepath=$req->file('file')->store('projectPhotos');
        $post->save();
       return  $post;
    }
    public function editLike(Request $request ,$postId){
          $post = Post::find($postId);
          $post ->likes =$request -> input('likes');
          $post->update();
    return response()->json([

        'status'=> 200,
        'post'=>$post,
    ]

    );
    }
    public function editDisLike(Request $request ,$postId){
        $post = Post::find($postId);
        $post ->dislikes =$request -> input('dislikes');
        $post->update();
        return response()->json([

            'status'=> 200,
            'post'=>$post,
        ]

    );
    }


    function saveLikedPost(Request $req){

        $saveLikePosts = new likedpost();

        $saveLikePosts->postid=$req->input('postid');
        $saveLikePosts->useremail=$req->input('useremail');
        $saveLikePosts->save();
        return response()->json([

            'liked'=> true,
            'post'=>$saveLikePosts,
        ]

    );

    }

    public function removeLike($id,$userEmail){
        $delete = DB::table('likedposts')
        ->where('postid', $id)
        ->where('useremail', $userEmail)
        ->delete();



        return("sucsss");
    }


    function saveDislikedPost(Request $req){

        $saveDislikePosts = new Dislikedpost();

        $saveDislikePosts->postid=$req->input('postid');
        $saveDislikePosts->useremail=$req->input('useremail');
        $saveDislikePosts->save();
        return response()->json([

            'Disliked'=> true,
            'post'=>$saveDislikePosts,
        ]

    );
    }

    public function removeDislike($id,$userEmail){
        $delete = DB::table('dislikedposts')
        ->where('postid', $id)
        ->where('useremail', $userEmail)
        ->delete();



        return("sucsss");
    }

    public function postDashbard($CompanyEmail){
        $returnDashBardPosts = DB::table('posts')
        ->where('Companyusername', $CompanyEmail)->get();
        return   $returnDashBardPosts;
    }
    public function getPostForUpdate($postId){
        $postForUpdate = DB::table('posts')
        ->where('id', $postId)->get();
        return   $postForUpdate;
    }
    function UpdateAddvertismentInformation(Request $req , $postId){

        $Addvert = Post::where('id', $postId)->first();
        if ($req->file('file') == null ){
            $Addvert->category=$req->input('category');

        $Addvert->description=$req->input('description');
        $Addvert->update();
        return response()->json([

            'status'=> 200,
            "Company"=>$Addvert,

        ]

        );
        }else {

        $Addvert->category=$req->input('category');

        $Addvert->description=$req->input('description');
        $Addvert->filepath=$req->file('file')->store('projectPhotos');
        $Addvert->update();

        return response()->json([

            'status'=> 200,
            "Company"=>$Addvert,

        ]

        );


    }



    }













}
