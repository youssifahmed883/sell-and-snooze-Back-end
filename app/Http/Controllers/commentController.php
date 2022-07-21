<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\commentModel;
use Illuminate\Support\Facades\DB;
class commentController extends Controller
{
    //
    
    function addComment(Request $req,$postId){

        $comment =new commentModel();
        $comment->postId=$req->input('postId');
        $comment->username=$req->input('username');

        $comment->userPhoto=$req->input('userPhoto');
        $comment->commentContent=$req->input('commentContent');
      

        
        $comment->save();

       DB::table('posts')
        ->where('id', $postId)->increment('numOfComment');
 
       return  $comment;
    }
    public function getComments($postId){
        $getComments = DB::table('comments')
        ->where('postId', $postId)->get();
        return   $getComments;
    }
}
