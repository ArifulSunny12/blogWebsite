<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comment;
use Carbon\Carbon;

class commentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function postComment(Request $request)
    {
        $post_id=$request->input("post_id");
        $user_id=$request->input("user_id");
        $comment=$request->input("comment");

            if($request->has('comment')){
                $comment_result= comment::insert([
                    "post_id"=>$post_id ,
                    "user_id"=>$user_id , 
                    "content"=>$comment
               ]);
               if($comment_result==true){
                return redirect('home');
            }
            else{
                return 'Comment fail';
            }
               
            }
            else{
                return view('home');
            }
        
       
        
    }

    function deletecomment($id){
        
        $deletepost=comment::where('id',$id)->delete();
        if($deletepost==true){
            return redirect('profile');
        }
       else{
            return 'Delete faild! try again';
        }
    }

    
    function editcomment($id){
        $commentForEdit=comment::find($id);
        return response()->json([
            'status'=>200,
            'comment'=>$commentForEdit,
        ]);
    }

    
    function updatecomment(Request $request)
    {
        $comment_id=$request->input("comment_id");
        $comment_edit=$request->input("comment_edit");
        

            if($request->has('comment_edit')){

            date_default_timezone_set('Asia/Dhaka');
            $current_time = Carbon::now();
                $comment_update_result=comment::where("id", $comment_id)->update(["content" => $comment_edit,"updated_at" => $current_time ]);
               
               if($comment_update_result==true){
                return redirect('home');
            }
            else{
                return 'Comment fail';
            }
               
            }
            else{
                return view('home');
            }
        
       
        
    }


}
