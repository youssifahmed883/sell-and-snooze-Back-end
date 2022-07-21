<?php

namespace App\Http\Controllers;

use App\Models\CompanyInformation;
use App\Models\messages;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function PHPSTORM_META\map;

class messageController extends Controller
{
    //

    public function listCompany()
    {
        $listCompany = DB::table('users')
        ->where('roleAs', '1')->get();
        return $listCompany;

    }
    public function index(Request $request ,$fromId,$toId){

        $messages = DB::table('messages')
                ->where('messageFrom',$fromId)
                ->Where('messageTo', $toId)
                ->orWhere('messageFrom', $toId)
                ->Where('messageTo', $fromId)

                ->get()
                ;
        $LastMessage =  DB::table('messages')
        ->where('messageFrom',$fromId)
        ->Where('messageTo', $toId)
        ->orWhere('messageFrom', $toId)
        ->Where('messageTo', $fromId)

        ->get()
        ->last();
                return response()->json([

                    'status'=> 200,
                    'messages'=>$messages,
                    'LastMessage'=>$LastMessage,
                ]

            );
    }
    public function IsReadMessage($fromId,$toId){

        $messages = DB::table('messages')
        ->where('messageFrom',$fromId)
        ->Where('messageTo', $toId)
        ->orWhere('messageFrom', $toId)
        ->Where('messageTo', $fromId)

        ->update([
            'IsRead' => 1
         ]);

                return response()->json([

                    'status'=> 200,
                    'messages'=>$messages,
                ]

            );
    }
    public function indexlist(Request $request ,$toId){
        $messages = DB::table('messages')

                ->Where('messageTo', $toId)


                ->get();
                $LastMessage=DB::table('messages')
                ->where('messageFrom',$toId)

                ->orWhere('messageTo', $toId)


                ->get()
                ->last();
                return response()->json([

                    'status'=> 200,
                    'messages'=>$messages,
                    'LastMessage'=> $LastMessage
                ]

            );
    }
    public function indexlist2(Request $request ,$fromEmail){
        $messages = DB::table('messages')

                ->Where('messageFrom', $fromEmail)
                ->orWhere('messageTo', $fromEmail)


                ->get();
        $LastMessage=DB::table('messages')
        ->where('messageFrom',$fromEmail)

        ->orWhere('messageTo', $fromEmail)


        ->get()
        ->last();


                return response()->json([

                    'status'=> 200,
                    'messages'=>$messages,
                    'LastMessage'=> $LastMessage,
                ]

            );
    }


    function sendMessage(Request $req){
        $messages=new messages;


        $messages->messageFrom=$req->input('messageFrom');
        $messages->messageTo=$req->input('messageTo');

        $messages->messageContent=$req->input('messageContent');
        $messages->senderPhoto=$req->input('senderPhoto');
        $messages->ReciverPhoto=$req->input('ReciverPhoto');


        $messages->save();
    return  $messages;
}


function indexFromUser(Request $request ,$fromId,$toId){

    $messages = DB::table('messages')
    ->where('messageFrom',$fromId)
    ->Where('messageTo', $toId)
    ->orWhere('messageFrom', $toId)

    ->get();
    return response()->json([

        'status'=> 200,
        'messages'=>$messages,
    ]

);
}

function getUserPhoto( $useremail){




    // $user->photo=$req->file('file')->store('projectPhotos');
    // $user->save();

    $user = User::where('email', $useremail)->get();






    return $user;


}

}
