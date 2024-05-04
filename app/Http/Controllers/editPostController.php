<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\post;
use Carbon\Carbon;

class editPostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function editpost($id){

      $posts=post::select('*')->where('user_id', '=', Auth::user()->id)->where('id', '=',$id)->get();
  
      return view('editpost')->with('post',$posts);
      
      
    }

    function deletepost($id){
        $deletepost=Post::where('id',$id)->delete();
        if($deletepost==true){
            return redirect('profile');
        }
       else{
            return 'Delete faild! try again';
        }
    }

    
    function updatepost(Request $request){
        $post_id=$request->input("post_id");
        $user_id=$request->input("user_id");
        $title=$request->input("title");
        $content=$request->input("post");
        //$content_image=$request->input("status_image");
        if($request->has('post_image')){
            $content_image=$request->post_image;
            $content_image_name=Str::random(4)."_".time().".".$content_image->getclientOriginalExtension();
            $path='postimage';
            $content_image->move($path,$content_image_name);
            $content_image_link= "http://localhost:8000/postimage/".$content_image_name;

            date_default_timezone_set('Asia/Dhaka');
            $current_time = Carbon::now();
            $update_result=Post::where("id", $post_id)->update(["title" => $title,"content" => $content,
            "image_path"=>$content_image_link, "updated_at" => $current_time ]);
        }
        else{
            date_default_timezone_set('Asia/Dhaka');
            $current_time = Carbon::now();
            $update_result=Post::where("id", $post_id)->update(["title" => $title,"content" => $content, "updated_at" => $current_time ]);
        }
        
       if($update_result==true){
            return redirect('profile');
        }
       else{
            return 'Record faild! try again';
        }
        
    }
        
  
       
        
      

}
